<?php

namespace App\Http\Controllers;

use App\Models\TipoCoco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoCocoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoCocoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:EmpCocoSublime');
    }

    public function index(Request $request): View
    {
        $tipos = TipoCoco::paginate();

        return view('coco.tipo.index', compact('tipos'))
            ->with('i', ($request->input('page', 1) - 1) * $tipos->perPage());
    }

    public function create(): View
    {
        $tipo = new TipoCoco();

        return view('coco.tipo.create', compact('tipo'));
    }

    public function store(TipoCocoRequest $request): RedirectResponse
    {
        TipoCoco::create($request->validated());

        return Redirect::route('coco-tipos.index')
            ->with('success', 'Tipo creado exitosamente.');
    }

    public function show($id): View
    {
        $tipo = TipoCoco::find($id);

        return view('coco.tipo.show', compact('tipo'));
    }

    public function edit($id): View
    {
        $tipo = TipoCoco::find($id);

        return view('coco.tipo.edit', compact('tipo'));
    }

    public function update(TipoCocoRequest $request, TipoCoco $coco_tipo): RedirectResponse
    {
        $coco_tipo->update($request->validated());

        return Redirect::route('coco-tipos.index')
            ->with('success', 'Tipo actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        TipoCoco::find($id)->delete();

        return Redirect::route('coco-tipos.index')
            ->with('success', 'Tipo eliminado exitosamente');
    }
}
