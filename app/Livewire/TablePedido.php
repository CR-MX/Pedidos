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

    public function render()
    {
        $query = DB::table('pedidos')
            ->leftJoin('lugares', 'pedidos.lugar_id', '=', 'lugares.id')
            ->select(
                'pedidos.id',
                'pedidos.nombre',
                'pedidos.red_social',
                'pedidos.anticipo',
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
