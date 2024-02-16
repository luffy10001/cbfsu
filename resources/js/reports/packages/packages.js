let url1 = config.routes.packages_ajax;
jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let city_id     = '';
    let package_id  = '';
    let area_ids    = '';
    let packages_report  = '';
    $('#city_id').on('change',function(){
        city_id = $(this).val();
        if($('#packages-report-table').length > 0) {
            packages_report.ajax.reload();
        }
    });
    $('#city_id').select2();
    $('#package_id').on('change',function(){
        package_id = $(this).val();
        if($('#packages-report-table').length > 0) {
            packages_report.ajax.reload();
        }
    });
    $('#package_id').select2();
    $('#area_id').on('change',function(){
        area_ids = $(this).val();
        if($('#packages-report-table').length > 0) {
            packages_report.ajax.reload();
        }
        console.log('area_ids',area_ids);
    });
    $('#area_id').select2();
    if($('#packages-report-table').length > 0) {
        packages_report = $('#packages-report-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'get_packages';
                    d.city_id = city_id;
                    d.area_ids = area_ids;
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.package_id = package_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'area_name', name: 'area_name'},
                {data: 'total_clients', name: 'total_clients'},
                {data: 'active_client', name: 'active_client'},
                {data: 'contracts', name: 'contracts'}
                //{data: 'total_contract_payments', name: 'total_contract_payments'},
                //{data: 'total_payments', name: 'total_payments'},
                //{data: 'total_packages', name: 'total_packages'}
            ]
        });
    }
    $("#packages_ajax_date_range").daterangepicker();
    $('#packages_ajax_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#packages-report-table').length > 0) {
            packages_report.ajax.reload();
        }
    });
});