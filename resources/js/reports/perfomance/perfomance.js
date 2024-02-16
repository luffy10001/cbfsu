let url1 = config.routes.perfomance_ajax;

jQuery(document).ready(function($) {
    var start_date = '';
    var end_date = '';
    var leadTable = '';
    var agency_id;
    var day_wise_lead_type = $('input[name="day_wise_lead_type"]:checked').val();
    var day_wise_attribute_type = $('input[name="day_wise_attribute_type"]:checked').val();
    var area_wise_lead_type = $('input[name="area_wise_lead_type"]:checked').val();
    var area_wise_attribute_type = $('input[name="area_wise_attribute_type"]:checked').val();

    console.log(day_wise_attribute_type);
    console.log(area_wise_attribute_type);

    $(document).find('.filter-dropdown').select2();
    $('#perfomance_date_range').daterangepicker();

    $('#perfomance_date_range').on('apply.daterangepicker', function(ev, picker) {
        updateDataVariables();
        reportDayWiseLeadChart();
        reportAreaWiseLeadChart();
        if($('#leadTable').length > 0) {
            leadTable.ajax.reload();
        }
    });
    $('#agency_id').on('change',function(){
        updateDataVariables();
        reportDayWiseLeadChart();
        reportAreaWiseLeadChart();
        if($('#leadTable').length > 0) {
            leadTable.ajax.reload();
        }
    });
    $('body').on('change','.day_listing_label',function(e) {
        e.preventDefault();
        $(this).parents('.day_wise_lead_type,.day_wise_property_type').find('.listing_label').each(function(){
            $(this).removeClass('active');
        });
        $(this).next('label').addClass('active');
        updateDataVariables();
        reportDayWiseLeadChart();
    });
    $('body').on('change','.area_listing_label',function(e) {
        e.preventDefault();
        $(this).parents('.area_wise_lead_type,.area_wise_property_type').find('.listing_label').each(function(){
            $(this).removeClass('active');
        });
        $(this).next('label').addClass('active');
        updateDataVariables();
        reportAreaWiseLeadChart();
    });
    function reportDayWiseLeadChart() {
        $('#reportDayWiseLeadChart').html('');
        $.ajax({
            url: url1,
            type: 'get',
            data: {
                'action': 'reportDayWiseLeadChart',
                'start_date': start_date,
                'end_date': end_date,
                'agency_id': agency_id,
                'day_wise_lead_type' : day_wise_lead_type,
                'day_wise_attribute_type' : day_wise_attribute_type
            },
            success: function success(result) {
                var day_wise_series;
                if(day_wise_attribute_type == "purpose")
                {
                    day_wise_series = [{name:"Rent",data: result.data.map(({rent}) => rent)},{name:"Buy",data: result.data.map(({buy}) => buy)}];
                }
                else
                {
                    day_wise_series = [{name:"Hot", data: result.data.map(({hot}) => hot)},{name:"Super Hot",data: result.data.map(({super_hot}) => super_hot)}, {name:"Listing",data: result.data.map(({listing}) => listing)}];
                }
                var options = {
                    series: day_wise_series,
                    chart: {
                        type: 'area',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                        }
                    },
                    xaxis: {
                        categories: result.data.map(({name}) => name),
                    },
                    // yaxis: {
                    //     type: 'datetime',
                    //     categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                    // },
                    dataLabels: {
                        enabled: false
                    }
                };
                chart = new ApexCharts(document.querySelector("#reportDayWiseLeadChart"), options);
                chart.render();
            },
            error: function error(_error4) {
                showErrorStaff(_error4, false);
            }
        });
    }
    function reportAreaWiseLeadChart() {
        $('#reportAreaWiseLeadChart').html('');
        $.ajax({
            url: url1,
            type: 'get',
            data: {
                'action': 'reportAreaWiseLeadChart',
                'start_date': start_date,
                'end_date': end_date,
                'agency_id': agency_id,
                'area_wise_lead_type' : area_wise_lead_type,
                'area_wise_attribute_type' : area_wise_attribute_type

            },
            success: function success(result) {
                var area_wise_series;
                if(area_wise_attribute_type == "purpose")
                {
                    area_wise_series = [{name:"Rent",data: result.data.map(({rent}) => rent)},{name:"Buy",data: result.data.map(({buy}) => buy)}];
                }
                else
                {
                    area_wise_series = [{name:"Hot", data: result.data.map(({hot}) => hot)},{name:"Super Hot",data: result.data.map(({super_hot}) => super_hot)}, {name:"Listing",data: result.data.map(({listing}) => listing)}];
                }
                var options = {
                    series: area_wise_series,
                    chart: {
                        type: 'bar',
                        height: 450
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                        }
                    },
                    xaxis: {
                        categories: result.data.map(({name}) => name),
                    },
                    dataLabels: {
                        enabled: false
                    }
                };
                chart = new ApexCharts(document.querySelector("#reportAreaWiseLeadChart"), options);
                chart.render();
            },
            error: function error(_error4) {
                showErrorStaff(_error4, false);
            }
        });
    }
    if ($('#leadTable').length > 0) {
        leadTable = $('#leadTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function data(d) {
                    d.action = 'leadTable';
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.agency_id = agency_id;
                },
                error: function error(_error3) {
                    showErrorStaff(_error3, false);
                }
            },
            columns: [
                // Define your columns here
                {
                    data: 'report_date',
                    name: 'report_date'
                },{
                    data: 'total_views',
                    name: 'total_views'
                },{
                    data: 'total_visits',
                    name: 'total_visits'
                },{
                    data: 'ctr',
                    name: 'ctr'
                },{
                    data: 'calls',
                    name: 'calls'
                },{
                    data: 'inquiries',
                    name: 'inquiries'
                },{
                    data: 'whatsapp',
                    name: 'whatsapp'
                },{
                    data: 'leads',
                    name: 'leads'
                }]
        });
    }

    function updateDataVariables() {
        start_date = $('#perfomance_date_range').data('daterangepicker').startDate.format("YYYY-MM-DD");
        end_date = $('#perfomance_date_range').data('daterangepicker').endDate.format("YYYY-MM-DD");
        agency_id = $('#agency_id').val();
        day_wise_lead_type = $('input[name="day_wise_lead_type"]:checked').val();
        day_wise_attribute_type = $('input[name="day_wise_attribute_type"]:checked').val();
        area_wise_lead_type = $('input[name="area_wise_lead_type"]:checked').val();
        area_wise_attribute_type = $('input[name="area_wise_attribute_type"]:checked').val();
    }

    function showErrorStaff(error, showToast) {
        var status = error.status,
            responseJSON = error.responseJSON;
        if (status === 422) {
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
            if (showToast) {
                toastr.warning(message);
            }
        }
    }
});