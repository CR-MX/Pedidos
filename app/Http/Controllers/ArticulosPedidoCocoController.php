<?php

namespace App\Http\Controllers;

use App\Models\ArticulosPedidoCoco;
use App\Models\ColorCoco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ArticulosPedidoCocoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ArticulosPedidoCocoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpCocoSublime');
    }

    public function index(Request $request): View
    {
        $articulosPedidos = ArticulosPedidoCoco::paginate();

        return view('coco.articulos-pedido.index', compact('articulosPedidos'))
            ->with('i', ($request->input('page', 1) - 1) * $articulosPedidos->perPage());
    }

    public function create(): View
    {
        $articulosPedido = new ArticulosPedidoCoco();
        $colores = ColorCoco::orderBy('nombre')->get();

        return view('coco.articulos-pedido.create', compact('articulosPedido', 'colores'));
    }

    public function store(ArticulosPedidoCocoRequest $request): RedirectResponse
    {
        ArticulosPedidoCoco::create($request->validated());

        return Redirect::route('coco-articulos-pedidos.index')
            ->with('success', 'Artículo creado exitosamente.');
    }

    public function show($id): View
    {
        $articulosPedido = ArticulosPedidoCoco::find($id);

        return view('coco.articulos-pedido.show', compact('articulosPedido'));
    }

    public function edit($id): View
    {
        $articulosPedido = ArticulosPedidoCoco::find($id);
        $colores = ColorCoco::orderBy('nombre')->get();

        return view('coco.articulos-pedido.edit', compact('articulosPedido', 'colores'));
    }

    public function update(ArticulosPedidoCocoRequest $request, ArticulosPedidoCoco $coco_articulos_pedido): RedirectResponse
    {
        $coco_articulos_pedido->update($request->validated());

        return Redirect::route('coco-articulos-pedidos.index')
            ->with('success', 'Artículo actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        ArticulosPedidoCoco::find($id)->delete();

        return Redirect::route('coco-articulos-pedidos.index')
            ->with('success', 'Artículo eliminado exitosamente');
    }

    public function actualizarRealizado(Request $request, ArticulosPedidoCoco $articulo): JsonResponse
    {
        $articulo->update(['realizado' => $request->boolean('realizado')]);

        return response()->json(['success' => true]);
    }
}
