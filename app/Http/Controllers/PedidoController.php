<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Lugare;
use App\Models\Tipo;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PedidoController extends Controller
{
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
                $pedido->articulosPedidos()->create($item);
            }
        }

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido created successfully.');
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

        $pedido->articulosPedidos()->delete();
        if ($request->has('articulos')) {
            foreach ($request->articulos as $item) {
                $pedido->articulosPedidos()->create($item);
            }
        }

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Pedido::find($id)->delete();

        return Redirect::route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}
