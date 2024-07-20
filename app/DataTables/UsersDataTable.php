<?php

namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\City;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\HtmlString;

class UsersDataTable extends BaseDataTable
{   public $createRoute = 'users.create';

    public $tableId = 'users';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $request = request();
        $db_connection = env('DB_CONNECTION');
        return datatables()
            ->eloquent($query)
            ->addColumn('created_at', function($user){
                return crm_date_format($user->created_at);
            })
            ->addColumn('updated_at', function($user){
                return crm_date_format($user->updated_at);
            })
            ->addColumn('status', function($user){
                if($user->status)
                    return "<span class='badge bg-success '>Active</span> ";
                return "<span class='badge bg-primary '>In-Active</span> ";

            })
            ->editColumn('name',function ($user){
                return $user->name;
            })
            ->addColumn('actions', function($user){
                if($user->role->slug!='super-admin') {
                    return view('users.actions', compact('user'));
                }
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if(!empty($request->get('id'))){
                    $instance->where('users.id', $request['id']);
                }
                if (!empty($request->get('name'))) {
                    $instance->where('users.name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
                if (!empty($request->get('email'))) {
                    $instance->where('users.email', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('email') . "%");
                }

                if (!empty($request['role_name']) && $request['role_name'] !='all'){;
                    $instance->where('users.role_id',$request['role_name']);
                }
                if (!empty($request['status']) && $request['status'] !== 'all'){
                    if($request['status'] == 'active'){
                        $instance->where('users.status',true);
                    }else{
                        $instance->where('users.status',false);
                    }

                }
            })
            ->rawColumns(['actions','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\userDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $user       =   request()->user();
        $users=  $model->from(TableName(User::class).' as users')
            ->leftJoin(TableName(Role::class).' as roles','users.role_id','=','roles.id')
            ->select(
                'users.*',
                'roles.name as role_name'
            );
        return $users->newQuery();
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
              ->orderBy(0)
             ->pageLength(10)
             ->buttons(
                 $this->buttons()
             )->parameters([
                 'dom'          => 'Bfrtip',
                 'buttons'      => ['csv','excel'],
                 'preDrawCallback' => "function(){window.showLoader()}",
                 'drawCallback' => "function(){window.hideLoader()}"
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
            Column::make('id')->title('User ID'),
            Column::computed('name'),
            Column::make('email'),
            Column::make('role_name')->title('Role'),
            Column::make('status')->title('Account Status'),
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
        return 'user_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $roles['all'] = 'All Roles';
        $roless = Role::select('id','name')->get();
        foreach ($roless as $role ){
            $roles[$role->id] = $role->name;
        }



        $all_users['all'] = 'All ';
        $all_users['active'] = 'Active';
        $all_users['inactive'] = 'InActive';

        return [
            'id'  => ['title' => 'User ID', 'class' => 'input_number', 'type' => 'number', 'condition' => 'like', 'active' => true],
            'name'  => ['title' => 'Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'email'    => ['title' => 'Email',  'class' => '', 'type' => 'text', 'condition' => 'like'],
            'role_name'  => [ 'title' => 'Role','options' => $roles,'id'=>'role-filter', 'placeholder'=>'Select a role', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
            'status'  => ['title' => 'Status ','options'=>$all_users, 'placeholder'=>'Select a City', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
       ];
    }
}
