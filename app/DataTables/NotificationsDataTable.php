<?php


namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\Notification;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Html\Column;

class NotificationsDataTable extends BaseDataTable
{
    public $cacheQueryHour = 2;
    public $tableId = 'notifications';
    public $createRoute = 'notifications.create';

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
            ->addColumn('user_id',function ($notification){
                if (isset($notification->assigned_to)) {
                    return $notification->assigned_to->name;
                }else{
                    return 'N/A';
                }
            })
            ->addColumn('sent_by_user_id',function ($notification){ //assigned BY
                if(isset($notification->assigned_by)){
                    return $notification->assigned_by->name;
                }else{
                    return 'N/A';
                }
            })
            ->addColumn('is_read',function ($notification){
                if($notification->is_read){
                    return 'Yes';
                }else{
                    return 'No';
                }
            })
            ->addColumn('created_at',function ($notification){
                return date_formats($notification->created_at);
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if (!empty($request->get('assigned_to')) && $request['assigned_to'] !=='all'){
                    $instance->whereHas('assigned_to',function ($q)use($request){
                        $q->where('name','ilike','%'.$request->get('assigned_to').'%');
                    });
                }
                if (!empty($request->get('sent_by')) && $request['sent_by'] !=='all'){
                    $instance->whereHas('assigned_by',function ($q)use($request){
                        $q->where('name','ilike','%'.$request->get('sent_by').'%');
                    });
                }
                $re = $request->get('status');
                if ( isset($re) && $re !=='all'){
                    $instance->where('is_read', $re);
                }
            })
            ->rawColumns(['agencyId','areaId','cityId','actions']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\userDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        $user = auth()->user();
        $role = $user->role;
        $baseQuery = $model->orderBy('id', 'desc');
        if($role->slug != 'super-admin'){
            $baseQuery->where('user_id', $user->id);
        }
        return $baseQuery->newQuery();
//        if($role->slug=='superadmin'){
//            return $model
//                ->select('id','user_id','sent_by_user_id','message','refrence_id','page_route_name','is_read','created_at')
//                ->orderBy('id', 'desc')
//                ->newQuery();
//        }else{
//            return $model->where('user_id', $user->id)
//                ->newQuery();
//        }
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
            ->dom("<lf<t>ip>")
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
            Column::computed('user_id')->title('Assigned To'),
            Column::computed('sent_by_user_id')->title('Sent By User'),
            Column::computed('message')->title("Notification"),
            Column::computed('refrence_id')->title("Reference Id"),
            Column::computed('page_route_name')->title('Page Route Name'),
            Column::computed('is_read')->title("Is Read"),
            Column::computed('created_at')->title("Created At"),
//            Column::computed('actions')
//                ->title('Action')
//                ->exportable(true)
//                ->printable(true)
//                ->width(60)
//                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'notifications_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $status['all'] = 'All';
        $statusList = ['No','Yes'];
        if ($statusList) {
            foreach ($statusList as  $key => $st) {
                $status[$key] = $st;
            }
        }
        $data =  [
            'sent_by'  => ['title' => 'Sent By User','options'=> [], 'placeholder'=>'Select User', 'class' => '', 'type' => 'text', 'condition' => 'like'],
            'status'  => ['title' => 'Is Read','options'=> $status, 'placeholder'=>'Select Type', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like'],
        ];
        $user = auth()->user();
        $role = $user->role;
        if($role->slug=='super-admin'){
            $data['assigned_to']  = ['title' => 'Assigned To','options'=> [], 'placeholder'=>'Select User', 'class' => '', 'type' => 'text', 'condition' => 'like'];
            return $data;
        }else{
            return $data;
        }
    }
}
