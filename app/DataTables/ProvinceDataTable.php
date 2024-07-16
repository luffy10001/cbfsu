<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Department;
use App\Models\Province; 
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class ProvinceDataTable extends BaseDataTable
{

    public $tableId = 'province';
    public $createRoute = 'state.create';
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
            ->addColumn('actions', function($province){
                return view('province.actions',compact('province'));
            })
            ->addColumn('created_at', function($province){
                return crm_date_format($province->created_at);
            })
            ->addColumn('updated_at', function($province){
                return crm_date_format($province->updated_at);
            })
            ->addColumn('status', function($province){
                if($province->status)
                    return "<span class='badge bg-success '>Active</span> ";
                return "<span class='badge bg-primary '>In-Active</span> ";
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name'))) {
                    $instance->where('name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
            })
            ->rawColumns(['actions','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Province $model)
    {
        return $model->orderByDesc('id')
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
         return $this->builder()
             ->setFilters($this->getFilters())
             ->setTableId($this->tableId)
             ->columns($this->getColumns())
             ->minifiedAjax()
//             ->dom('Bfrtip')
             ->dom("<lf<t>ip>")
             /* ->orderBy(1)*/
             ->pageLength(10)
             ->buttons(
                 $this->buttons()
             )->parameters([
                 'dom'          => 'Bfrtip',
                 'buttons'      => ['csv','excel'],
                 'preDrawCallback' => "function(){showLoader()}",
                 'drawCallback' => "function(){hideLoader()}"
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
            Column::make('id'),
            Column::make('name'),
            Column::computed('status'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() :string
    {
        return 'Province_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        return [
            'name'  => ['title' => 'Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
        ];
    }
}
