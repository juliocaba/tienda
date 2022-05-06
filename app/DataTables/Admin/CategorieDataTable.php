<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Categorie;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategorieDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->editColumn('enabled', function ($query) {
            $checked = $query->enabled ? 'checked' : '';
            return
            '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">'.
                '<input type="checkbox" class="custom-control-input" name="enabled" value="'.$query->id.'" '.$checked.' id="customSwitch'.$query->id.'">'.
                '<label class="custom-control-label" for="customSwitch'.$query->id.'"></label>'.
            '</div>';
            })->addColumn('action', 'admin.categories.datatables_actions')
            ->addColumn('image', function ($query) {               
                return '<img src="/'.$query->image.'" width="40"/>';            
                /* return '<img src="/'.$query->image.'" width="40"/>';             */    
            })->rawColumns(['action','image', 'enabled']);
        /* return $dataTable->addColumn('action', 'admin.categories.datatables_actions'); */
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Categorie $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Categorie $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => new \Yajra\DataTables\Html\Column(['title' => 'ID', 'data' => 'id', 'name' => 'id']),
            'name' => new \Yajra\DataTables\Html\Column(['title' => 'Nombre', 'data' => 'name', 'name' => 'name']),
            'url' => new \Yajra\DataTables\Html\Column(['title' => 'Imagen', 'data' => 'image', 'name' => 'image'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categories_datatable_' . time();
    }
}
