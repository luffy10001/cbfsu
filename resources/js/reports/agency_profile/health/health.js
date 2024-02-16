let ApexCharts  = require('apexcharts');
let url1        = config.routes.avg_payment_chart_ajax;
let start_date  = moment().startOf('month').format('YYYY-MM-DD');
let end_date    = moment().endOf('month').format('YYYY-MM-DD');
let agency_id   = jQuery('#agency_id').val();
let avg_chart = '';
jQuery(document).ready(function($) {
    let report_date_range =  $('#report_date_range');
    report_date_range.daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
    report_date_range.data('daterangepicker').setStartDate(start_date);
    report_date_range.data('daterangepicker').setEndDate(end_date);
    report_date_range.on('apply.daterangepicker', function (ev, picker) {
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        avgPaymentChart(url1, agency_id);
    });
        let chart_height = 450;//default height
        if(typeof window !== 'undefined' && window !== undefined){
            if(typeof window.innerHeight !== 'undefined' && window.innerHeight !== undefined && window.innerHeight > 0) {
                chart_height = (window.innerHeight / 2);
            }
        }
        let options = {
            chart: {
                type: 'line',
                height: chart_height+'px'
            },
            stroke: {
                curve: 'smooth'
            },
            series: [],
            xaxis: {},
            markers: {
                size: 8, // Size of the markers 6
                colors: ['#008FFB'], // Marker color
                strokeColors: '#fff', // Marker border color
                strokeWidth: 2, // Marker border width
                hover: {size: 8}
            }
       };
       avg_chart = new ApexCharts(document.querySelector("#avg_payment_chart"), options);
       avg_chart.render();

    $('#showChartBtn').click(function(event) {
        event.preventDefault();
        // Specify the URL to fetch data from
        //var url = url1; // Change 'url1' to your desired URL
        // Call the avgPaymentChart function with the specified URL
        avgPaymentChart(url1, agency_id);
    });
    function avgPaymentChart(url1) {
        try {
            avg_chart.updateOptions({xaxis: {categories: []}, series: []});
        $.ajax({
            url: url1,
            type: 'post',
            data: {
                'action': 'avg_payment_chart',
                'agency_id': agency_id,
                'start_date':start_date,
                'end_date':end_date
            },
            success: function (result) {
                let keysArray = Object.keys(result.data);
                if (result.data !== undefined && result.data.length !== 0) {
                    avg_chart.updateOptions({
                        xaxis: {
                            name: 'Month - year',
                            categories: Object.keys(result.data)
                        },
                        series: [{
                            name: 'Payment Amount',
                            data: Object.values(result.data).map(item => item.avg_month)
                        }],
                        tooltip: {
                            custom: function({series, seriesIndex, dataPointIndex, w }) {
                                return '<div class="arrow_box">'+
                                    '<span>Payment Received: ' + series[seriesIndex][dataPointIndex] +'</span><br>'+
                                    '<span>calls: ' + result.data[keysArray[dataPointIndex]].call_count +'</span><br>'+
                                    '<span>meetings: ' + result.data[keysArray[dataPointIndex]].meeting_count +'</span><br>'+
                                    '</div>'
                            }
                        },
                    })
                }
            },
            error: function (error) {
                showErrorStaff(error, false);
            }
        });
        } catch (e) {
            console.log(e);
        }
    }
    avgPaymentChart(url1, agency_id);


    function showErrorStaff(error, showToast) {
        let status = error.status,
            responseJSON = error.responseJSON;
        if (status === 422) {
            let message = responseJSON.message,
                errors = responseJSON.errors;
            $.each(errors, function (elem, value) {
                let html = "<div class=\"text-danger has-error error_".concat(elem.replace('.', '_'), "\">").concat(value, "</div>");
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