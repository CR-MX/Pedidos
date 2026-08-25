<?php

namespace App\Http\Controllers;

use App\Models\ColorCoco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ColorCocoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ColorCocoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpCocoSublime');
    }

    public function index(Request $request): View
    {
        $colores = ColorCoco::paginate();

        return view('coco.color.index', compact('colores'))
            ->with('i', ($request->input('page', 1) - 1) * $colores->perPage());
    }

    public function create(): View
    {
        $color = new ColorCoco();

        return view('coco.color.create', compact('color'));
    }

    public function store(ColorCocoRequest $request): RedirectResponse
    {
        ColorCoco::create($request->validated());

        return Redirect::route('coco-colores.index')
            ->with('success', 'Color creado exitosamente.');
    }

    public function show($id): View
    {
        $color = ColorCoco::find($id);

        return view('coco.color.show', compact('color'));
    }

    public function edit($id): View
    {
        $color = ColorCoco::find($id);

        return view('coco.color.edit', compact('color'));
    }

    public function update(ColorCocoRequest $request, ColorCoco $coco_colore): RedirectResponse
    {
        $coco_colore->update($request->validated());

        return Redirect::route('coco-colores.index')
            ->with('success', 'Color actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        ColorCoco::find($id)->delete();

        return Redirect::route('coco-colores.index')
            ->with('success', 'Color eliminado exitosamente');
    }
}
