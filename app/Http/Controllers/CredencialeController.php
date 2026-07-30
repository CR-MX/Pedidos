<?php

namespace App\Http\Controllers;

use App\Models\Credenciale;
use App\Models\OficinasEmisora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CredencialeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class CredencialeController extends Controller
{
    public function index(Request $request): View
    {
        $credenciales = Credenciale::paginate();

        return view('credenciale.index', compact('credenciales'))
            ->with('i', ($request->input('page', 1) - 1) * $credenciales->perPage());
    }

    public function create(): View
    {
        $credenciale = new Credenciale();
        $oficinasEmisoras = OficinasEmisora::orderBy('nombre')->get();

        return view('credenciale.create', compact('credenciale', 'oficinasEmisoras'));
    }

    public function store(CredencialeRequest $request): RedirectResponse
    {
        $data = $request->all();

        if (empty($data['foto'])) {
            $data['foto'] = null;
        }
        if (empty($data['firma'])) {
            $data['firma'] = null;
        }

        $ultimoFolio = Credenciale::where('oficina_emisora_id', $data['oficina_emisora_id'])->max('numero_licencia');
        $data['numero_licencia'] = ($ultimoFolio ?? 0) + 1;

        Credenciale::create($data);

        return Redirect::route('credenciales.index')
            ->with('success', 'Credencial creada correctamente.');
    }

    public function show($id): View
    {
        $credenciale = Credenciale::find($id);

        return view('credenciale.show', compact('credenciale'));
    }

    public function edit($id): View
    {
        $credenciale = Credenciale::find($id);
        $oficinasEmisoras = OficinasEmisora::orderBy('nombre')->get();

        return view('credenciale.edit', compact('credenciale', 'oficinasEmisoras'));
    }

    public function update(CredencialeRequest $request, $id): RedirectResponse
    {
        $credenciale = Credenciale::findOrFail($id);
        $data = $request->all();

        if (empty($data['foto'])) {
            $data['foto'] = null;
        }
        if (empty($data['firma'])) {
            $data['firma'] = null;
        }

        $credenciale->update($data);

        return Redirect::route('credenciales.index')
            ->with('success', 'Credencial actualizada correctamente');
    }

    public function destroy($id): RedirectResponse
    {
        Credenciale::find($id)->delete();

        return Redirect::route('credenciales.index')
            ->with('success', 'Credencial eliminada correctamente');
    }

    public function pdf($id)
    {
        $credenciale = Credenciale::with('oficinaEmisora')->findOrFail($id);

        $pdf = Pdf::loadView('credenciale.pdf', compact('credenciale'))
            ->setPaper([0, 0, 243, 153], 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial',
                'dpi' => 96,
                'isFontSubsettingEnabled' => true,
            ]);

        return $pdf->stream('credencial_' . $credenciale->id . '.pdf');
    }
}
