let url1 = config.routes.kpi_report_task_ajax;

jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let role_id     = 0;
    let user_id     = 0;
    let kpi_report_meeting  = '';
    let kpi_report_call     = '';
    role_id = $('#user_id').attr('data-role-id');
    $('#user_id').on('change',function(){
        user_id = $(this).val();
        if($('#kpi-report-meeting-table').length > 0) {
            kpi_report_meeting.ajax.reload();
        }
        if($('#kpi-report-call-table').length > 0) {
            kpi_report_call.ajax.reload();
        }
    });
    $('#user_id').select2();
    if($('#kpi-report-meeting-table').length > 0) {
        kpi_report_meeting = $('#kpi-report-meeting-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'meeting';
                    d.task_type_id = 3;
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.role_id = role_id;
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'am_name', name: 'am_name'},
                {data: 'meetings_ex_c', name: 'meetings_ex_c'},
                {data: 'client_met_ex_c', name: 'client_met_ex_c'},
                {data: 'ratio_ex_c', name: 'ratio_ex_c'},
                {data: 'meetings_new_c', name: 'meetings_new_c'},
                {data: 'client_met_new_c', name: 'client_met_new_c'},
                {data: 'ratio_new_c', name: 'ratio_new_c'},
                {data: 'meetings_total_c', name: 'meetings_total_c'},
                {data: 'client_met_total_c', name: 'client_met_total_c'},
                {data: 'ratio_total_c', name: 'ratio_total_c'},
            ]
        });
    }
    if($('#kpi-report-call-table').length > 0) {
        kpi_report_call = $('#kpi-report-call-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'call';
                    d.task_type_id = 1;
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.role_id = role_id;
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'am_name', name: 'am_name'},
                {data: 'meetings_ex_c', name: 'meetings_ex_c'},
                {data: 'client_met_ex_c', name: 'client_met_ex_c'},
                {data: 'ratio_ex_c', name: 'ratio_ex_c'},
                {data: 'meetings_new_c', name: 'meetings_new_c'},
                {data: 'client_met_new_c', name: 'client_met_new_c'},
                {data: 'ratio_new_c', name: 'ratio_new_c'},
                {data: 'meetings_total_c', name: 'meetings_total_c'},
                {data: 'client_met_total_c', name: 'client_met_total_c'},
                {data: 'ratio_total_c', name: 'ratio_total_c'},
            ]
        });
    }
    $("#kpi_date_range").daterangepicker();
    $('#kpi_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#kpi-report-meeting-table').length > 0) {
            kpi_report_meeting.ajax.reload();
        }
        if($('#kpi-report-call-table').length > 0) {
            kpi_report_call.ajax.reload();
        }
    });
});