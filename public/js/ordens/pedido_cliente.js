let fila = `<tr class="fila">
                <td>#</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="accion">
                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>`;
let fila_vacio = `<tr class="vacio">
                <td colspan="7" class="text-center text-gray">AÚN NO SE AGREGÓ NINGÚN PRODUCTO</td>
            </tr>`;
let txtTotal = $("#txtTotal");
let contenedorLista = $("#contenedorLista");
let contenedorCarrito = $("#contenedorCarrito");
let btnRegistraOrden = $("#btnRegistraOrden");
$(document).ready(function () {
    listarProductosCarrito();
    contenedorLista.on("click", ".agregarProducto", function () {
        let producto_id = $(this).attr("data-id");
        let precio = parseFloat($(this).attr("data-precio"));
        let nombre = $(this).attr("data-nombre");
        let empresa = $(this).attr("data-empresa");
        Swal.fire({
            title: "Indica la cantidad",
            html: "",
            input: "number",
            inputPlaceholder: "Ingrese el valor aquí...",
            inputAttributes: {
                min: 1,
                class: "form-control",
            },
            inputValue: 1,
            showCancelButton: true,
            confirmButtonColor: "#2E86C1",
            confirmButtonText: "Agregar al carrito",
            cancelButtonText: "No, cancelar",
            inputValidator: (value) => {
                if (!value || value < 1) {
                    return "Por favor, ingrese un número válido mayor o igual a 1";
                }
            },
        }).then((result) => {
            if (result.value) {
                let subtotal = parseFloat(result.value) * parseFloat(precio);
                oCarrito.productos.push({
                    id: 0,
                    producto_id: producto_id,
                    nombre: nombre,
                    empresa: empresa,
                    cantidad: result.value,
                    precio: precio.toFixed(2),
                    subtotal: subtotal,
                });
                listarProductosCarrito();
                mensajeNotificacion("Producto agregado", "success");
            }
        });
    });

    contenedorCarrito.on("click", "tr.fila td.accion button", function () {
        let fila = $(this).parents("tr.fila");
        let id = fila.attr("data-id");
        if (id != 0) {
            oCarrito.eliminados.push(id);
        }
        oCarrito.productos.splice(fila.attr("data-index"), 1);
        listarProductosCarrito();
    });
    btnRegistraOrden.click(registrarOrden);
});

function registrarOrden() {
    if (oCarrito.productos.length > 0) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $("#token").val(),
            },
            type: "POST",
            url: $("#urlRegistraOrden").val(),
            data: oCarrito,
            dataType: "json",
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    html: "Su nro. de orden es: " + response.orden.nro_orden,
                    showConfirmButton: false,
                });
                if (typeof array_productos == "undefined") {
                    oCarrito.productos = [];
                }
                listarProductosCarrito();
            },
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "No hay productos en el carrito",
            showConfirmButton: false,
        });
    }
}

function listaProductosEmpresas() {
    console.log("asda");
    $.ajax({
        type: "GET",
        url: $("#urlListaProductosEmpresas").val(),
        data: {
            texto: $("#texto_busqueda").val(),
            empresa_id: $("#select_empresa_busqueda").val(),
        },
        dataType: "json",
        success: function (response) {
            contenedorLista.html(response.html);
        },
    });
}

function listarProductosCarrito() {
    contenedorCarrito.html("");
    if (oCarrito.productos.length > 0) {
        let contador = 1;
        let suma_total = 0;
        oCarrito.productos.forEach((elem, index) => {
            suma_total += parseFloat(elem.subtotal);
            let nueva_fila = $(fila).clone();
            nueva_fila.attr("data-index", index);
            nueva_fila.attr("data-id", elem.id);
            nueva_fila.children("td").eq(0).text(contador++);
            nueva_fila.children("td").eq(1).text(elem.nombre);
            nueva_fila.children("td").eq(2).text(elem.empresa);
            nueva_fila.children("td").eq(3).text(elem.precio);
            nueva_fila.children("td").eq(4).text(elem.cantidad);
            nueva_fila.children("td").eq(5).text(elem.subtotal);
            if (oCarrito.muestra_accion == "false") {
                nueva_fila.children("td").eq(6).remove();
            }
            contenedorCarrito.append(nueva_fila);
        });
        txtTotal.text(suma_total.toFixed(2));
        btnRegistraOrden.removeAttr("disabled");
    } else {
        btnRegistraOrden.prop("disabled", true);
        txtTotal.text("0.00");
        contenedorCarrito.html(fila_vacio);
    }
}
