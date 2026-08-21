<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoCoco;
use App\Models\LugareCoco;

class TablePedidoCoco extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $orderBy = 'dias_restantes';
    public $orderAsc = false;
    public $page = 1;

    public $search_nombre = '';
    public $search_fecha_hora = '';
    public $search_entrega = 'pendiente';
    public $search_lugar = '';

    public $selectedPedidoId = null;
    public $selectedPedidoNombre = null;
    public $articulos = [];

    public function verArticulos($pedidoId)
    {
        $this->selectedPedidoId = $pedidoId;
        $this->selectedPedidoNombre = PedidoCoco::find($pedidoId)?->nombre;
        $this->articulos = DB::table('articulos_pedidos_cocos')
            ->leftJoin('tipos_cocos', 'articulos_pedidos_cocos.tipo_id', '=', 'tipos_cocos.id')
            ->select('articulos_pedidos_cocos.*', 'tipos_cocos.nombre as tipo_nombre')
            ->where('articulos_pedidos_cocos.pedido_id', $pedidoId)
            ->get();
    }

    public function cerrarModal()
    {
        $this->selectedPedidoId = null;
        $this->selectedPedidoNombre = null;
        $this->articulos = [];
    }

    public function confirmarEntrega($pedidoId)
    {
        PedidoCoco::where('id', $pedidoId)->update([
            'entrega' => 'entregado',
            'anticipo' => DB::raw('total'),
        ]);
        $this->dispatch('pedido-entregado');
    }

    public function render()
    {
        $query = DB::table('pedidos_cocos')
            ->leftJoin('lugares_cocos', 'pedidos_cocos.lugar_id', '=', 'lugares_cocos.id')
            ->select(
                'pedidos_cocos.id',
                'pedidos_cocos.nombre',
                'pedidos_cocos.red_social',
                'pedidos_cocos.anticipo',
                DB::raw('(pedidos_cocos.total - pedidos_cocos.anticipo) as por_cobrar'),
                DB::raw('DATEDIFF(pedidos_cocos.fecha_hora_entrega, CURDATE()) as dias_restantes'),
                'pedidos_cocos.fecha_hora_entrega',
                'pedidos_cocos.lugar_id',
                'pedidos_cocos.informacion_adicional',
                'pedidos_cocos.entrega',
                DB::raw('(SELECT COUNT(*) FROM articulos_pedidos_cocos WHERE pedido_id = pedidos_cocos.id) as total_articulos'),
                DB::raw('(SELECT COUNT(*) FROM articulos_pedidos_cocos WHERE pedido_id = pedidos_cocos.id AND realizado = 1) as realizados_articulos'),
                'lugares_cocos.nombre as lugar_nombre',
            )
            ->when($this->search_nombre, function ($param) {
                $param->where('pedidos_cocos.nombre', 'like', '%' . $this->search_nombre . '%');
            })
            ->when($this->search_fecha_hora, function ($param) {
                $param->whereDate('pedidos_cocos.fecha_hora_entrega', $this->search_fecha_hora);
            })
            ->when($this->search_entrega, function ($param) {
                $param->where('pedidos_cocos.entrega', $this->search_entrega);
            })
            ->when($this->search_lugar, function ($param) {
                $param->where('pedidos_cocos.lugar_id', $this->search_lugar);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc');

        $registros = $query->paginate($this->perPage);
        if ($this->page > $registros->lastPage()) {
            $this->page = 1;
            $registros = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        }

        $lugares = LugareCoco::orderBy('nombre')->get();

        return view('livewire.table-pedido-coco', compact('registros', 'lugares'))
            ->with('i', ($registros->currentPage() - 1) * $registros->perPage());
    }
}
