<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableOficinaEmisora extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $orderBy = 'id';
    public $orderAsc = true;
    public $page = 1;

    public $search_nombre = '';

    public function render()
    {
        $query = DB::table('oficinas_emisoras')
            ->select(
                'oficinas_emisoras.id',
                'oficinas_emisoras.nombre',
            )
            ->when($this->search_nombre, function ($param) {
                $param->where('oficinas_emisoras.nombre', 'like', '%' . $this->search_nombre . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc');

        $registros = $query->paginate($this->perPage);
        if ($this->page > $registros->lastPage()) {
            $this->page = 1;
            $registros = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        }

        return view('livewire.table-oficina-emisora', compact('registros'))
            ->with('i', ($registros->currentPage() - 1) * $registros->perPage());
    }
}