<?php

namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\ProjectManagement;
use App\Models\Insurer;
use App\Models\Province;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class ProjectMangementDataTable extends BaseDataTable
{

    public $tableId = 'project_managements';
    public $createRoute = 'project-management.create';
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
            ->addColumn('project_state', function($obj){
                return $obj->provinceName ? $obj->provinceName->name : 'N/A';
            })
            ->addColumn('project_city', function($obj){
                return $obj->cityName ? $obj->cityName->name : 'N/A';
            })

//
//            ->addColumn('job_duration_combined', function($obj){
//                $job_duration = $obj->job_duration;
//                $job_duration_unit = days_unit()[$obj->job_duration_unit];
//                return "{$job_duration} {$job_duration_unit}";
//            })
//
//            ->addColumn('warranty_duration_combined', function($obj){
//                $warranty_duration = $obj->warranty_duration;
//                $warranty_duration_unit = days_unit()[$obj->warranty_duration_unit];
//                return "{$warranty_duration} {$warranty_duration_unit}";
//            })
//
//            ->addColumn('payment_interval_combined', function($obj){
//                $payment_interval = $obj->payment_interval;
//                $payment_interval_unit = days_unit()[$obj->payment_interval_unit];
//                return "{$payment_interval} {$payment_interval_unit}";
//            })
//
//            ->addColumn('maintenance_limit_combined', function($obj){
//                $maintenance_limit = $obj->maintenance_limit;
//                $maintenance_limit_unit = days_unit()[$obj->maintenance_limit_unit];
//                return "{$maintenance_limit} {$maintenance_limit_unit}";
//            })
//
//            ->addColumn('a', function($obj){
//                $maintenance_limit = $obj->maintenance_limit;
//                $maintenance_limit_unit = days_unit()[$obj->maintenance_limit_unit];
//                return "{$maintenance_limit} {$maintenance_limit_unit}";
//            })
            ->addColumn('actions', function($obj){
                return view('project_management.actions',compact('obj'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('engineer_name'))) {
                    $instance->where('engineer_name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('engineer_name') . "%");
                }
                if (!empty($request->get('project_name'))) {
                    $instance->where('project_name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('project_name') . "%");
                }
                if (!empty($request->get('project_state')) && $request->get('project_state') != 'all') {
                    $instance->where('project_state',  $request->get('project_state') );
                }
                if (!empty($request->get('city_name')) && $request->get('city_name') != 'all') {
                    $instance->where('project_city',  $request->get('city_name') );
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
    public function query(ProjectManagement $model)
    {
        return $model->from(TableName(ProjectManagement::class).' as project_managements')
            ->join(TableName(Insurer::class).' as insurer','project_managements.obligee_id', '=' ,'insurer.id')
            ->select(
                'project_managements.*',
                'insurer.name as insurer_name'
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
            Column::computed('bid_date')->title('Bid Date'),
            Column::computed('bid_amount')->title('Bid Amount'),
            Column::computed('gpm')->title('GPM%'),
            Column::computed('engineer_name')->title('Engineer Name'),
            Column::computed('project_name')->title('Project Name'),
            Column::computed('project_state')->title('Project State'),
            Column::computed('project_city')->title('Project City'),
            Column::computed('project_delivery_method')->title('Project Delivery Method'),
            Column::computed('estimated_project_start_date')->title('Estimate Project Start Date'),
            Column::computed('estimated_project_completion_date')->title('Estimate Project Completion Date'),


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
//        return 'agents_' . date('YmdHis');
    }

    public function getFilters(): array
    {

//        $datas['all'] = 'All State';
//        $province_value  = ProjectManagement::from(TableName(ProjectManagement::class).' as pj')
//            ->join(TableName(Province::class).' as province','pj.project_state', '=' ,'province.id')
//            ->select('province.name', 'province.id')
//            ->get();
//        foreach($province_value as $obj){
//            $datas[$obj->id]= $obj->name;
//        }

//        $city_data['all'] = 'All City';
//        $city_value  = ProjectManagement::from(TableName(ProjectManagement::class).' as pj')
//            ->join(TableName(City::class).' as city','pj.project_city', '=' ,'city.id')
//            ->select('city.name', 'city.id')
//            ->get();
//        foreach($city_value as $obj){
//            $city_data[$obj->id]= $obj->name;
//        }

        return [
            'engineer_name'  => ['title' => 'Engineer Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'project_name'  => ['title' => 'Project Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],

//            'project_state'  => [
//                'target'=>"select[name=city_name]",
//                'url'=>  route('state.get-cities'),
//                'params'=>'province_id',
//                'title' => 'Department ',
//                'options'=>$datas,
//                'placeholder'=>'All City',
//                'class' => 'form-select changeInputMws input_province_id filter-dropdown',
//                'prefix' => '_0',
//                'type' => 'select',
//                'condition' => 'like',
//                'active' => true],
//
//            'city_name' => [
//                'disabled'=>true,
//                'title' => 'Area',
//                'options'=>$city_data,
//                'id'=>'area-filter',
//                'placeholder' => '',
//                'class' => 'filter-dropdown',
//                'type' => 'select',
//                'condition' => 'like',
//                'active' => true
//            ],

        ];
    }
}



