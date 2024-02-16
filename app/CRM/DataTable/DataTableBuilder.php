<?php

namespace App\CRM\DataTable;

use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class DataTableBuilder extends Builder
{

    public $filters;
    public $filters_rendered;
    public $options;
    public $bulk_actions;
    public $bulk_actions_rendered;

    public function setFilters($filters = [])
    {
        $this->filters = $filters;
        return $this;
    }

    public function setOptions($options = [])
    {

        $this->options = $options;
        return $this;
    }

    public function setBulkActions($actions = [])
    {
        $this->bulk_actions = $actions;
        return $this;
    }

    public function setTableId($id) :static
    {
        return parent::setTableId($id);
    }

    /**
     * @return string
     * @throws \Exception
     */


    public function bulkActions()
    {
        if (isset($this->bulk_actions_rendered)) {
            return $this->bulk_actions_rendered;
        }
        $this->bulk_actions_rendered = $this->renderBulkActions();
        return $this->bulk_actions_rendered;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function renderBulkActions()
    {

        $bulk_actions = $this->bulk_actions;

        $tableId = $this->getTableAttribute('id');

        if (!$bulk_actions) {
            $this->bulk_actions_rendered = "";
            return $this->bulk_actions_rendered;
        }
        $action_links = "";
        foreach ($bulk_actions as $bulk_action_key => $bulk_action) {
            if ($bulk_action['permission']) {
                if (!user()->hasPermissionTo($bulk_action['permission'])) {
                    continue;
                }

                $confirmation = "";
                if ($bulk_action['confirmation']) {
                    $confirmation = ' data-confirmation="' . $bulk_action['confirmation'] . '" ';
                }
                $action_links .= '<li><a class="dropdown-item" href="' . $this->resource_url . '" ' . $confirmation . ' data-action="' . $bulk_action_key . '">' . $bulk_action['title'] . '</a></li>';

            }

        }

        $actions = '
                <div class="btn-group bulk_actions" id="bulk_actions_' . $tableId . '" data-table="' . $tableId . '">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">'
            . trans('Corals::labels.actions') .
            '
                  </button>
                  <ul class="dropdown-menu" role="menu">';
        $actions .= $action_links;

        $actions .= ' </ul>
                </div>';


        return $actions;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function filters()
    {


        if (isset($this->filters_rendered)) {
            return $this->filters_rendered;
        }

        $this->filters_rendered = $this->renderFilters();
        return $this->filters_rendered;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function renderFilters()
    {
        $filtersFields = $this->filters;

        $tableId = $this->getTableAttribute('id');


        return view('Filters.index', compact('tableId', 'filtersFields'));
        $filters = '<div class="SearchFilterPanel" data-table="' . $tableId . '" id="' . $tableId . '_filters">';

        $rowColumns = 0;

        foreach ($filtersFields as $key => $field) {
            if (!$field['active']) {
                continue;
            }

            $classArray = explode('-', $field['class']);

            $colNumber = $classArray[count($classArray) - 1];

            if ($rowColumns == 0) {
                $filters .= '<div class="row" >';
            }

            if ($rowColumns > 0 && ($rowColumns + $colNumber) > 12) {
                $rowColumns = 0;
                //row closing
                $filters .= '</div>';
                //start new row
                $filters .= '<div class="row" >';
            }

            $filters .= '<div class="' . $field['class'] . '">';

            $attributes = $field['attributes'] ?? [];

            $attributes['class'] = ($field['class'] ?? '') . ' filter';
            $attributes['placeholder'] = $field['placeholder'] ?? $field['title'];
            $attributes['type'] = $field['type'] ?? 'text';
            $filters .= EovendoText($key, $field);

            $filters .= '</div>';

            if (is_numeric($colNumber)) {
                if (($rowColumns + $colNumber) >= 12) {
                    $rowColumns = 0;
                    //row closing
                    $filters .= '</div>';
                } else {
                    $rowColumns += $colNumber;
                }
            }
        }

        if ($rowColumns + 1 > 12) {
            //row closing
            $filters .= '</div>';
            $rowColumns = 0;
        }
        if ($rowColumns == 0) {
            $filters .= '<div class="row" >';
        }
        if (!empty($filtersFields)) {
            $filters .= '<div class="col-md-1 p-r-0">' .
                '<button class="btn btn-primary filterBtn" data-table="' . $tableId . '"><i class="fa fa-search"></i></button>' .
                $filters .= '</div></div></div>';

        } else {
            $filters = '';
        }
        return $filters;
    }

    /**
     * Add a action column.
     *
     * @param array $attributes
     * @return $this
     */
    public function addAction(array $attributes = [], $prepend = false) :static
    {
        $options = $this->options;

        if (isset($options['has_action']) && !$options['has_action']) {
            return $this;
        }

        $attributes = array_merge([
            'defaultContent' => '',
            'data' => 'action',
            'name' => 'action',
            'title' => 'Action',
            'render' => null,
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => true,
            'footer' => '',
        ], $attributes);
        $this->collection->push(new Column($attributes));

        return $this;
    }
}
