<?php

namespace App\Http\Controllers;

use App\Models\OficinasEmisora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OficinasEmisoraRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OficinasEmisoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $oficinasEmisoras = OficinasEmisora::paginate();

        return view('oficinas-emisora.index', compact('oficinasEmisoras'))
            ->with('i', ($request->input('page', 1) - 1) * $oficinasEmisoras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $oficinasEmisora = new OficinasEmisora();

        return view('oficinas-emisora.create', compact('oficinasEmisora'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OficinasEmisoraRequest $request): RedirectResponse
    {
        OficinasEmisora::create($request->validated());

        return Redirect::route('oficinas-emisoras.index')
            ->with('success', 'OficinasEmisora created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $oficinasEmisora = OficinasEmisora::find($id);

        return view('oficinas-emisora.show', compact('oficinasEmisora'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $oficinasEmisora = OficinasEmisora::find($id);

        return view('oficinas-emisora.edit', compact('oficinasEmisora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OficinasEmisoraRequest $request, OficinasEmisora $oficinasEmisora): RedirectResponse
    {
        $oficinasEmisora->update($request->validated());

        return Redirect::route('oficinas-emisoras.index')
            ->with('success', 'OficinasEmisora updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        OficinasEmisora::find($id)->delete();

        return Redirect::route('oficinas-emisoras.index')
            ->with('success', 'OficinasEmisora deleted successfully');
    }
}
