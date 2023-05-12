let urlProductos = $('#urlProductos').val();

$(document).ready(function() {
    // empresaProductos();
    $('#empresa_id').change(empresaProductos);
});

function empresaProductos() {
    if ($('#empresa_id').val() != '') {
        $.ajax({
            type: "GET",
            url: urlProductos,
            data: { empresa_id: $('#empresa_id').val() },
            dataType: "json",
            success: function(response) {
                $('#producto_id').html(response.productos);
                $('#cliente_id').html(response.clientes);
            }
        });
    } else {
        $('#producto_id').html('');
    }
}