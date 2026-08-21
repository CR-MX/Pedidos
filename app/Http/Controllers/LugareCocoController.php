<?php

namespace App\Http\Controllers;

use App\Models\LugareCoco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LugareCocoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LugareCocoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpCocoSublime');
    }

    public function index(Request $request): View
    {
        $lugares = LugareCoco::paginate();

        return view('coco.lugare.index', compact('lugares'))
            ->with('i', ($request->input('page', 1) - 1) * $lugares->perPage());
    }

    public function create(): View
    {
        $lugare = new LugareCoco();

        return view('coco.lugare.create', compact('lugare'));
    }

    public function store(LugareCocoRequest $request): RedirectResponse
    {
        LugareCoco::create($request->validated());

        return Redirect::route('coco-lugares.index')
            ->with('success', 'Lugar creado exitosamente.');
    }

    public function show($id): View
    {
        $lugare = LugareCoco::find($id);

        return view('coco.lugare.show', compact('lugare'));
    }

    public function edit($id): View
    {
        $lugare = LugareCoco::find($id);

        return view('coco.lugare.edit', compact('lugare'));
    }

    public function update(LugareCocoRequest $request, LugareCoco $lugare): RedirectResponse
    {
        $lugare->update($request->validated());

        return Redirect::route('coco-lugares.index')
            ->with('success', 'Lugar actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        LugareCoco::find($id)->delete();

        return Redirect::route('coco-lugares.index')
            ->with('success', 'Lugar eliminado exitosamente');
    }
}
