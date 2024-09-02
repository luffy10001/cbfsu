<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Bond;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class BondDataTable extends BaseDataTable
{

    public $tableId = 'bonds';
    public $createRoute = 'bond.create';
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
            ->addColumn('company_name', function($obj){
                return $obj->customer->user['name'];
            })
            ->addColumn('status', function($community){
                if($community->status)
                    return "<span class='badge bg-success '>Submitted</span> ";
                return "<span class='badge bg-primary '>Draft</span> ";
            })

            ->addColumn('actions', function($obj){
                $user = Auth::user();
                $role = $user->role;
                return view('bonds.actions',compact('obj','role'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('company_name')) AND $request->get('company_name') != 'all') {
                    $instance->where('customer_id', $request->get('company_name'));
                }

                if (!empty($request->get('owner_name'))) {
                    $instance->where('owner_name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('owner_name') . "%");
                }

                if (!empty($request->get('pb_contract_amount'))) {
                    $instance->where('pb_contract_amount',  $request->get('pb_contract_amount'));
                }


            })

            ->rawColumns(['actions','company_name','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AgentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bond $model)
    {
        $user = $this->user;
        $query = $model->newQuery();

        if (isRoleCustomer($user->role)) {
            $query = $model->from(TableName(Bond::class) . ' as bond')
                ->leftJoin(TableName(Customer::class) . ' as cus', 'bond.customer_id', '=', 'cus.id')
                ->select('bond.*')
                ->where('cus.user_id', $user->id);
        }

        return $query;
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
//             ->orderBy(0)
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
            Column::make('company_name')->title('Company Name'),
            Column::make('owner_name')->title('Oblige/Owner Name'),
            Column::make('owner_bid_date')->title('Bid Date'),
            Column::make('pb_contract_date')->title('Contract Date'),
            Column::make('pb_contract_amount')->title('Contract Amount'),
            Column::computed('status')->title('Status'),
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
            ->select('user.name as name', 'cust.id as cust_id')
            ->get();
        foreach($objs as $obj){
            $datas[$obj->cust_id]= $obj->name;
        }

        $user = Auth::user();
        $role = $user->role;
        if(isRoleSuperAdmin($role)){
            $re['company_name'] = [ 'title' => 'Name','options' => $datas,'id'=>'role-filter', 'placeholder'=>'Select Name', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true];
        }
        $re['owner_name'] = ['title' => 'Owner Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true];
        $re['pb_contract_amount']  =  ['title' => 'Contract Amount', 'class' => '', 'type' => 'number', 'condition' => 'like', 'active' => true];
        return  $re ;
    }
}
