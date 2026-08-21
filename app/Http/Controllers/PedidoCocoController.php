<?php

namespace App\Http\Controllers;

use App\Models\PedidoCoco;
use App\Models\LugareCoco;
use App\Models\TipoCoco;
use App\Models\ColorCoco;
use App\Models\ArticulosPedidoCoco;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PedidoCocoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PedidoCocoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpCocoSublime');
    }

    public function index(Request $request): View
    {
        $pedidos = PedidoCoco::paginate();

        return view('coco.pedido.index', compact('pedidos'))
            ->with('i', ($request->input('page', 1) - 1) * $pedidos->perPage());
    }

    public function create(): View
    {
        $pedido = new PedidoCoco();
        $lugares = LugareCoco::orderBy('nombre')->get();
        $tipos = TipoCoco::orderBy('nombre')->get();
        $colores = ColorCoco::orderBy('nombre')->get();

        return view('coco.pedido.create', compact('pedido', 'lugares', 'tipos', 'colores'));
    }

    public function store(PedidoCocoRequest $request): RedirectResponse
    {
        $pedido = PedidoCoco::create($request->validated());

        if ($request->has('articulos')) {
            foreach ($request->articulos as $item) {
                $pedido->articulosPedidos()->create($item);
            }
        }

        return Redirect::route('coco-pedidos.index')
            ->with('success', 'Pedido creado exitosamente.');
    }

    public function show($id): View
    {
        $pedido = PedidoCoco::find($id);

        return view('coco.pedido.show', compact('pedido'));
    }

    public function edit($id): View
    {
        $pedido = PedidoCoco::find($id);
        $lugares = LugareCoco::orderBy('nombre')->get();
        $tipos = TipoCoco::orderBy('nombre')->get();
        $colores = ColorCoco::orderBy('nombre')->get();
        $pedido->load('articulosPedidos');

        return view('coco.pedido.edit', compact('pedido', 'lugares', 'tipos', 'colores'));
    }

    public function update(PedidoCocoRequest $request, PedidoCoco $pedido): RedirectResponse
    {
        $pedido->update($request->validated());

        $realizados = $pedido->articulosPedidos()
            ->pluck('realizado', DB::raw("CONCAT(nombre, '|', color)"))
            ->toArray();

        $pedido->articulosPedidos()->delete();
        if ($request->has('articulos')) {
            foreach ($request->articulos as $item) {
                $articulo = $pedido->articulosPedidos()->create($item);
                $key = $item['nombre'] . '|' . $item['color'];
                if (isset($realizados[$key]) && $realizados[$key]) {
                    $articulo->update(['realizado' => true]);
                }
            }
        }

        return Redirect::route('coco-pedidos.index')
            ->with('success', 'Pedido actualizado exitosamente');
    }

    public function porFecha(Request $request): JsonResponse
    {
        $date = $request->query('date');

        $query = PedidoCoco::with('lugare')
            ->whereDate('fecha_hora_entrega', $date);

        if ($request->has('exclude')) {
            $query->where('id', '!=', $request->query('exclude'));
        }

        $pedidos = $query->get()->map(function ($p) {
            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'lugar' => $p->lugare?->nombre,
                'fecha_hora_entrega' => $p->fecha_hora_entrega,
            ];
        });

        return response()->json($pedidos);
    }

    public function articulosPorColor(Request $request): View
    {
        $fechaStr = $request->query('date', Carbon::today()->toDateString());
        $hoy = Carbon::parse($fechaStr);

        $articulos = ArticulosPedidoCoco::with(['pedido.lugare', 'tipo'])
            ->whereHas('pedido', function ($q) use ($hoy) {
                $q->whereDate('fecha_hora_entrega', $hoy);
            })
            ->orderBy('color')
            ->get();

        $grupos = $articulos->groupBy('color');

        $fecha = $hoy->format('d/m/Y');
        $fechaInput = $hoy->format('Y-m-d');

        return view('coco.pedido.articulos-por-color', compact('grupos', 'fecha', 'fechaInput'));
    }

    public function destroy($id): RedirectResponse
    {
        PedidoCoco::find($id)->delete();

        return Redirect::route('coco-pedidos.index')
            ->with('success', 'Pedido eliminado exitosamente');
    }
}
