<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Cbo;
use App\Models\City;
use App\Models\Community;
use App\Models\Indicator;
use App\Models\Province;
use App\Models\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class IndicatorDataTable extends BaseDataTable
{

    public $tableId = 'indicators';
    public $createRoute = 'indicator.create';
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
            ->addColumn('service_name', function($indicator){
                return $indicator->service_name;
            })
            ->addColumn('actions', function($indicator){
                return view('indicators.actions',compact('indicator'));
            })
//            ->filter(function ($instance) use ($request, $db_connection) {
//                if (!empty($request->get('name'))) {
//                    $instance->where('name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
//                }
//            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cbo $model)
    {
        return $model->from(TableName(Indicator::class).' as indicator')
            ->Join(TableName(Service::class).' as service','indicator.service_id','=','service.id')
            ->select('indicator.*','service.name as service_name')
            ->orderByDesc('indicator.id')
            ->groupBy('indicator.id', 'service_name')
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
    /*             ->buttons(
                 $this->buttons()
             )
    */
    ->parameters([
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
        return 'indicators_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $indicators['all'] = 'All';
        $lots['all'] = 'All';
        $indicator = Cbo::select('id','name','lot_no')->get();
        foreach ($indicator as $cb ){
            $indicators[$cb->id] = $cb->name;
            $lots[$cb->id] = $cb->lot_no;
        }
        $provinces['all'] = 'All';
        $province = Province::select('id','name')->get();
        foreach ($province as $pro ){
            $provinces[$pro->id] = $pro->name;
        }
         return [
            'name'  => [ 'title' => 'CBO Name','options' => $indicators,'id'=>'indicator-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'province'  => [ 'title' => 'Province Name','options' => $provinces,'id'=>'indicator-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'lot'  => [ 'title' => 'Lot Number','options' => $lots,'id'=>'indicator-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
