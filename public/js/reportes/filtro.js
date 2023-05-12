$(document).ready(function() {
    usuarios();
    presupuesto();
    lista_presupuesto();
});

function usuarios() {
    var tipo = $('#m_usuarios #tipo').parents('.form-group');
    var fecha_ini = $('#m_usuarios #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_usuarios #fecha_fin').parents('.form-group');

    tipo.hide();
    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_usuarios select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                tipo.hide();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'tipo':
                tipo.show();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                tipo.hide();
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function presupuesto() {
    var fecha_ini = $('#m_presupuesto #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_presupuesto #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_presupuesto select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function lista_presupuesto() {
    var fecha_ini = $('#m_lista_presupuesto #fecha_ini').parents('.col-md-4');
    var fecha_fin = $('#m_lista_presupuesto #fecha_fin').parents('.col-md-4');

    fecha_ini.hide();
    fecha_fin.hide();
    $('#m_lista_presupuesto select#fecha').change(function() {
        let fecha = $(this).val();
        switch (fecha) {
            case 'todos':
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}