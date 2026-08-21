<?php

namespace App\Http\Controllers;

use App\Models\PedidoCoco;
use App\Models\LugareCoco;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeControllerCoco extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:EmpCocoSublime');
    }

    public function index()
    {
        return view('home');
    }

    public function inicio()
    {
        $hoy = Carbon::now();
        $inicioMes = $hoy->copy()->startOfMonth();
        $finMes = $hoy->copy()->endOfMonth();

        $ventasUltimoMes = PedidoCoco::whereBetween('fecha_hora_entrega', [$inicioMes, $finMes])->sum('total');
        $pedidosUltimoMes = PedidoCoco::whereBetween('fecha_hora_entrega', [$inicioMes, $finMes])->count();

        $porCobrarPendiente = PedidoCoco::where('entrega', 'pendiente')
            ->selectRaw('SUM(total - anticipo) as total')
            ->value('total') ?? 0;

        $pendientesEntrega = PedidoCoco::where('entrega', 'pendiente')->count();

        $ventasPorLugar = PedidoCoco::join('lugares_cocos', 'pedidos_cocos.lugar_id', '=', 'lugares_cocos.id')
            ->whereBetween('pedidos_cocos.fecha_hora_entrega', [$inicioMes, $finMes])
            ->select('lugares_cocos.nombre as lugar', DB::raw('SUM(pedidos_cocos.total) as total'))
            ->groupBy('lugares_cocos.nombre')
            ->get();

        $diasPedidos = [];
        $pedidosDiarios = [];
        $diasVentas = [];
        $ventasDiarias = [];
        $diasEntregas = [];
        $entregasDiarias = [];

        for ($i = 14; $i >= 0; $i--) {
            $dia = $hoy->copy()->subDays($i)->toDateString();
            $diasPedidos[] = $hoy->copy()->subDays($i)->format('d/m');
            $pedidosDiarios[] = PedidoCoco::whereDate('created_at', $dia)->count();
            $diasVentas[] = $hoy->copy()->subDays($i)->format('d/m');
            $ventasDiarias[] = PedidoCoco::whereDate('fecha_hora_entrega', $dia)->sum('total');
        }

        for ($i = 0; $i <= 14; $i++) {
            $dia = $hoy->copy()->addDays($i)->toDateString();
            $diasEntregas[] = $hoy->copy()->addDays($i)->format('d/m');
            $entregasDiarias[] = PedidoCoco::whereDate('fecha_hora_entrega', $dia)
                ->where('entrega', 'pendiente')->count();
        }

        return view('coco.inicio', compact(
            'ventasUltimoMes',
            'pedidosUltimoMes',
            'porCobrarPendiente',
            'pendientesEntrega',
            'ventasPorLugar',
            'diasPedidos',
            'pedidosDiarios',
            'diasVentas',
            'ventasDiarias',
            'diasEntregas',
            'entregasDiarias',
        ));
    }
}
