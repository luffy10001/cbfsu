<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\Customer;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class CustomerDataTable extends BaseDataTable
{

    public $tableId = 'customers';
    public $createRoute = 'customer.create';
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
            ->addColumn('positions', function($obj){
                if($obj->positions)
                    return positions()[$obj->positions];
                return "N/A";
            })
            ->addColumn('status', function($obj){
                if($obj->status)
                    return "<span class='badge bg-success '>Active</span> ";
                return "<span class='badge bg-primary '>InActive</span> ";
            })
            ->addColumn('actions', function($obj){
                return view('customers.actions',compact('obj'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('name')) AND $request->get('name') != 'all') {
                    $instance->where('cust.id', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
                if (!empty($request->get('city')) AND $request->get('city') != 'all') {
                    $instance->where('cust.city_id', $request->get('city'));
                }
                if (!empty($request->get('state')) AND $request->get('state') != 'all') {
                    $instance->where('cust.state_id', $request->get('state'));
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
    public function query(Customer $model)
    {
        return $model->newQuery()
            ->from(TableName(Customer::class) . ' as cust')
            ->leftJoin(TableName(User::class) . ' as user', 'cust.user_id', '=', 'user.id')
            ->leftJoin(TableName(Province::class) . ' as state', 'cust.state_id', '=', 'state.id')
            ->leftJoin(TableName(City::class) . ' as city', 'cust.city_id', '=', 'city.id')
            ->select('cust.*', 'user.name as name', 'user.email as email', 'user.status as status','state.name as state_name'
            ,'city.name as city_name')
            ->orderByDesc('cust.id');

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
//            Column::make('contact_name')->title('Contact Name'),
            Column::make('email')->title('Email Address'),
            Column::make('phone'),
//            Column::computed('positions')->title('Position Title'),
//            Column::make('signed_in')->title('Date Signed'),
//            Column::make('zip'),
            Column::make('city_name')->title('City'),
//            Column::make('state_name')->title('State'),
//            Column::make('address'),
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
        return 'customer_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $datas['all'] = 'Select Name';
        $objs  = Customer::from(TableName(Customer::class) . ' as cust')
            ->leftJoin(TableName(User::class) . ' as user', 'cust.user_id', '=', 'user.id')
            ->select('user.name as name', 'cust.id as id')
            ->get();
        foreach($objs as $obj){
            $datas[$obj->id]= $obj->name;
        }
        $cities['all'] = 'Select State';
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
            'name'  => [ 'title' => 'Name','options' => $datas,'id'=>'role-filter', 'placeholder'=>'Select Name', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'city'  => [ 'title' => 'City','options' => $cities,'id'=>'role-filter1', 'placeholder'=>'Select City', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'state'  => [ 'title' => 'State','options' => $states,'id'=>'role-filter2', 'placeholder'=>'Select State', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
