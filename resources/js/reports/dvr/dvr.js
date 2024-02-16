let url1 = config.routes.report_dvr_ajax;
jQuery(document).ready(function($) {
    let start_date  = '';
    let end_date    = '';
    let user_id     = 0;
    let dvr     = '';
    var task_log;
    let user_select = $('#user_id');
    user_select.select2();
    user_select.on('change',function(){
        user_id = $(this).val();
        if($('#dvr-table').length > 0) {
            dvr.ajax.reload();
        }
        if ($('#task-log-table').length > 0) {
            task_log.ajax.reload();
        }

        update_summary('summary_call_meetings',start_date,end_date,user_id);
        update_summary('summary_contracts_payments',start_date,end_date,user_id);
    });
    update_summary('summary_call_meetings',start_date,end_date,user_id);
    update_summary('summary_contracts_payments',start_date,end_date,user_id);
    function update_summary(action,start_date,end_date,user_id) {
        $.ajax({
            method: 'GET',
            url: url1,
            data: {
                action: action,
                start_date: start_date,
                end_date: end_date,
                user_id: user_id,
            }
        }).done(function (res) {
            if (res.data) {
                let item = res.data[0];
                if (item) {

                    let html = '';
                    let html2 = '';
                    if (action === 'summary_call_meetings') {
                        html += make_html('Calls', item.call_t_c, item.client_call_t_c);
                        html += make_html('New/Potential Clients', item.call_new_c, item.client_call_new_c);
                        html += make_html('Existing Clients', item.call_ex_c, item.client_call_ex_c);

                        html += make_html('Calls Attempts', item.call_a_t_c, item.client_call_a_t_c);
                        html += make_html('New/Potential Clients', item.call_a_new_c, item.client_call_a_new_c);
                        html += make_html('Existing Clients', item.call_a_ex_c, item.client_call_a_ex_c);
                        jQuery('.calls_box tbody').html('');
                        jQuery('.calls_box tbody').html(html);


                        html2 += make_html('Meetings', item.meetings_t_c, item.client_met_t_c);
                        html2 += make_html('New/Potential Clients', item.meetings_new_c, item.client_met_new_c);
                        html2 += make_html('Existing Clients', item.meetings_ex_c, item.client_met_ex_c);

                        html2 += make_html('Meetings Attempts', item.meetings_a_t_c, item.client_met_a_t_c);
                        html2 += make_html('New/Potential Clients', item.meetings_a_new_c, item.client_met_a_new_c);
                        html2 += make_html('Existing Clients', item.meetings_a_ex_c, item.client_met_a_ex_c);
                        jQuery('.meeting_box tbody').html('');
                        jQuery('.meeting_box tbody').html(html2);
                    }
                    if (action === 'summary_contracts_payments') {
                        html2 += make_html('Contract', item.contract_t_c, item.client_contract_t_c);
                        html2 += make_html('New/Potential Clients', item.contract_new_c, item.client_contract_new_c);
                        html2 += make_html('Existing Clients', item.contract_ex_c, item.client_contract_ex_c);

                        html2 += make_html('Payments', item.payment_t_c, item.client_payment_t_c);
                        html2 += make_html('New/Potential Clients Clients', item.payment_new_c, item.client_payment_new_c);
                        html2 += make_html('Existing Clients', item.payment_ex_c, item.client_payment_ex_c);
                        jQuery('.contracts_box tbody').html('');
                        jQuery('.contracts_box tbody').html(html2);
                    }
                }else{
                    let html = '';
                    let html2 = '';
                    if (action === 'summary_call_meetings') {
                        html += make_html('Calls', 0, 0);
                        html += make_html('New/Potential Clients', 0, 0);
                        html += make_html('Existing Clients', 0, 0);

                        html += make_html('Calls Attempts', 0, 0);
                        html += make_html('New/Potential Clients', 0, 0);
                        html += make_html('Existing Clients', 0, 0);
                        jQuery('.calls_box tbody').html('');
                        jQuery('.calls_box tbody').html(html);


                        html2 += make_html('Meetings', 0, 0);
                        html2 += make_html('New/Potential Clients', 0, 0);
                        html2 += make_html('Existing Clients', 0, 0);

                        html2 += make_html('Meetings Attempts', 0, 0);
                        html2 += make_html('New/Potential Clients', 0, 0);
                        html2 += make_html('Existing Clients', 0, 0);
                        jQuery('.meeting_box tbody').html('');
                        jQuery('.meeting_box tbody').html(html2);
                    }
                    if (action === 'summary_contracts_payments') {
                        html2 += make_html('Contract', 0 ,0);
                        html2 += make_html('New/Potential Clients', 0, 0);
                        html2 += make_html('Existing Clients', 0, 0);

                        html2 += make_html('Payments', 0,0);
                        html2 += make_html('New/Potential Clients Clients', 0,0);
                        html2 += make_html('Existing Clients', 0,0);
                        jQuery('.contracts_box tbody').html('');
                        jQuery('.contracts_box tbody').html(html2);
                    }
                }

            }
        });
    }
    function make_html(label, total, client){
        let html = '<tr>';
        html += '<td><b>'+label+'</b></td>';
        html += '<td>'+total+' ('+client+' Clients)</td>';
        html += '</tr>';
        return html;
    }
    if($('#dvr-table').length > 0) {
        dvr = $('#dvr-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function (d) {
                    d.action = 'activity';
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {data: 'client_id', name: 'client_id'},
                {data: 'client_name', name: 'client_name'},
                {data: 'am_name', name: 'am_name'},
                {data: 'age_agency', name: 'age_agency'},
                {data: 'agency_status', name: 'agency_status'},
                {data: 'meetings_this_month', name: 'meetings_this_month'},
                {data: 'meetings_last_month', name: 'meetings_last_month'},
                {data: 'meetings_previous_month', name: 'meetings_previous_month'},
                {data: 'calls_in_last_30d', name: 'calls_in_last_30d'},
                {data: 'health_rh', name: 'health_rh'},
                {data: 'total_listing', name: 'total_listing'},
                {data: 'avg_listing_score', name: 'avg_listing_score'},
                {data: 'percentage_listing_2m', name: 'percentage_listing_2m'},
                {data: 'total_listing_quota', name: 'total_listing_quota'},
                {data: 'total_listing_used', name: 'total_listing_used'},
                {data: 'health_lh', name: 'health_lh'},
                {data: 'age_contract', name: 'age_contract'},
                {data: 'contract_status', name: 'contract_status'},
                {data: 'contracts_in_months', name: 'contracts_in_months'},
                {data: 'contract_start', name: 'contract_start'},
                {data: 'contract_end', name: 'contract_end'},
                {data: 'contract_amount', name: 'contract_amount'},
                {data: 'total_payments', name: 'total_payments'},
                {data: 'avg_monthly_payment', name: 'avg_monthly_payment'},
                {data: 'avg_revenue_per_year', name: 'avg_revenue_per_year'},
                {data: 'contract_id', name: 'contract_id'},
                {data: 'active_listing', name: 'active_listing'},
                {data: 'current_listing_quota_remaining', name: 'current_listing_quota_remaining'},
                {data: 'current_listing', name: 'current_listing'},
                {data: 'avg_listing_per_day', name: 'avg_listing_per_day'},
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
            ]
        });
        $('body').on('click', 'a.col-collapse', function(e) {
            e.preventDefault();
            const $this = $(this);
            const isOpen = $this.hasClass('col-open');
            const dataCol = $this.attr('data-col');
            const [col_start, col_end] = dataCol.split('-').map(Number);
            for(let i = col_start; i <= col_end; i++){
                const ele1 = `#dvr-table thead tr:last-child th:nth-child(${i})`;
                const ele2 = `#dvr-table tbody tr td:nth-child(${i})`;
                if (isOpen) {
                    $(ele1).addClass('hide');
                    $(ele2).addClass('hide');

                }else{
                    $(ele1).removeClass('hide');
                    $(ele2).removeClass('hide');
                }
            }
            $this.toggleClass('col-open col-close');
            $this.html(isOpen ? '+' : '-');
            $this.parent().toggleClass('col-close');
            $this.parent().attr('colspan', isOpen ? 1 : $this.attr('data-colspan'));
        });
    }
    if ($('#task-log-table').length > 0) {
        user_id = $('#user_id').val();
        task_log = $('#task-log-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url1,
                type: 'GET',
                data: function data(d) {
                    d.action = 'task_log';
                    d.start_date = start_date;
                    d.end_date = end_date;
                    d.user_id = user_id;
                }
            },
            columns: [
                // Define your columns here
                {
                    data: 'client',
                    name: 'client'
                }, {
                    data: 'task_type',
                    name: 'task_type'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'user',
                    name: 'user'
                }, {
                    data: 'deadline',
                    name: 'deadline'
                }, {
                    data: 'date_added',
                    name: 'date_added'
                }, {
                    data: 'notes',
                    name: 'notes'
                }]
        });
    }
    $("#report_date_range").daterangepicker();
    $('#report_date_range').on('apply.daterangepicker', function(ev, picker) {
        user_id = $('#user_id').val();
        start_date = picker.startDate.format('YYYY-MM-DD');
        end_date = picker.endDate.format('YYYY-MM-DD');
        if($('#dvr-table').length > 0) {
            dvr.ajax.reload();
        }
        if ($('#task-log-table').length > 0) {
            task_log.ajax.reload();
        }
        update_summary('summary_call_meetings',start_date,end_date,user_id);
        update_summary('summary_contracts_payments',start_date,end_date,user_id);
    });
});
