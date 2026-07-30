<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableCredenciale extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $orderBy = 'id';
    public $orderAsc = true;
    public $page = 1;

    public $search_nombre_completo = '';
    public $search_curp = '';
    public $search_numero_licencia = '';

    public function render()
    {
        $query = DB::table('credenciales')
            ->leftJoin('oficinas_emisoras', 'credenciales.oficina_emisora_id', '=', 'oficinas_emisoras.id')
            ->select(
                'credenciales.id',
                'credenciales.foto',
                'credenciales.firma',
                'credenciales.curp',
                'credenciales.apellido_paterno',
                'credenciales.apellido_materno',
                'credenciales.nombres',
                'credenciales.fecha_nacimiento',
                'credenciales.fecha_expedicion',
                'credenciales.fecha_vencimiento',
                'credenciales.tipo_licencia',
                'credenciales.numero_licencia',
                'oficinas_emisoras.nombre as oficina_nombre',
                'credenciales.fecha_antiguedad',
                'credenciales.sexo',
                'credenciales.tipo_sangre',
                'credenciales.donador_organos',
                'credenciales.restricciones',
                'credenciales.en_caso_accidente_nombre',
                'credenciales.en_caso_accidente_numero',
            )
            ->when($this->search_nombre_completo, function ($param) {
                $param->where(function ($q) {
                    $q->where('credenciales.nombres', 'like', '%' . $this->search_nombre_completo . '%')
                      ->orWhere('credenciales.apellido_paterno', 'like', '%' . $this->search_nombre_completo . '%')
                      ->orWhere('credenciales.apellido_materno', 'like', '%' . $this->search_nombre_completo . '%');
                });
            })
            ->when($this->search_curp, function ($param) {
                $param->where('credenciales.curp', 'like', '%' . $this->search_curp . '%');
            })
            ->when($this->search_numero_licencia, function ($param) {
                $param->where('credenciales.numero_licencia', 'like', '%' . $this->search_numero_licencia . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc');

        $registros = $query->paginate($this->perPage);
        if ($this->page > $registros->lastPage()) {
            $this->page = 1;
            $registros = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        }

        return view('livewire.table-credenciale', compact('registros'))
            ->with('i', ($registros->currentPage() - 1) * $registros->perPage());
    }
}
