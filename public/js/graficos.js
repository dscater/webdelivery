let g_ingresos = $('#g_ingresos');
let fecha_ini1 = $('#fecha_ini1');
let fecha_fin1 = $('#fecha_fin1');
let empresa1 = $('#empresa1');


let fecha_ini2 = $('#fecha_ini2');
let fecha_fin2 = $('#fecha_fin2');
let empresa2 = $('#empresa2');
let distribuidor2 = $('#distribuidor2');
let g_entregas = $('#g_entregas');

$(document).ready(function() {
    grafico_ingresos();
    grafico_entregas();
    fecha_fin1.change(grafico_ingresos);
    fecha_ini1.change(grafico_ingresos);
    empresa1.change(grafico_ingresos);

    fecha_fin2.change(grafico_entregas);
    fecha_ini2.change(grafico_entregas);
    empresa2.change(grafico_entregas);
    distribuidor2.change(grafico_entregas);
});

function grafico_ingresos() {
    $.ajax({
        type: "GET",
        url: $('#urlGIngresos').val(),
        data: {
            fecha_ini: fecha_ini1.val(),
            fecha_fin: fecha_fin1.val(),
            empresa: empresa1.val(),
        },
        dataType: "json",
        success: function(response) {
            Highcharts.chart('g_ingresos', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'CANTIDAD DE INGRESOS'
                },
                subtitle: {
                    text: response.total
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:.0f}</b>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Total',
                    data: response.data,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    // color:'#00a65a',
                }],
                lang: {
                    downloadCSV: 'Descargar CSV',
                    downloadJPEG: 'Descargar imagen JPEG',
                    downloadPDF: 'Descargar Documento PDF',
                    downloadPNG: 'Descargar imagen PNG',
                    downloadSVG: 'Descargar vector de imagen SVG ',
                    downloadXLS: 'Descargar XLS',
                    viewFullscreen: 'Ver pantalla completa',
                    printChart: 'Imprimir',
                    exitFullscreen: 'Salir de pantalla completa'
                }
            });
        }
    });
}

function grafico_entregas() {
    $.ajax({
        type: "GET",
        url: $('#urlGEntregas').val(),
        data: {
            fecha_ini: fecha_ini2.val(),
            fecha_fin: fecha_fin2.val(),
            empresa: empresa2.val(),
            distribuidor: distribuidor2.val(),
        },
        dataType: "json",
        success: function(response) {
            Highcharts.chart('g_entregas', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'CANTIDAD DE ENTREGAS POR DISTRIBUIDORES'
                },
                subtitle: {
                    text: response.total
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y:.0f}</b>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Cantidad',
                    data: response.data,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    // color:'#00a65a',
                }],
                lang: {
                    downloadCSV: 'Descargar CSV',
                    downloadJPEG: 'Descargar imagen JPEG',
                    downloadPDF: 'Descargar Documento PDF',
                    downloadPNG: 'Descargar imagen PNG',
                    downloadSVG: 'Descargar vector de imagen SVG ',
                    downloadXLS: 'Descargar XLS',
                    viewFullscreen: 'Ver pantalla completa',
                    printChart: 'Imprimir',
                    exitFullscreen: 'Salir de pantalla completa'
                }
            });
        }
    });
}