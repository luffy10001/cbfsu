<?php

namespace App\DataTables;

use App\CRM\DataTable\BaseDataTable;
use App\Models\Signature;
use Yajra\DataTables\Html\Column;


class SignatureDataTable extends BaseDataTable
{   public $createRoute = 'signature.create';
    public $tableId = 'signatures';

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
            ->addColumn('attachment_type', function($signature){
                if($signature->attachment_type == 1){
                    return "Seal";
                }else{
                    return "Signature";
                }
            })
            ->addColumn('attachment', function($signature){
                return "<a href='" . asset('images/bonds/'.$signature->attachment) . "'><span class='badge bg-primary '>View </span></a>";
            })
            ->addColumn('actions', function($signature){
                return view('signature.actions', compact('signature'));
            })
            ->filter(function ($instance) use ($request, $db_connection) {
                if(!empty($request->get('id'))){
                    $instance->where('id', $request['id']);
                }
                if (!empty($request->get('name'))) {
                    $instance->where('name', ($db_connection === 'mysql') ? 'LIKE' : 'ILIKE', "%" . $request->get('name') . "%");
                }
                if (!empty($request->get('attachment_type'))) {
                    $instance->where('attachment_type', $request->get('attachment_type'));
                }
            })

            ->rawColumns(['actions','status','attachment']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\userDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Signature $model)
    {
        return $model->newQuery();
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
            Column::make('id')->title('ID'),
            Column::computed('name'),
            Column::make('attachment_type'),
            Column::make('attachment')->title('View Seal/Signature'),
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
        $attch  =   [
            0 => " select Seal/Signature",
            1 => "Seal",
            2 => "Signature",
        ];
        return [
            'id'  => ['title' => 'ID', 'class' => '', 'type' => 'number', 'condition' => 'like', 'active' => true],
            'name'  => ['title' => 'Name', 'class' => '', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'attachment_type'  => [ 'title' => 'Attachment Type','options' => $attch, 'placeholder'=>'Select an Attachment Type', 'class' => 'filter-dropdown', 'type' => 'select', 'condition' => 'like', 'active' => true],
        ];
    }
}

