let url1 = config.routes.rider_ajax;
jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let user_id     = '';
    let listing_table = '';
    let agency_table  = '';
    let performance_table  = '';
    let user_dropdown = jQuery('select#user_select_id');
    user_dropdown.on('change',function(){
        user_id = $(this).val();
        if($('#listing_table').length > 0) {
            listing_table.ajax.reload();
        }
        if($('#agency_table').length > 0) {
            agency_table.ajax.reload();
        }
        if($('#performance_table').length > 0) {
            performance_table.ajax.reload();
        }
    });
    user_dropdown.select2();
    if($('#listing_table').length > 0) {
        listing_table = $('#listing_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'listing';
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'year_month', name: 'year_month'},
                {data: 'total_p', name: 'total_p'},
                {data: 'sale_p', name: 'sale_p'},
                {data: 'rent_p', name: 'rent_p'}
            ]
        });
    }
    if($('#agency_table').length > 0) {
        agency_table = $('#agency_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'agency';
                    d.start_date = start_date;
                    d.end_date = end_date
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'year_month', name: 'year_month'},
                {data: 'total_a', name: 'total_a'},
                {data: 'new_a', name: 'new_a'},
                {data: 'old_a', name: 'old_a'}
            ]
        });
    }
    if($('#performance_table').length > 0) {
        performance_table = $('#performance_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'performance';
                    d.start_date = start_date;
                    d.end_date = end_date
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'clients', name: 'clients'},
                {data: 'total_p', name: 'total_p'},
                {data: 'sale_p', name: 'sale_p'},
                {data: 'rent_p', name: 'rent_p'},
                {data: 'visits', name: 'visits'},
                {data: 'pictures', name: 'pictures'},
                {data: 'videos', name: 'videos'}
            ]
        });
    }
    $('#rider_date_range').daterangepicker();
    $('#rider_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#listing_table').length > 0) {
            listing_table.ajax.reload();
        }
        if($('#agency_table').length > 0) {
            agency_table.ajax.reload();
        }
        if($('#performance_table').length > 0) {
            performance_table.ajax.reload();
        }
    });
});