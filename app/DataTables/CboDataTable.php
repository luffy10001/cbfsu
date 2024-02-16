<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Cbo;
use App\Models\City;
use App\Models\Community;
use App\Models\Province;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class CboDataTable extends BaseDataTable
{

    public $tableId = 'cbos';
    public $createRoute = 'cbo.create';
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

            ->addColumn('province_name', function($cbo){
                return $cbo->province_name;
            })
            ->addColumn('actions', function($cbo){
                return view('cbos.actions',compact('cbo'));
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
    public function query(Cbo $model)
    {
        return $model->from(TableName(Cbo::class).' as cbo')
            ->Join(TableName(Province::class).' as province','cbo.province_id','=','province.id')
            ->Join(TableName(City::class).' as city','cbo.city_id','=','city.id')
            ->Join(TableName(Community::class).' as community','cbo.community_id','=','community.id')
            ->select('cbo.*','province.name as province_name','city.name as city_name','community.name as community_name')
            ->orderByDesc('cbo.id')
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
            Column::make('lot_no')->title('Lot Number'),
            Column::make('community_name')->title('Community Served'),
            Column::make('province_name')->title('Province'),
            Column::make('city_name')->title('City/Region of Service'),
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
        return 'cbos_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $cbos['all'] = 'All';
        $lots['all'] = 'All';
        $cbo = Cbo::select('id','name','lot_no')->get();
        foreach ($cbo as $cb ){
            $cbos[$cb->id] = $cb->name;
            $lots[$cb->id] = $cb->lot_no;
        }
        $provinces['all'] = 'All';
        $province = Province::select('id','name')->get();
        foreach ($province as $pro ){
            $provinces[$pro->id] = $pro->name;
        }
         return [
            'name'  => [ 'title' => 'CBO Name','options' => $cbos,'id'=>'cbo-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'province'  => [ 'title' => 'Province Name','options' => $provinces,'id'=>'cbo-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'lot'  => [ 'title' => 'Lot Number','options' => $lots,'id'=>'cbo-filter', 'placeholder'=>'Select a CBO', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
