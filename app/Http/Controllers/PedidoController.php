<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Lugare;
use App\Models\Tipo;
use App\Models\Color;
use App\Models\ArticulosPedido;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PedidoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpOrtea');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pedidos = Pedido::paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', ($request->input('page', 1) - 1) * $pedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pedido = new Pedido();
        $lugares = Lugare::orderBy('nombre')->get();
        $tipos = Tipo::orderBy('nombre')->get();
        $colores = Color::orderBy('nombre')->get();

        return view('pedido.create', compact('pedido', 'lugares', 'tipos', 'colores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PedidoRequest $request): RedirectResponse
    {
        $pedido = Pedido::create($request->validated());

        if ($request->has('articulos')) {
            foreach ($request->articulos as $item) {
                $item['pedido_id'] = $pedido->id;
                ArticulosPedido::create($item);
            }
        }

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pedido = Pedido::find($id);
        $lugares = Lugare::orderBy('nombre')->get();
        $tipos = Tipo::orderBy('nombre')->get();
        $colores = Color::orderBy('nombre')->get();
        $pedido->load('articulosPedidos');

        return view('pedido.edit', compact('pedido', 'lugares', 'tipos', 'colores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PedidoRequest $request, Pedido $pedido): RedirectResponse
    {
        $pedido->update($request->validated());

        $realizados = $pedido->articulosPedidos()
            ->pluck('realizado', 'id')
            ->toArray();

        $pedido->articulosPedidos()->delete();
        if ($request->has('articulos')) {
            foreach ($request->articulos as $item) {
                $item['pedido_id'] = $pedido->id;
                $articulo = ArticulosPedido::create($item);
                if (isset($item['id']) && isset($realizados[$item['id']]) && $realizados[$item['id']]) {
                    $articulo->update(['realizado' => true]);
                }
            }
        }

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido actualizado exitosamente');
    }

    public function porFecha(Request $request): JsonResponse
    {
        $date = $request->query('date');

        $query = Pedido::with('lugare')
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

        $articulos = ArticulosPedido::with(['pedido.lugare', 'tipo'])
            ->whereHas('pedido', function ($q) use ($hoy) {
                $q->whereDate('fecha_hora_entrega', $hoy);
            })
            ->orderBy('color')
            ->get();

        $grupos = $articulos->groupBy('color');

        $fecha = $hoy->format('d/m/Y');
        $fechaInput = $hoy->format('Y-m-d');

        return view('pedido.articulos-por-color', compact('grupos', 'fecha', 'fechaInput'));
    }

    public function destroy($id): RedirectResponse
    {
        Pedido::find($id)->delete();

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido eliminado exitosamente');
    }
}
