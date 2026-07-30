<?php

namespace App\Http\Controllers;

use App\Models\ArticulosPedido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ArticulosPedidoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ArticulosPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $articulosPedidos = ArticulosPedido::paginate();

        return view('articulos-pedido.index', compact('articulosPedidos'))
            ->with('i', ($request->input('page', 1) - 1) * $articulosPedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $articulosPedido = new ArticulosPedido();

        return view('articulos-pedido.create', compact('articulosPedido'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticulosPedidoRequest $request): RedirectResponse
    {
        ArticulosPedido::create($request->validated());

        return Redirect::route('articulos-pedidos.index')
            ->with('success', 'ArticulosPedido created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $articulosPedido = ArticulosPedido::find($id);

        return view('articulos-pedido.show', compact('articulosPedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $articulosPedido = ArticulosPedido::find($id);

        return view('articulos-pedido.edit', compact('articulosPedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticulosPedidoRequest $request, ArticulosPedido $articulosPedido): RedirectResponse
    {
        $articulosPedido->update($request->validated());

        return Redirect::route('articulos-pedidos.index')
            ->with('success', 'ArticulosPedido updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ArticulosPedido::find($id)->delete();

        return Redirect::route('articulos-pedidos.index')
            ->with('success', 'ArticulosPedido deleted successfully');
    }
}
