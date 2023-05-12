let fecha = null;
let dia = null;
let mes = null;
let anio = null;
let hora = null;
let minuto = null;
let segundo = null;

let fecha_bd = null;
let fecha_texto = null;
let hora_texto = null;

let array_dias_semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
let array_meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

let txtFecha = $('#txtFecha');
let txtHora = $('#txtHora');

$(document).ready(function() {
    reloj();
    setInterval(reloj, 1000);
});

function reloj() {
    fecha = new Date();
    dia_semana = fecha.getDay()
    dia = fecha.getDate()
    mes = fecha.getMonth()
    anio = fecha.getFullYear()
    hora = fecha.getHours()
    minuto = fecha.getMinutes()
    segundo = fecha.getSeconds()

    fecha_texto = `${array_dias_semana[dia_semana]} ${dia} de ${array_meses[mes]} del ${anio}`;

    if (hora < 10) {
        hora = '0' + hora;
    }

    if (minuto < 10) {
        minuto = '0' + minuto;
    }

    if (segundo < 10) {
        segundo = '0' + segundo;
    }


    hora_texto = `${hora}:${minuto}:${segundo}`;

    if (dia < 10) {
        dia = '0' + dia;
    }

    mes++;

    if (mes < 10) {
        mes = '0' + mes;
    }

    fecha_bd = `${anio}-${mes}-${dia}`;

    txtFecha.text(fecha_texto);
    txtHora.text(hora_texto);
}