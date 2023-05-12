let url_ordens = $('#url_ordens').val();
let sw_form = $('#sw_form').val();
$(document).ready(function() {
    $('#cliente_id').change(obtieneOrdens);
});

function obtieneOrdens() {
    if ($('#cliente_id').val() != '') {
        $.ajax({
            type: "GET",
            url: url_ordens,
            data: {
                cliente_id: $('#cliente_id').val(),
                sw: sw_form
            },
            dataType: "json",
            success: function(response) {
                $('#orden_id').html(response);
            }
        });
    } else {
        $('#orden_id').html('');
    }
}