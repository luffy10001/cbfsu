let ApexCharts = require('apexcharts');
let start_date  = moment().startOf('month').format('YYYY-MM-DD');
let end_date    = moment().endOf('month').format('YYYY-MM-DD');
let user_select = jQuery('#user_select_id.user_select');
let user_dropdown = jQuery('select#user_select_id');
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
        update_agencies_stats();
        user_payments_month_wise();
        dashboard_charts();
        filter_tables();
    });
});
function update_agencies_stats(){
    let user_option = $('input[name="user_option"]:checked').val();
    let user_id = user_select.val();
    let url = config.routes.agency_sale_report_stats+'?user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;

    jQuery.getJSON(url, function(response) {
        jQuery('.total_agencies_noc_count').text(response.total_agencies_noc);
        jQuery('.total_agencies_count').text(response.total_agencies);
        jQuery('.ex_agencies_count').text(response.ex_agencies);
        jQuery('.new_agencies_count').text(response.new_agencies);
        jQuery('.lost_agencies_count').text(response.lost_agencies);
        jQuery('.return_agencies_count').text(response.return_agencies);
        jQuery('.renewed_agencies_count').text(response.renewed_agencies);
        jQuery('.agency_growth_percentage').text(response.agencies_growth);
    });

    let url2 = config.routes.agency_sale_report_stats+'?action=targets&user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;

    jQuery.getJSON(url2, function(response) {
        jQuery('.target_assigned').text(response.target_assigned);
        jQuery('.target_achieved').text(response.target_achieved);
    });

}
function user_payments_month_wise(){
    let user_id = user_select.val();
    let user_option = $('input[name="user_option"]:checked').val();
    let url = config.routes.user_payments_month_wise+'?action=ajax_agency_sale&user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
    if(jQuery('.team_wise_payment_table .table-ajax').length > 0) {
        jQuery.getJSON(url, function (response) {
            jQuery('.team_wise_payment_table .table-ajax').html('');
            jQuery('.team_wise_payment_table .table-ajax').html(response.html);
        });
    }
}
user_select.on('change',function(){
    update_agencies_stats();
    user_payments_month_wise();
    dashboard_charts();
    filter_tables();
});
if(user_dropdown.length > 0) {
    user_dropdown.select2();
}

$("input[name='user_option']").change(function() {
    let user_option = $(this).val();
    if (user_option === 'team') {
        $(".filter-account-manager").removeClass('hide');
    } else {
        $(".filter-account-manager").addClass('hide');
    }
    update_agencies_stats();
    user_payments_month_wise();
    dashboard_charts();
    filter_tables();
});
function filter_tables(){
    let user_id = user_select.val();
    let user_option = $('input[name="user_option"]:checked').val();
    let url = config.routes.filter_tables+'?action=agencies_by_city&user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
    let no_of_agencies_table = jQuery('body').find('.no_of_agencies_table');
    if(no_of_agencies_table.length > 0) {
        get_data_ajax(url, no_of_agencies_table);
    }

    let url2 = config.routes.filter_tables+'?action=cities_payments_data&user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
    let payment_amount_table = jQuery('body').find('.payment_amount_table');
    if(payment_amount_table.length > 0) {
        get_data_ajax(url2, payment_amount_table);
    }
}
function get_data_ajax(url,ele){
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        success: function (htmlContent) {
            ele.replaceWith(htmlContent);
        },
        error: function (xhr, status, error) {
            console.error('Error fetching HTML:', error);
        }
    });
}
let payment_history_chart_options = {
    series: [],
    noData: {
        text: "Loading...",
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
            color: "#000000",
            fontSize: '14px',
            fontFamily: "Helvetica"
        }
    },
    chart: {
        height: 450,
        type: 'line',
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.1
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#77B6EA', '#545454', '#17a2b8', '#343a40', '#dc3545', '#6c757d',
        '#FF5733', '#9C27B0', '#00BCD4', '#F44336', '#4CAF50', '#FFC107',
        '#E91E63', '#2196F3', '#8BC34A', '#FF9800', '#673AB7', '#009688',
        '#FFEB3B', '#795548'],
    //colors: ['#77B6EA', '#545454', '#17a2b8', '#343a40', '#dc3545', '#6c757d'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Payment History Graph',
        align: 'left'
    },
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {
        size: 1
    },
    xaxis: {
        categories: [],
        title: {
            text: 'Month'
        }
    },
    yaxis: {
        title: {
            text: 'Payment received'
        },
        labels: {
            formatter: (val) => { return Number(val).toLocaleString(); },
        },
        //min: 0,
        //max: 100000
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return Number(val).toLocaleString() + " Amount"
            }
        }
    }
};
let payment_history_chart = new ApexCharts(document.querySelector("#payment_history_chart"), payment_history_chart_options);
payment_history_chart.render();

