<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\Insurer;
use App\Models\Province;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class InsurerDataTable extends BaseDataTable
{

    public $tableId = 'insurers';
    public $createRoute = 'insurer.create';
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
//            ->addColumn('status', function($obj){
//                if($obj->status)
//                    return "<span class='badge bg-success '>Active</span> ";
//                return "<span class='badge bg-primary '>InActive</span> ";
//            })
            ->addColumn('actions', function($obj){
                return view('insurers.actions',compact('obj'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name')) AND $request->get('name') != 'all') {
                    $instance->where('ins.id', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
                if (!empty($request->get('city')) AND $request->get('city') != 'all') {
                    $instance->where('ins.city_id', $request->get('city'));
                }
                if (!empty($request->get('state')) AND $request->get('state') != 'all') {
                    $instance->where('ins.state_id', $request->get('state'));
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
    public function query(Insurer $model)
    {
        return $model->newQuery()
            ->from(TableName(Insurer::class) . ' as ins')
            ->leftJoin(TableName(Province::class) . ' as state', 'ins.state_id', '=', 'state.id')
            ->leftJoin(TableName(City::class) . ' as city', 'ins.city_id', '=', 'city.id')
            ->select('ins.*','state.name as state_name'
                ,'city.name as city_name')
            ->orderByDesc('ins.id');
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
            Column::make('am_best_rating')->title('AM Best Rating'),
//            Column::make('state_name')->title('State'),
            Column::make('city_name')->title('City'),
            Column::make('cbu_name')->title('Contract Bond Underwriter'),
            Column::make('clbu_name')->title('Commercial Bond Underwriter'),

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
        return 'insurer_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $insurers['all'] = 'Select Name';
        $insurerList = Insurer::select('id','name')->get();
        foreach($insurerList as $insurer){
            $insurers[$insurer->id]= $insurer->name;
        }
        $cities['all'] = 'Select City';
        $citiesList  = City::select('id','name')->where('status',true)->get();
        foreach($citiesList as $city){
            $cities[$city->id]= $city->name;
        }
        $states['all'] = 'Select State';
        $statesList  = Province::select('id','name')->where('status',true)->get();
        foreach($statesList as $state){
            $states[$state->id]= $state->name;
        }
        return [
            'name'  => [ 'title' => 'Name','options' => $insurers,'id'=>'role-filter', 'placeholder'=>'Select Name', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'city'  => [ 'title' => 'City','options' => $cities,'id'=>'role-filter1', 'placeholder'=>'Select City', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
//            'state'  => [ 'title' => 'State','options' => $states,'id'=>'role-filter2', 'placeholder'=>'Select State', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
