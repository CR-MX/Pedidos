<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Lugare;

class TablePedido extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $orderBy = 'dias_restantes';
    public $orderAsc = false;
    public $page = 1;

    public $search_nombre = '';
    public $search_red_social = '';
    public $search_anticipo = '';
    public $search_por_cobrar = '';
    public $search_dias_restantes = '';
    public $search_fecha_hora = '';
    public $search_entrega = 'pendiente';
    public $search_lugar = '';

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

    public function confirmarEntrega($pedidoId)
    {
        Pedido::where('id', $pedidoId)->update(['entrega' => 'entregado']);
        $this->dispatch('pedido-entregado');
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
                'pedidos.entrega',
                'lugares.nombre as lugar_nombre',
            )
            ->when($this->search_nombre, function ($param) {
                $param->where('pedidos.nombre', 'like', '%' . $this->search_nombre . '%');
            })
            ->when($this->search_red_social, function ($param) {
                $param->where('pedidos.red_social', $this->search_red_social);
            })
            ->when($this->search_anticipo, function ($param) {
                $param->where('pedidos.anticipo', 'like', '%' . $this->search_anticipo . '%');
            })
            ->when($this->search_por_cobrar, function ($param) {
                $param->whereRaw('(pedidos.total - pedidos.anticipo) like ?', ['%' . $this->search_por_cobrar . '%']);
            })
            ->when($this->search_dias_restantes, function ($param) {
                $param->whereRaw('DATEDIFF(pedidos.fecha_hora_entrega, CURDATE()) like ?', ['%' . $this->search_dias_restantes . '%']);
            })
            ->when($this->search_fecha_hora, function ($param) {
                $param->whereDate('pedidos.fecha_hora_entrega', $this->search_fecha_hora);
            })
            ->when($this->search_entrega, function ($param) {
                $param->where('pedidos.entrega', $this->search_entrega);
            })
            ->when($this->search_lugar, function ($param) {
                $param->where('pedidos.lugar_id', $this->search_lugar);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc');

        $registros = $query->paginate($this->perPage);
        if ($this->page > $registros->lastPage()) {
            $this->page = 1;
            $registros = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        }

        $lugares = Lugare::orderBy('nombre')->get();

        return view('livewire.table-pedido', compact('registros', 'lugares'))
            ->with('i', ($registros->currentPage() - 1) * $registros->perPage());
    }
}