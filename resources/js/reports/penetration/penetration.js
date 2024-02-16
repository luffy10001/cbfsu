let url1 = config.routes.penetration_ajax;
jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let city_id     = '';
    let area_ids     = '';
    let penetration_report  = '';
    let penetration_table  = $('#penetration-report-table');
    let penetration_daterange  = $("#penetration_ajax_date_range");
    let city_select = $('#city_id');
    let area_select = $('#area_id');
    city_select.select2();
    area_select.select2();

    city_select.on('change',function(){
        area_ids = '';
        area_select.val('');
        city_id = $(this).val();
        if(penetration_table.length > 0) {
            penetration_report.ajax.reload();
        }
    });

    area_select.on('change',function(){
        area_ids = $(this).val();
        if(penetration_table.length > 0) {
            penetration_report.ajax.reload();
        }
        console.log('area_ids',area_ids);
    });

    if(penetration_table.length > 0) {
        penetration_report = penetration_table.DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'get_penetration';
                    d.city_id = city_id;
                    d.area_ids = area_ids;
                    d.start_date = start_date;
                    d.end_date = end_date;
                }
                },
            columns: [
                // Define your columns here
                {data: 'area_name', name: 'area_name'},
                {data: 'total_clients', name: 'total_clients'},
                {data: 'active_client', name: 'active_client'},
                {data: 'new_client', name: 'new_client'},
                {data: 'lost_client', name: 'lost_client'},
                {data: 'untapped_client', name: 'untapped_client'},
                {data: 'total_payments', name: 'total_payments'},
                {data: 'total_properties', name: 'total_properties'},
                {data: 'total_leads', name: 'total_leads'},
                {data: 'active_client_percentage', name: 'active_client_percentage'},
                {data: 'arpu', name: 'arpu'}
            ]
        });
    }
    penetration_daterange.daterangepicker();
    penetration_daterange.on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if(penetration_table.length > 0) {
            penetration_report.ajax.reload();
        }
    });
});