<?php

namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\Project;
use App\Models\Insurer;
use App\Models\Province;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class ProjectDataTable extends BaseDataTable
{

    public $tableId = 'projects';
    public $createRoute = 'project.create';
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
            ->addColumn('state_id', function($obj){
                return $obj->province ? $obj->province->name : 'N/A';
            })
            ->addColumn('city_id', function($obj){
                return $obj->city ? $obj->city->name : 'N/A';
            })
            ->addColumn('actions', function($obj){
                return view('project_management.actions',compact('obj'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name')) && $request->get('name') != 'all') {
                    $instance->where('projects.id',  $request->get('name') );
                }
                if (!empty($request->get('state')) && $request->get('state') != 'all') {
                    $instance->where('projects.state_id',  $request->get('state') );
                }
                if (!empty($request->get('city')) && $request->get('city') != 'all') {
                    $instance->where('projects.city_id',  $request->get('city') );
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
    public function query(Project $model)
    {
        return $model->from(TableName(Project::class).' as projects')
            ->join(TableName(Insurer::class).' as insurer','projects.oblige_id', '=' ,'insurer.id')
            ->select(
                'projects.*',
                'insurer.name as insurer_name'
            )->orderBy('projects.id', 'DESC')
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
            Column::make('id')->title('ID'),
            Column::computed('name')->title('Project Name'),
            Column::computed('state_id')->title('Project State'),
            Column::computed('city_id')->title('Project City'),
            Column::computed('bid_date')->title('Bid Date'),
            Column::computed('bid_amount')->title('Bid Amount'),
            Column::computed('gpm')->title('GPM%'),
            Column::computed('engineer_name')->title('Engineer Name'),
            Column::computed('delivery_method')->title('Project Delivery Method'),
            Column::computed('start_date')->title('Estimate Project Start Date'),
            Column::computed('completion_date')->title('Estimate Project Completion Date'),
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
        $projects  = Project::from(TableName(Project::class).' as projects')
            ->leftJoin(TableName(Province::class).' as state', 'projects.state_id', '=', 'state.id')
            ->leftJoin(TableName(City::class).' as cities', 'projects.city_id', '=', 'cities.id')
            ->select(
                'projects.id as p_id',
                'projects.name as p_name',
                'state.id as state_id',
                'state.name as state_name',
                'cities.id as city_id',
                'cities.name as city_name'
            )
            ->orderBy('projects.name', 'DESC')
            ->get();
        $names['all'] = 'All';
        $states['all'] = 'All';
        $cities['all'] = 'All';
        foreach ($projects as $obj){
            $names[$obj->p_id]          = $obj->p_name;
            $states[$obj->state_id]  = $obj->state_name;
            $cities[$obj->city_id]      = $obj->city_name;
        }
        return [
            'name'  => [ 'title' => 'Project Name','options' => $names,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'state'  => [ 'title' => 'Project State','options' => $states,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'city'  => [ 'title' => 'Project City','options' => $cities,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],

        ];
    }
}



