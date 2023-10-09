jQuery(document).ready(function($) {
    $('#bns-form').on('submit', function(event) {
        event.preventDefault();
        
        var data = {
            action: 'bns_generate_name',
            feedback: $('#feedback').val(),
            security: bns_ajax_object.security
        };
        
        $.post(bns_ajax_object.ajax_url, data, function(response) {
            $('#bns-result').text(response);
        });
    });
});
