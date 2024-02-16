let ApexCharts = require('apexcharts');
let start_date  = moment().startOf('month').format('YYYY-MM-DD');
let end_date    = moment().endOf('month').format('YYYY-MM-DD');
//let city_id     = '';
//let area_ids     = '';
let areawise_report  = '';
let client_report_2 = '';
let user_id     = '';
jQuery(document).ready(function($) {
    $('select#user_id').select2();
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
        update_charts();
        if($('#client-report-table_2').length > 0) {
            client_report_2.ajax.reload();
        }
    });

    $('body').on('click', 'a.col-collapse', function(e) {
        e.preventDefault();
        let $this = $(this);
        let p_table = $this.parents('table.table');
        const isOpen = $this.hasClass('col-open');
        let dataCol = $this.attr('data-col');
        let [col_start, col_end] = dataCol.split('-').map(Number);
        for(let i = col_start; i <= col_end; i++){
            let ele1 = `thead tr:last-child th:nth-child(${i})`;
            let ele2 = `tbody tr td:nth-child(${i})`;
            if (isOpen) {
                $(p_table).find(ele1).addClass('hide');
                $(p_table).find(ele2).addClass('hide');

            }else{
                $(p_table).find(ele1).removeClass('hide');
                $(p_table).find(ele2).removeClass('hide');
            }
        }
        $this.toggleClass('col-open col-close');
        $this.html(isOpen ? '+' : '-');
        $this.parent().toggleClass('col-close');
        $this.parent().attr('colspan', isOpen ? 1 : $this.attr('data-colspan'));
    });

    jQuery('select#user_id').on('change',function(){
        user_id = jQuery('select#user_id').val();
        update_agencies_stats();
        update_charts();
        if($('#client-report-table_2').length > 0) {
            client_report_2.ajax.reload();
        }
    });
    function update_agencies_stats(){
        let url = config.routes.client_nos;
        let data = {
            action: 'agencies_stats',
            user_id: user_id,
            start_date: start_date,
            end_date: end_date
        }
        jQuery.post(url, data, function(response, textStatus) {
            //console.log('response',response);
            let res = response; //JSON.parse(response);
            jQuery('.active_clients').text(res.active_clients);
            jQuery('.lost_clients').text(res.lost_clients);
            jQuery('.critical_clients').text(res.critical_clients);
            jQuery('.untapped_clients').text(res.untapped_clients);
            jQuery('.clients_met').text(res.clients_met);
            jQuery('.clients_called').text(res.clients_called);
            jQuery('.avg_arpu').text(res.avg_arpu);
        });
    }
    let report_url1 = config.routes.client_nos;
    let action_1 = 'agencies_area_wise';
    areawise_report = $('.area_wise_clients').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu:[10,20,30,40,50,60,70,80,90,100],
        ajax: {
            url: report_url1,
            type: 'POST',
            data: function (d) {
                d.action = action_1;
                d.user_id = user_id;
                d.start_date = start_date;
                d.end_date = end_date;
            }
        },
        columns: [
            {data: 'area_name', name: 'area_name',orderable: false},
            {data: 'total_clients', name: 'total_clients',orderable: false},
            {data: 'active_client', name: 'active_client',orderable: false},
            {data: 'penetration', name: 'penetration',orderable: false},
            {data: 'arpu', name: 'arpu',orderable: false}
        ]
    });
    let report_url = config.routes.client_ajax;
    let action_2 = 'get_agencies_details';
    client_report_2 = $('#client-report-table_2').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu:[10,20,30,40,50,60,70,80,90,100,200],
        ajax: {
            url: report_url,
            type: 'POST',
            data: function (d) {
                d.action = action_2;
                d.user_id = user_id;
                d.start_date = start_date;
                d.end_date = end_date;
            }
        },
        columns: [
            {data: 'client_id', name: 'client_id'},
            {data: 'client_name', name: 'client_name'},
            {data: 'am_name', name: 'am_name'},
            {data: 'age_agency', name: 'age_agency'},
            {data: 'agency_status', name: 'agency_status'},
            {data: 'total_payments', name: 'total_payments'},
            {data: 'total_listing', name: 'total_listing'},
            {data: 'avg_listing_score', name: 'avg_listing_score'},
            {data: 'percentage_listing_2m', name: 'percentage_listing_2m'},
            {data: 'total_listing_quota', name: 'total_listing_quota'},
            {data: 'total_listing_used', name: 'total_listing_used'},
            {data: 'health_lh', name: 'health_lh'},
            {data: 'active_listing', name: 'active_listing'},
            {data: 'current_listing_quota_remaining', name: 'current_listing_quota_remaining'},
            {data: 'hot_total_quota', name: 'hot_total_quota'},
            {data: 'hot_used_quota', name: 'hot_used_quota'},
            {data: 'hot_remaining_quota', name: 'hot_remaining_quota'},
            {data: 'superhot_total_quota', name: 'superhot_total_quota'},
            {data: 'superhot_used_quota', name: 'superhot_used_quota'},
            {data: 'superhot_remaining_quota', name: 'superhot_remaining_quota'},
            {data: 'utilization_percentage_listing_quota', name: 'utilization_percentage_listing_quota'},
            {data: 'hot_used_30d', name: 'hot_used_30d'},
            {data: 'hot_used_60d', name: 'hot_used_60d'},
            {data: 'hot_used_90d', name: 'hot_used_90d'},
            {data: 'superhot_used_30d', name: 'superhot_used_30d'},
            {data: 'superhot_used_60d', name: 'superhot_used_60d'},
            {data: 'superhot_used_90d', name: 'superhot_used_90d'},
            {data: 'total_meetings', name: 'total_meetings'},
            {data: 'meeting_60d', name: 'meeting_60d'},
            {data: 'total_calls', name: 'total_calls'},
            {data: 'call_60d', name: 'call_60d'},
            {data: 'days_since_last_meeting', name: 'days_since_last_meeting'},
            {data: 'health_rh', name: 'health_rh'},
            {data: 'total_leads', name: 'total_leads'},
            {data: 'leads_30d', name: 'leads_30d'},
            {data: 'leads_90d', name: 'leads_90d'},
            {data: 'leads_1y', name: 'leads_1y'},
            {data: 'leads_30d_phone', name: 'leads_30d_phone'},
            {data: 'leads_30d_email', name: 'leads_30d_email'},
            {data: 'leads_30d_sms', name: 'leads_30d_sms'},
            {data: 'leads_60d_phone', name: 'leads_60d_phone'},
            {data: 'leads_60d_email', name: 'leads_60d_email'},
            {data: 'leads_60d_sms', name: 'leads_60d_sms'},
            {data: 'leads_90d_phone', name: 'leads_90d_phone'},
            {data: 'leads_90d_email', name: 'leads_90d_email'},
            {data: 'leads_90d_sms', name: 'leads_90d_sms'}
        ]
    });
        let arpu_chart_options = {
            series: [],
            chart: {
                height: 450,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            colors: ['#77B6EA'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: ' ARPU Graph',
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
                    text: 'ARPU value'
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };
        let arpu_chart = new ApexCharts(document.querySelector("#arpu_chart"), arpu_chart_options);
        arpu_chart.render();
        function update_charts() {
                try {
                    let arpu_chart_url = config.routes.client_nos;
                    let data = {
                        action: 'arpu_chart',
                        user_id: user_id,
                        start_date: start_date,
                        end_date: end_date
                    }
                    jQuery.post(arpu_chart_url, data, function(response, textStatus) {
                        //console.log('response',response);
                        let res = response; //JSON.parse(response);
                        let s = [];
                        if(res.series) {
                            for (const [key, value] of Object.entries(res.series)) {
                                s.push({
                                    name:value.name,
                                    data:value.data,
                                })
                            }
                        }
                        arpu_chart.updateOptions({
                            xaxis: {categories: res.label}, series: s
                        })
                    });
                } catch (e) {
                    console.log(e);
                }
        }
    update_agencies_stats();
    update_charts();
});