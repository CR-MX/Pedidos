<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the dashboard with statistics.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inicio()
    {
        $ventasUltimoMes = Pedido::where('created_at', '>=', now()->subMonth())->sum('total');
        $pedidosUltimoMes = Pedido::where('created_at', '>=', now()->subMonth())->count();
        $porCobrarPendiente = Pedido::where('entrega', 'pendiente')
            ->whereRaw('total > anticipo')
            ->sum(DB::raw('total - anticipo'));
        $pendientesEntrega = Pedido::where('entrega', 'pendiente')->count();

        $inicio = now()->subDays(14)->startOfDay();

        $diario = DB::table('pedidos')
            ->where('created_at', '>=', $inicio)
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as pedidos, SUM(total) as ventas')
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $dias = [];
        $pedidosPorDia = [];
        $ventasPorDia = [];
        $cursor = $inicio->copy();
        while ($cursor <= now()) {
            $key = $cursor->toDateString();
            $dias[] = $cursor->format('d/m');
            $pedidosPorDia[] = (int) ($diario[$key]->pedidos ?? 0);
            $ventasPorDia[] = (float) ($diario[$key]->ventas ?? 0);
            $cursor->addDay();
        }

        $ventasPorLugar = DB::table('pedidos')
            ->leftJoin('lugares', 'pedidos.lugar_id', '=', 'lugares.id')
            ->where('pedidos.created_at', '>=', now()->subMonth())
            ->select('lugares.nombre as lugar', DB::raw('SUM(pedidos.total) as total'))
            ->groupBy('lugares.nombre')
            ->orderByDesc('total')
            ->get();

        $inicioEntregas = now()->startOfDay();
        $finEntregas = now()->addDays(13)->endOfDay();

        $entregasPorDia = DB::table('pedidos')
            ->whereNotNull('fecha_hora_entrega')
            ->whereBetween('fecha_hora_entrega', [$inicioEntregas, $finEntregas])
            ->selectRaw('DATE(fecha_hora_entrega) as dia, COUNT(*) as total')
            ->groupBy('dia')
            ->get()
            ->keyBy('dia');

        $diasEntrega = [];
        $pedidosEntregaDia = [];
        $cursor = now()->startOfDay();
        for ($i = 0; $i < 14; $i++) {
            $key = $cursor->toDateString();
            $diasEntrega[] = $cursor->format('d/m');
            $pedidosEntregaDia[] = (int) ($entregasPorDia[$key]->total ?? 0);
            $cursor->addDay();
        }

        return view('ortea.inicio', compact(
            'ventasUltimoMes',
            'pedidosUltimoMes',
            'porCobrarPendiente',
            'pendientesEntrega',
            'ventasPorLugar',
            'dias',
            'pedidosPorDia',
            'ventasPorDia',
            'diasEntrega',
            'pedidosEntregaDia'
        ));
    }
}
