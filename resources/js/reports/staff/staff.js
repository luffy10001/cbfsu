let url1 = config.routes.staff_ajax;

jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let user_id     = null;
    let listing_table = '';
    let agency_table  = '';
    let performance_table  = '';
    $('#user_id').on('change', function () {
        user_id = $(this).val();
        start_date = $('#staff_date_range').data('daterangepicker').startDate.format("YYYY-MM-DD");
        end_date = $('#staff_date_range').data('daterangepicker').endDate.format("YYYY-MM-DD");
        if(typeof user_id !== "undefined" && user_id != "")
        {
            if ($('#listing_table').length > 0) {
                listing_table.ajax.reload();
            }
            if ($('#agency_table').length > 0) {
                agency_table.ajax.reload();
            }
            if ($('#performance_table').length > 0) {
                performance_table.ajax.reload();
            }
            if($('#report_staff_arpu_chart').length > 0) {
                reportStaffArpuChart();
            }
        }
    });
    if($('#listing_table').length > 0) {
        listing_table = $('#listing_table').DataTable({
            processing: true,
            serverSide: false,
            order:[],
            aaSorting: [],
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'report_agency_summary';
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.user_id = user_id;
                },
                error: function (error) {
                    showErrorStaff(error, true);
                }
            },
            columns: [
                // Define your columns here
                {data: 'year_month', name: 'year_month'},
                {data: 'total_agency', name: 'total_agency'},
                {data: 'active_agency', name: 'active_agency'},
                {data: 'lost_agency', name: 'lost_agency'},
                {data: 'critical_agency', name: 'critical_agency'},
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
                    d.action = 'report_revenue';
                    d.start_date = start_date;
                    d.end_date = end_date
                    d.user_id = user_id;
                },
                error: function (error) {
                    showErrorStaff(error, false);
                }
            },
            columns: [
                // Define your columns here
                {data: 'year_avg', name: 'year_avg'},
                {data: 'quarter_avg', name: 'quarter_avg'},
                {data: 'month_avg', name: 'month_avg'},
                {data: 'total_payment', name: 'total_payment'},
            ]
        });
    }
    if($('#performance_table').length > 0) {
        performance_table = $('#performance_table').DataTable({
            processing: true,
            serverSide: false,
            order:[],
            aaSorting: [],
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'report_staff_meeting';
                    d.start_date = start_date;
                    d.end_date = end_date
                    d.user_id = user_id;
                },
                error: function (error) {
                    showErrorStaff(error, false);
                }
            },
            columns: [
                // Define your columns here
                {data: 'year_month', name: 'year_month'},
                {data: 'assigned_agencies', name: 'assigned_agencies'},
                {data: 'met_by_me', name: 'met_by_me'},
                {data: 'not_met_by_me', name: 'not_met_by_me'},
                {data: 'not_met_by_anyone', name: 'not_met_by_anyone'}
            ]
        });
    }
    var chart;
    var options;
    $('#staff_date_range').daterangepicker();
    $('#staff_date_range').on('apply.daterangepicker', function(ev, picker) {
        user_id = $('#user_id').val();
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
        if($('#report_staff_arpu_chart').length > 0) {
            reportStaffArpuChart();
        }
    });

    function reportStaffArpuChart()
    {
        $.ajax({
            url: url1,
            type: 'get',
            data: {
                'action': 'arpu_graph',
                'start_date': start_date,
                'end_date': end_date,
                'user_id': user_id
            },
            success: function (result) {
                var divs = '';
                if (result.data !== undefined && result.data.length != 0) {
                    result.data.forEach(function (arrayItem) {
                        divs += '<div class="col-sm-1 mt-2">\
                                <div class="content">\
                                    <table>\
                                            <thead>\
                                            <tr>\
                                            <th>' + arrayItem.year_month + '</th>\
                                    </tr>\
                                    </thead>\
                                        <tbody>\
                                        <tr>\
                                            <td>' + arrayItem.average_payments + '</td>\
                                        </tr>\
                                        </tbody>\
                                    </table>\
                                </div>\
                            </div>';
                        $('#container-div').html(divs);
                    });
                    options = {
                        chart: {
                            type: 'bar'
                        },
                        series: [{
                            name: 'sales',
                            data: result.data.map(({average_payments}) => average_payments)
                        }],
                        xaxis: {
                            categories: result.data.map(({year_month}) => year_month)
                        }
                    }
                    $('#report_staff_arpu_chart').html('');
                    chart = new ApexCharts(document.querySelector("#report_staff_arpu_chart"), options);
                    chart.render();
                }
            },
            error: function (error) {
                showErrorStaff(error, false);
            }
        });

    }

    function showErrorStaff(error, showToast)
    {
        var status = error.status,
            responseJSON = error.responseJSON;
        if (status === 422)
        {
            var message = responseJSON.message,
                errors = responseJSON.errors;
            $.each(errors, function (elem, value) {
                var html = "<div class=\"text-danger has-error error_".concat(elem.replace('.', '_'), "\">").concat(value, "</div>");
                if ($(".input-".concat(elem.replace('.', '_'))).is('select') && $(".input-".concat(elem.replace('.', '_'))).hasClass('select2-hidden-accessible')) {
                    $('.filter-account-manager').find(".error_".concat(elem.replace(/\./g, '_'))).remove();
                    $(".input-".concat(elem.replace('.', '_'))).next('span.select2-container').after(html);
                } else {
                    if ($(".input-".concat(elem.replace(/\./g, '_'))).attr('type') == 'radio') {
                        $(".input-".concat(elem.replace(/\./g, '_'))).parents('.radio-row').after(html);
                    } else {
                        $('.filter-account-manager').find(".error_".concat(elem.replace(/\./g, '_'))).remove();
                        $(".input-".concat(elem.replace(/\./g, '_'))).after(html);
                    }
                }
            });
            if(showToast)
            {
                toastr.warning(message);
            }
        }
    }
});