<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\Province;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class CityDataTable extends BaseDataTable
{

    public $tableId = 'cities';
    public $createRoute = 'city.create';
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
            ->addColumn('province_id', function($city){
                if(isset($city->provinces)){
                    return $city->provinces->name;
                }
                return '--';

            })
            ->addColumn('status', function($city){
                if($city->status)
                    return "<span class='badge bg-success '>Active</span> ";
                return "<span class='badge bg-primary '>In-Active</span> ";
            })
            ->addColumn('actions', function($city){
                return view('cities.actions',compact('city'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name'))) {
                    $instance->where('name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
                if (!empty($request->get('provinces')) && $request->get('provinces') !='all'){
                    $instance->where('province_id',$request->get('provinces'));
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
    public function query(City $model)
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
            Column::computed('province_id')->title('Province'),
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
        return 'cities_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $datas['all'] = 'Select a Province';
        $provices  = Province::select('id','name','status')->where('status',true)->get();
        foreach($provices as $obj){
            $datas[$obj->id]= $obj->name;
        }
        return [
            'name'  => ['title' => 'Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'provinces'  => [ 'title' => 'Province','options' => $datas,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
