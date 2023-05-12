let urlTipo = $('#urlTipo').val();
let contenedor_empresas = $('#contenedor_empresas');
$(document).ready(function() {
    $('#tipo').change(getTipo);
});

function getTipo() {
    $.ajax({
        type: "GET",
        url: urlTipo,
        data: {
            tipo: $('#tipo').val()
        },
        dataType: "json",
        success: function(response) {
            contenedor_empresas.html(response.html);
        }
    });
}