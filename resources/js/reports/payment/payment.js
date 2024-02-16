let url1 = config.routes.payment_ajax;

jQuery(document).ready(function($) {
    let action = 'get_payment_history';
        $.ajax({
            method: 'GET',
            url: url1,
            data: {
                action: action
            }
        }).done(function (res) {
            console.log(res);
            if (res.data) {
                let item = res.data;
                if (item) {
                    let html = '';
                    jQuery.each(item,function(i,v){
                        html += '<tr>';
                        html += '<td>'+v.month+'</td>';
                        html += '<td>'+v.total_amount+'</td>';
                        html += '<td>'+v.accumulated_amount+'</td>';
                        html += '</tr>';
                    });
                    jQuery('#payment-report-table tbody').html('');
                    jQuery('#payment-report-table tbody').html(html);
                }
            }
        });

});