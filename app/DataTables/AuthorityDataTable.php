<?php

namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\Authority;
use App\Models\Insurer;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class AuthorityDataTable extends BaseDataTable
{

    public $tableId = 'authorities';
    public $createRoute = 'authority.create';
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
            ->addColumn('territory_combined', function($obj){
                $territory = $obj->territory;
                $territory_unit = territory_units()[$obj->territory_unit];
                return "{$territory} {$territory_unit}";
            })

            ->addColumn('job_duration_combined', function($obj){
                $job_duration = $obj->job_duration;
                $job_duration_unit = days_unit()[$obj->job_duration_unit];
                return "{$job_duration} {$job_duration_unit}";
            })

            ->addColumn('warranty_duration_combined', function($obj){
                $warranty_duration = $obj->warranty_duration;
                $warranty_duration_unit = days_unit()[$obj->warranty_duration_unit];
                return "{$warranty_duration} {$warranty_duration_unit}";
            })

            ->addColumn('payment_interval_combined', function($obj){
                $payment_interval = $obj->payment_interval;
                $payment_interval_unit = days_unit()[$obj->payment_interval_unit];
                return "{$payment_interval} {$payment_interval_unit}";
            })

            ->addColumn('maintenance_limit_combined', function($obj){
                $maintenance_limit = $obj->maintenance_limit;
                $maintenance_limit_unit = days_unit()[$obj->maintenance_limit_unit];
                return "{$maintenance_limit} {$maintenance_limit_unit}";
            })

            ->addColumn('a', function($obj){
                $maintenance_limit = $obj->maintenance_limit;
                $maintenance_limit_unit = days_unit()[$obj->maintenance_limit_unit];
                return "{$maintenance_limit} {$maintenance_limit_unit}";
            })
            ->addColumn('actions', function($obj){
                return view('authority.action',compact('obj'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name') && $request->get('name') !='all')) {
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
    public function query(Authority $model)
    {
        return $model->from(TableName(Authority::class).' as at')
            ->join(TableName(Insurer::class).' as ins','at.insurer_id', '=' ,'ins.id')
            ->select(
                'at.*',
                'ins.name as insurer_name'
            )->newQuery();
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
            Column::make('id')->title('ID'),
            Column::computed('insurer_name')->title('Insurer Name'),
            Column::make('start_date')->title('Start Date'),
            Column::make('expiry_date')->title('Expire Date'),
            Column::make('single_job_limit')->title('Single Job Limit'),
            Column::make('aggregate_limit')->title('Aggregate Limit'),
            Column::make('territory_combined')->title('Territory'),
            Column::make('job_duration_combined')->title('Job Duration'),
            Column::make('warranty_duration_combined')->title('Warranty Duration Limit'),
            Column::make('payment_interval_combined')->title('Payment Interval'),
            Column::make('minimum_bid')->title('Minimum Bid(%)'),
            Column::make('maintenance_limit_combined')->title('Maintenance Limit'),

            Column::computed('actions')
                ->title('Action')
                ->exportable(true)
                ->printable(true)
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
        return 'agents_' . date('YmdHis');
    }

    public function getFilters(): array
    {

        $datas['all'] = 'Select Insurer Name';
        $objs  = Authority::from(TableName(Authority::class).' as at')
        ->join(TableName(Insurer::class).' as ins','at.insurer_id', '=' ,'ins.id')->get();
        foreach($objs as $obj){
            $datas[$obj->id]= $obj->name;
        }

        return [
            'name'  => [ 'title' => 'Insurer Name','options' => $datas,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}



