<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TablePedido extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $orderBy = 'id';
    public $orderAsc = true;
    public $page = 1;

    public $search_nombre = '';
    public $search_red_social = '';

    public $selectedPedidoId = null;
    public $articulos = [];

    public function verArticulos($pedidoId)
    {
        $this->selectedPedidoId = $pedidoId;
        $this->articulos = DB::table('articulos_pedidos')
            ->leftJoin('tipos', 'articulos_pedidos.tipo_id', '=', 'tipos.id')
            ->select('articulos_pedidos.*', 'tipos.nombre as tipo_nombre')
            ->where('articulos_pedidos.pedido_id', $pedidoId)
            ->get();
    }

    public function cerrarModal()
    {
        $this->selectedPedidoId = null;
        $this->articulos = [];
    }

    public function render()
    {
        $query = DB::table('pedidos')
            ->leftJoin('lugares', 'pedidos.lugar_id', '=', 'lugares.id')
            ->select(
                'pedidos.id',
                'pedidos.nombre',
                'pedidos.red_social',
                'pedidos.anticipo',
                DB::raw('(pedidos.total - pedidos.anticipo) as por_cobrar'),
                DB::raw('DATEDIFF(pedidos.fecha_hora_entrega, CURDATE()) as dias_restantes'),
                'pedidos.fecha_hora_entrega',
                'pedidos.lugar_id',
                'pedidos.informacion_adicional',
                'lugares.nombre as lugar_nombre',
            )
            ->when($this->search_nombre, function ($param) {
                $param->where('pedidos.nombre', 'like', '%' . $this->search_nombre . '%');
            })
            ->when($this->search_red_social, function ($param) {
                $param->where('pedidos.red_social', 'like', '%' . $this->search_red_social . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc');

        $registros = $query->paginate($this->perPage);
        if ($this->page > $registros->lastPage()) {
            $this->page = 1;
            $registros = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        }

        return view('livewire.table-pedido', compact('registros'))
            ->with('i', ($registros->currentPage() - 1) * $registros->perPage());
    }
}