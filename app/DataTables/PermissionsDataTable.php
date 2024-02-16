<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class PermissionsDataTable extends BaseDataTable
{
    public $tableId = 'permissions';
    public $createRoute = 'permissions.create';
      /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $request = new DataTablesRequest();
        $db_connection = env('DB_CONNECTION');
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function($permission){
                return '<div class="dropdown mx-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item modal_open" url="'.route('permissions.edit',$permission->id).'">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>';})
            ->addColumn('created_at', function($permission){
                return crm_date_format($permission->created_at);
            })
            ->addColumn('updated_at', function($permission){
                return crm_date_format($permission->updated_at);
            })->addColumn('is_active',function($permission){
                return $permission->is_active == 0 ? 'No' : 'Yes';

            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name'))) {
                    $instance->where('name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Permission $model)
    {
        return $model
            ->orderBy('id', 'desc')->with('role')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
         return $this->builder()
             ->setFilters($this->getFilters())
             ->setTableId($this->tableId)
             ->columns($this->getColumns())
             ->minifiedAjax()
             ->dom("<lf<t>ip>")
             /* ->orderBy(1)*/
             ->pageLength(10)
             ->buttons(
                 $this->buttons()
             )->parameters([
                 'dom'          => 'Bfrtip',
                 'buttons'      => ['csv','excel'],
                 'preDrawCallback' => "function(){window.showLoader()}",
                 'drawCallback' => "function(){window.hideLoader()}"
             ]);
    }


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('route_name'),
            Column::make('role.name')->title('Role'),
            Column::make('is_active')->title('Active'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Permissions_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        return [
            'name'  => ['title' => 'Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
        ];
    }
}
