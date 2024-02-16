<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Service;
use App\Models\City;
use App\Models\Community;
use App\Models\Indicator;
use App\Models\Province;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class IndicatorDataTable extends BaseDataTable
{

    public $tableId = 'services';
    public $createRoute = 'service.create';
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
            ->addColumn('name', function($service){
                if(isset($service->indicators))
                    return view('indicators.list',compact('service'));
               return "--";
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('serviceName')) && $request->get('serviceName') !='all') {
                    $instance->where('id',$request->get('serviceName'));
                }
                if (!empty($request->get('indicatorName')) && $request->get('indicatorName') !='all') {
                    $indicator = Indicator::select('id','service_id')->where('id',$request->get('indicatorName'))->first();
                    $instance->where('id',$indicator->service_id);
                }


            })
            ->rawColumns(['name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model)
    {
        return $model->where('status',true)->orderByDesc('id')
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
//            Column::make('id'),
            Column::computed('name'),
//            Column::computed('status'),
//            Column::computed('actions')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() :string
    {
        return 'services_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $services['all'] = 'All';
        $data = Service::select('id','name','status')->where('status',true)->orderBy('name')->get();
        foreach ($data as $obj ){
            $services[$obj->id] = $obj->name;
        }
        $indicators['all'] = 'All';
        $indicatorsobjs = Indicator::select('id','name','service_id')->orderBy('name')->get();
        foreach ($indicatorsobjs as $obj ){
            $indicators[$obj->id] = $obj->name;
        }
        return [
            'serviceName'  => [ 'title' => 'Service','options' => $services,'id'=>'cbo-filter', 'placeholder'=>'Select a Service', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'indicatorName'  => [ 'title' => 'Indicator','options' => $indicators,'id'=>'indi-filter', 'placeholder'=>'Select a Indicator', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
