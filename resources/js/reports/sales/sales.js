let url1 = config.routes.sales_ajax;
jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let user_id     = '';
    let sale_report  = '';
    let user_select = jQuery('#user_select_id.user_select');
    let user_dropdown = jQuery('select#user_select_id');
    if(user_dropdown.length > 0) {
        user_dropdown.select2();
    }

    user_select.on('change',function(){
        user_id = $(this).val();
        if($('#sales_table').length > 0) {
            sale_report.ajax.reload();
        }
    });

    if($('#sales_table').length > 0) {
        sale_report = $('#sales_table').DataTable({
            processing: true,
           //serverSide: false,
            serverSide: true,
            ajax: {
                url: url1,
                type: 'POST',
                data: function (d) {
                    d.action = 'sale';
                    d.user_id = user_id;
                    d.start_date = start_date;
                    d.end_date = end_date;
                }
            },
            columns: [
                // Define your columns here
                {data: 'user_id', name: 'user_id', orderable: false},
                {data: 'user_name', name: 'user_name',orderable: false},
                {data: 'role', name: 'role',orderable: false},
                {data: 'city_name', name: 'city_name', orderable: false},
                {data: 'target_assigned', name: 'target_assigned', orderable: false,
                    render: function (data, type, row) {
                        if(data != null) {
                            if (row.role === 'Account Manager') {
                                return data + ' RS';
                            } else if (row.role === 'Telesales') {
                                return data + ' # calls';
                            } else {
                                return data; // Default value or handle other cases as needed
                            }
                        }else{
                            return data;
                        }
                    }
                },
                {data: 'target_achieved', name: 'target_achieved', orderable: false},
                {data: 'no_of_calls', name: 'no_of_calls', orderable: false},
                {data: 'client_called', name: 'client_called', orderable: false},
                {data: 'calls_by_client', name: 'calls_by_client', orderable: false},
                {data: 'no_of_meetings', name: 'no_of_meetings', orderable: false},
                {data: 'client_met', name: 'client_met', orderable: false},
                {data: 'meetings_by_clients', name: 'meetings_by_clients', orderable: false},
                {data: 'new_client_payments', name: 'new_client_payments', orderable: false},
                {data: 'ex_client_payments', name: 'ex_client_payments', orderable: false},
                {data: 'upsell_payments', name: 'upsell_payments', orderable: false},
                {data: 'renewal_payments', name: 'renewal_payments', orderable: false},
                {data: 'total_payments', name: 'total_payments', orderable: false},
                {data: 'ex_clients', name: 'ex_clients', orderable: false},
                //{data: 'ex_client_names', name: 'ex_client_names', orderable: false}
                {data: 'new_clients', name: 'new_clients', orderable: false},
               //{data: 'new_client_names', name: 'new_client_names', orderable: false},
                {data: 'lost_clients', name: 'lost_clients', orderable: false},
                //{data: 'lost_client_names', name: 'lost_client_names', orderable: false},
                {data: 'returning_clients', name: 'returning_clients', orderable: false},
                {data: 'renewal_clients', name: 'renewal_clients', orderable: false},
                {data: 'net_gain', name: 'net_gain', orderable: false},
            ]
        });
    }
    $("#sales_date_range").daterangepicker();
    $('#sales_date_range').on('apply.daterangepicker', function(ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#sales_table').length > 0) {
            sale_report.ajax.reload();
        }
    });

});