jQuery(document).ready(function($) {
    if ($('#yoodule-stripe-table').length) {
        $('#yoodule-stripe-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: yoodule_stripe_ajax.ajax_url,
                type: 'GET',
                data: function(d) {
                    d.action = 'yoodule_stripe_fetch_prices';
                    d.nonce = yoodule_stripe_ajax.nonce;
                }
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 }
            ]
        });
    }
}); 