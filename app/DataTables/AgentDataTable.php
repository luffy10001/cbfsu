<?php

namespace App\DataTables;
use App\CRM\DataTable\BaseDataTable;
use App\Models\Agent;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;

class AgentDataTable extends BaseDataTable
{

    public $tableId = 'agents';
    public $createRoute = 'agent.create';
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

            ->addColumn('status', function($obj){
                if($obj->status)
                    return "<span class='badge bg-success '>Active</span> ";
                return "<span class='badge bg-primary '>InActive</span> ";
            })
            ->addColumn('actions', function($obj){
                return view('agents.actions',compact('obj'));
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
    public function query(Agent $model)
    {
        return $model->from(TableName(Agent::class).' as agent')
            ->leftJoin(TableName(User::class).' as user','agent.user_id','=','user.id')
            ->select('agent.*','user.name as name','user.email as email','user.status as status')
//            ->orderByDesc('agent.id')
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
            Column::make('phone'),
            Column::make('email'),
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
        return 'agents_' . date('YmdHis');
    }

    public function getFilters(): array
    {
        $datas['all'] = 'Select a Name';
        $objs  = Agent::from(TableName(Agent::class).' as agent')
            ->leftJoin(TableName(User::class).' as user','agent.user_id','=','user.id')
            ->get();
        foreach($objs as $obj){
            $datas[$obj->id]= $obj->name;
        }
        return [
            'name'  => [ 'title' => 'Name','options' => $datas,'id'=>'role-filter', 'placeholder'=>'Select a Province', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}
