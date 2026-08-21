<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpOrtea');
    }

    public function index(Request $request): View
    {
        $colores = Color::paginate();

        return view('color.index', compact('colores'))
            ->with('i', ($request->input('page', 1) - 1) * $colores->perPage());
    }

    public function create(): View
    {
        $color = new Color();

        return view('color.create', compact('color'));
    }

    public function store(ColorRequest $request): RedirectResponse
    {
        Color::create($request->validated());

        return Redirect::route('colores.index')
            ->with('success', 'Color creado exitosamente.');
    }

    public function show($id): View
    {
        $color = Color::find($id);

        return view('color.show', compact('color'));
    }

    public function edit($id): View
    {
        $color = Color::find($id);

        return view('color.edit', compact('color'));
    }

    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());

        return Redirect::route('colores.index')
            ->with('success', 'Color actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        Color::find($id)->delete();

        return Redirect::route('colores.index')
            ->with('success', 'Color eliminado exitosamente');
    }
}