let agency_growth_history_chart_options = {
    series: [],
    noData: {
        text: "Loading...",
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
            color: "#000000",
            fontSize: '14px',
            fontFamily: "Helvetica"
        }
    },
    chart: {
        type: 'bar',
        height: 450
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 30,
        colors: ['transparent']
    },
    xaxis: {
        categories: [],
    },
    yaxis: {
        title: {
            text: 'Number of Agencies'
        }
    },
    fill: {
        opacity: 0.7
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val + " Agencies"
            }
        }
    }
};
let agency_growth_history_chart = new ApexCharts(document.querySelector("#agency_growth_history_chart"), agency_growth_history_chart_options);
agency_growth_history_chart.render();

let user_target_chart_options = {
    series: [],
    chart: {
        type: 'bar',
        height: 450
    },
    noData: {
        text: "Loading...",
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
            color: "#000000",
            fontSize: '14px',
            fontFamily: "Helvetica"
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 30,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
    yaxis: {
        title: {
            text: 'Targets'
        },
        labels: {
            formatter: (val) => { return Number(val).toLocaleString(); },
        },
    },
    fill: {
        opacity: 0.7
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return Number(val).toLocaleString() + " Amount"
            }
        }
    }
};
let user_target_chart = new ApexCharts(document.querySelector("#user_target_chart"), user_target_chart_options);
user_target_chart.render();

function dashboard_charts() {
    let user_id = user_select.val();
    let user_option = $('input[name="user_option"]:checked').val();
    try {
        payment_history_chart.updateOptions({xaxis: {categories: []}, series: []});
        //payment_history_chart.render().then(function () {
            let url = config.routes.history_chart+'?user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
            $.getJSON(url, function (response) {
                let s = [];
                if (response.series) {
                    for (const [key, value] of Object.entries(response.series)) {
                        s.push({
                            name: value.name,
                            data: value.data,
                        })
                    }
                }
                payment_history_chart.updateOptions({
                    xaxis: {
                        categories: response.label
                    },
                    series: s
                })
            });
        //});
    } catch (e) {
        console.log(e);
    }
    try {
        //agency_growth_history_chart.render().then(function () {
        agency_growth_history_chart.updateOptions({xaxis: {categories: []}, series: []});
            let url2 = config.routes.report_no_agencies+'?user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
            $.getJSON(url2, function (response) {
                let s2 = [];
                if (response.series) {
                    for (const [key, value] of Object.entries(response.series)) {
                        s2.push({
                            name: value.name,
                            data: value.data,
                        })
                    }
                }
                agency_growth_history_chart.updateOptions({
                    xaxis: {
                        categories: response.label
                    },
                    series: s2
                });
            });
       // });
    } catch (e) {
        console.log(e);
    }
    try {
        //user_target_chart.render().then(function () {
        user_target_chart.updateOptions({xaxis: {categories: []}, series: []});
            let url2 = config.routes.report_targets+'?user_option='+user_option+'&start_date='+start_date+'&end_date='+end_date+'&user_id='+user_id;
            $.getJSON(url2, function (response) {
                let s2 = [];
                if (response.series) {
                    for (const [key, value] of Object.entries(response.series)) {
                        s2.push({
                            name: value.name,
                            data: value.data,
                        })
                    }
                }
                user_target_chart.updateOptions({
                    xaxis: {
                        categories: response.label
                    },
                    series: s2
                });
            });
        //});
    } catch (e) {
        console.log(e);
    }
}
update_agencies_stats();
user_payments_month_wise();
dashboard_charts();