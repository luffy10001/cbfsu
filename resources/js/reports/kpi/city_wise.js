let url1 = config.routes.kpi_report_task_ajax;

jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let city_id     = '';
    let kpi_report  = '';
    $('#city_id').on('change',function(){
        city_id = $(this).val();
        if($('#kpi_report_city_table').length > 0) {
            kpi_report.ajax.reload();
        }
    });
    $('#city_id').select2();
    if($('#kpi_report_city_table').length > 0) {
        kpi_report = $('#kpi_report_city_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'city_wise';
                    d.city_id = city_id;
                    d.start_date = start_date;
                    d.end_date = end_date;
                }
            },
            columns: [
                // Define your columns here
                {data: 'city_id', name: 'city_id'},
                {data: 'city_name', name: 'city_name'},
                {data: 'no_of_am', name: 'no_of_am'},
                {data: 'no_of_tasks_am', name: 'no_of_tasks_am'},
                {data: 'no_of_calls_am', name: 'no_of_calls_am'},
                {data: 'no_of_meetings_am', name: 'no_of_meetings_am'},
                {data: 'call_percentage_am', name: 'call_percentage_am'},
                {data: 'meeting_percentage_am', name: 'meeting_percentage_am'},
                {data: 'am_percentage_of_total_sales', name: 'am_percentage_of_total_sales'},
                {data: 'no_of_ts', name: 'no_of_ts'},
                {data: 'no_of_tasks_ts', name: 'no_of_tasks_ts'},
                {data: 'no_of_calls_ts', name: 'no_of_calls_ts'},
                {data: 'no_of_meetings_ts', name: 'no_of_meetings_ts'},
                {data: 'call_percentage_ts', name: 'call_percentage_ts'},
                {data: 'meeting_percentage_ts', name: 'meeting_percentage_ts'},
                {data: 'ts_percentage_of_total_sales', name: 'ts_percentage_of_total_sales'},
            ]
        });
    }
    $("#kpi_date_range").daterangepicker();
    $('#kpi_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#kpi_report_city_table').length > 0) {
            kpi_report.ajax.reload();
        }
    });
});