<?php

namespace App\CRM\DataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Yajra\DataTables\Utilities\Request as DataTablesRequest;


class BaseDataTable extends DataTable
{
    use DataTableButton;
    public function __construct()
    {
        $this->request = new DataTablesRequest();

        $this->addScope(new CrmScope($this->getFilters()));
    }

    public function renderAjaxAndActions()
    {
        if ($this->request()->ajax() && $this->request()->wantsJson()) {
            return app()->call([$this, 'ajax']);
        }

        if ($action = $this->request()->get('action') and in_array($action, $this->actions)) {
            if ($action == 'print') {
                return app()->call([$this, 'printPreview']);
            }

            return app()->call([$this, $action]);
        }
    }


    /**
     * Get DataTables Html Builder instance.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function builder(): Builder
    {
        return app(DataTableBuilder::class);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */


    /**
     * Apply query scopes.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    protected function applyScopes(
        EloquentBuilder|QueryBuilder|EloquentRelation|Collection|AnonymousResourceCollection $query
    ): EloquentBuilder|QueryBuilder|EloquentRelation|Collection|AnonymousResourceCollection {
        $queryClass = strtolower(class_basename($query->getModel()));


        /*$filtersobj = new \stdClass();
        //$scopes = $filtersobj->do_filter('datatable_scopes_' . $queryClass, $this->scopes, $queryClass);


        foreach ($scopes as $scope) {
            $scope->apply($query);
        }*/

        return $query;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function getFilters()
    {
        return [];
    }

    protected function getColumns()
    {
        return [];
    }


    protected function getBulkActions()
    {
        return [];
    }

    protected function getOptions()
    {
        return [];
    }

    protected function getTableId()
    {
        return class_basename($this);
    }

    protected function getBuilderParameters(): array
    {
        return [];
    }

}
