<?php

namespace App\CRM\DataTable;

use Yajra\DataTables\Html\Button;

trait DataTableButton
{
    public function buttons()
    {
        $data = [];
        if (!empty($this->disablepopup) && $this->disablepopup == true) {
            if (!empty($this->createRouteParams)) {
                $link = route($this->createRoute, $this->createRouteParams);
            } else {
                $link = route($this->createRoute);
            }
            /* if (!empty($this->createRoute)) {
                 $data[] = Button::make([
                     'text' => 'Create',
                     'className' => 'create',
                     'orientation' => 'landscape',
                     'action' => 'function ( e, dt, node, config ) {
                         window.location.href="' . $link . '";
                     }'
                 ]);
             }*/
        } else {
            if (!empty($this->createRouteParams)) {
                $link = route($this->createRoute, $this->createRouteParams);
            } else {
                $link = route($this->createRoute);
            }
            /*    $data[] = Button::make([
                    'text' => 'Create',
                    'className' => 'create create_btn',
                    'orientation' => 'landscape',
                    'action' => 'function ( e, dt, node, config ) {
                          window.location.href= "' . $link . '"
                    }'
                ]);*/
        }

        $data[] = Button::make([
            'text' => 'Reload',
            'className' => 'Reload',
            'orientation' => 'landscape',
            'action' => 'function ( e, dt, node, config ) {
                       window.LaravelDataTables["' . $this->tableId . '"].ajax.reload( null, false );
                }'
        ]);

        /*$data[] = Button::make('copy');*/
        $data[] = Button::make('excel');
        //$data[] = Button::make('csv');
       // $data[] = Button::make('pdf');
        $data[] = 'pageLength';
        //  $data[] = Button::make('csv');
        /* $data[] = Button::make([
             'extend'       => 'pdfHtml5',
             'orientation'   => 'landscape',
             'pageSize'      =>  'LEGAL'
         ]);*/

        return $data;
    }
}
