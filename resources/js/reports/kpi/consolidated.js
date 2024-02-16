let url1 = config.routes.kpi_report_task_ajax;

jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let user_id     = '';
    let kpi_report  = '';
    $('#user_id').on('change',function(){
        user_id = $(this).val();
        if($('#kpi_report_consolidated_table').length > 0) {
            kpi_report.ajax.reload();
        }
    });
    $('#user_id').select2();
    if($('#kpi_report_consolidated_table').length > 0) {
        kpi_report = $('#kpi_report_consolidated_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'consolidated';
                    d.user_id = user_id;
                    d.start_date = start_date;
                    d.end_date = end_date;
                }
            },
            columns: [
                // Define your columns here
                {data: 'user_id', name: 'user_id'},
                {data: 'user_name', name: 'user_name'},
                {data: 'role', name: 'role'},
                {data: 'city_name', name: 'city_name'},
                {data: 'no_of_calls', name: 'no_of_calls'},
                {data: 'no_of_meetings', name: 'no_of_meetings'},
                {data: 'total_tasks', name: 'total_tasks'}

            ]
        });
    }
    $("#kpi_date_range").daterangepicker();
    $('#kpi_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#kpi_report_consolidated_table').length > 0) {
            kpi_report.ajax.reload();
        }
    });
});