var pagoOrden = document.getElementById("pagoOrden");
var pagoFeedback = document.getElementById("pagoFeedback");

var presupuestoNro = document.getElementById("presupuestoNro");
var presupuestoNroOrden = document.getElementById("presupuestoNroOrden");
var presupuestoFecha = document.getElementById("presupuestoFecha");
// var presupuestoHora = document.getElementById("presupuestoHora");
// var presupuestoVto = document.getElementsByClassName("presupuestoVto");
var presupuestoClienteNombre = document.getElementById("presupuestoClienteNombre");
var presupuestoClienteMail = document.getElementById("presupuestoClienteMail");
var presupuestoClienteTelefono = document.getElementById("presupuestoClienteTelefono");
var presupuestoClienteDomicilio = document.getElementById("presupuestoClienteDomicilio");

var reciboNro = document.getElementById("reciboNro");
var reciboFecha = document.getElementById("reciboFecha");
// var reciboHora = document.getElementById("reciboHora");
var reciboClienteNombre = document.getElementById("reciboClienteNombre");
var reciboClienteMail = document.getElementById("reciboClienteMail");
var reciboClienteTelefono = document.getElementById("reciboClienteTelefono");
var reciboClienteDomicilio = document.getElementById("reciboClienteDomicilio");

$( document ).ready(function() {
    //MODAL PRESUPUESTO
    $('#btnPresupuesto').click(function(e){
        e.preventDefault();

        abrirModalPresupuesto();
    });
    //MODAL RECIBO
    $('#btnRecibo').click(function(e){
        e.preventDefault();
        abrirModalRecibo();
    });
    //GENERAR PDF PRESUPUESTO
    $('#btn_presupuesto_modal').click(function(e){
        e.preventDefault();
        generarPDF("presupuesto", presupuestoNro.innerHTML);
    });
    //GENERAR PDF RECIBO
    $('#btn_print_recibo').click(function(e){
        e.preventDefault();
        generarPDF("recibo",reciboNro.innerHTML);
    });
    // INSERTAR TOTAL DEL PAGO
    $('#total_pago_orden').click(function(e){
        e.preventDefault();
        var cargoOrden = document.getElementById('cargoOrden');
        
        pagoOrden.value = cargoOrden.value;
    });
    //GUARDAR PAGO DEL CLIENTE
    $('#guardar_pago_orden').click(function(e){
        e.preventDefault();
        guardarPago(id_orden, "pagoOrden", "pagoFeedback", "pagoGrupo");
        // $(pagoOrden).removeClass("is-valid is-invalid");
        // if(pagoOrden.value < 0){
        //     $(pagoOrden).addClass("is-invalid");
        //     pagoFeedback.innerHTML = "Debe ingresar un monto mayor a 0";
        //     return;
        // }
        
        // var action = "guardarPago";

        // $.ajax({
        //     type: "POST",
        //     url: "ajax.php",
        //     async: false,
        //     // id_comprobante descripcion cantidad precio precio_total
        //     data: {
        //         action:action,
        //         id:id_orden,
        //         pago:pagoOrden.value
        //     },
        //     success: function(response) {
        //         if (response != "error") {
        //             var pagoGuardado = JSON.parse(response);
        //             if(pagoGuardado){
        //                 for (var i = 0; i < pagoGrupo.length; i++) {
        //                     successGradiente($(pagoGrupo[i]));
        //                 }
        //             }
        //         }
        //     },
        //     error: function(error) {
        //         $(pagoOrden).addClass("is-invalid");
        //         pagoFeedback.innerHTML = "No se guardo correctamente";
        //         alert(error);
        //     }
        // });
    });
    //AGREGAR PRODUCTO PRESUPUESTO
    $('#agregar_producto_presupuesto').click(function(e){
        e.preventDefault();
        
        var descripcion = document.getElementById("descripcion");
        var cantidad = document.getElementById("cantidad");
        var precio = document.getElementById("precio");
        var precio_total = document.getElementById("precio_total");

        if(descripcion.classList.contains("is-invalid")){
            alertWarning.fire({
                title: 'No se puede cargar un producto/servicio con errores',
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Volver',
                showCloseButton: true
              })
              return;
        }
        var action = "agregarInsumo";
        var tabla = "insumos_presupuestos";
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            // id_comprobante descripcion cantidad precio precio_total
            data: {
                action:action,
                tabla:tabla,
                id_comprobante:presupuestoNro.innerHTML,
                descripcion:descripcion.value,
                cantidad:cantidad.value,
                precio:precio.value,
                precio_total:precio_total.innerHTML
            },
            success: function(response) {
                if (response != "error") {
                    var insumoAgregado = JSON.parse(response);
                    if(insumoAgregado){
                        actualizarTablaPresupuesto(presupuestoNro.innerHTML);
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });        
    });
    //AGREGAR PRODUCTO RECIBO
    $('#agregar_producto_recibo').click(function(e){
        e.preventDefault();
        if(descripcionRecibo.classList.contains("is-invalid")){
            alertWarning.fire({
                title: 'No se puede cargar un producto/servicio con errores',
                icon: 'warning',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Volver',
                showCloseButton: true
              })
              return;
        }
        var action = "agregarInsumo";
        var tabla = "insumos_recibos";
        
        var descripcion = document.getElementById("descripcionRecibo");
        var cantidad = document.getElementById("cantidadRecibo");
        var precio = document.getElementById("precioRecibo");
        var precio_total = document.getElementById("precio_total_insumo");

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            // id_comprobante descripcion cantidad precio precio_total
            data: {
                action:action,
                tabla:tabla,
                id_comprobante:reciboNro.innerHTML,
                descripcion:descripcion.value,
                cantidad:cantidad.value,
                precio:precio.value,
                precio_total:precio_total.innerHTML
            },
            success: function(response) {
                if (response != "error") {
                    var insumoAgregado = JSON.parse(response);
                    if(insumoAgregado){
                        actualizarTablaRecibo(reciboNro.innerHTML);
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });        
    });

    $('#agregar_servicio').click(function(e){
        e.preventDefault();
        // if(descripcionRecibo.classList.contains("is-invalid")){
        //     alertWarning.fire({
        //         title: 'No se puede cargar un producto/servicio con errores',
        //         icon: 'warning',
        //         showConfirmButton: false,
        //         showCancelButton: true,
        //         cancelButtonText: 'Volver',
        //         showCloseButton: true
        //       })
        //       return;
        // }
        var action = "agregarServicio";
        
        var descripcion = document.getElementById("descripcion");
        var precio = document.getElementById("precio");
        var fecha = document.getElementById("fecha");

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            // id_comprobante descripcion cantidad precio precio_total
            data: {
                action:action,
                descripcion:descripcion.value.toUpperCase(),
                precio:precio.value,
                fecha:fecha.value
            },
            success: function(response) {
                if (response != "error") {
                    var servicioAgregado = JSON.parse(response);
                    if (servicioAgregado) {
                        agregarServicioTabla(servicioAgregado[0]);
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });        
    });
});

function abrirModalPresupuesto(){
    $('#facturacionModal').modal('hide');
    var presupuestoObtenido = obtenerPresupuesto(id_orden);
    // id	id_orden	id_cliente	fecha
    presupuestoObtenido.done(function(responsePresupuesto) {
        if(responsePresupuesto != "error"){
            var info_presupuesto = JSON.parse(responsePresupuesto)[0];
            insertarPresupuesto(info_presupuesto);
        }
        else {
            var presupuestoCargado = crearPresupuesto(id_orden);
            presupuestoCargado.done(function(responsePresupuestoCargado) {
                if(responsePresupuestoCargado != "error"){
                    var info_presupuesto = JSON.parse(responsePresupuestoCargado)[0];
                    insertarPresupuesto(info_presupuesto);
                }
            });
        }
    });
    mostrarModal("presupuestoModal");
}

function obtenerPresupuesto(id) {
    var action = 'obtenerPresupuesto';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id}
    });
}

function crearPresupuesto(id) {
    var action = 'crearPresupuesto';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id}
    });        
}

function insertarPresupuesto(presupuesto) {
    presupuestoNro.innerHTML = presupuesto.id;
    presupuestoNroOrden.innerHTML = id_orden;
    presupuestoFecha.value = presupuesto.fechaInput;
    // presupuestoHora.innerHTML = presupuesto.hora;

    // var fechaVto = new Date();
    // var fechaPresupuesto = presupuesto.fecha.split("/");
    // fechaVto.setFullYear(fechaPresupuesto[2],fechaPresupuesto[1],fechaPresupuesto[0]);
    // fechaVto.setDate(fechaVto.getDate()+7);
    
    // for(var i = 0; i < presupuestoVto.length; i++) {
    //     presupuestoVto[i].innerHTML = fechaVto.getDate()+"/"+fechaVto.getMonth()+"/"+fechaVto.getFullYear();
    // }

    presupuestoClienteNombre.value = presupuesto.nombre;
    if(presupuesto.mail){
        presupuestoClienteMail.value = presupuesto.mail;
    }
    else{
        presupuestoClienteMail.value = "-";        
    }
    presupuestoClienteTelefono.value = presupuesto.telefono;
    if(presupuesto.domicilio){
        presupuestoClienteDomicilio.value = presupuesto.domicilio;
    }
    else{
        presupuestoClienteDomicilio.value = "-";        
    }

    actualizarTablaPresupuesto(presupuesto.id);
}

function actualizarPrecioPresupuesto() {
    var cantidad = document.getElementById("cantidad");
    var precio = document.getElementById("precio");
    var precio_total = document.getElementById("precio_total");
    precio_total.innerHTML = parseFloat(precio.value * cantidad.value).toFixed(2);

    var manoObra = document.getElementById("manoObra");
    var manoObraTotal = document.getElementById("manoObraTotal");
    
    var total_presupuesto = document.getElementById("total_presupuesto");
    var total = parseFloat(parseFloat(total_presupuesto.innerHTML).toFixed(2)) - parseFloat(parseFloat(manoObraTotal.innerHTML).toFixed(2));
    total_presupuesto.innerHTML = parseFloat(total).toFixed(2);

    manoObraTotal.innerHTML = parseFloat(manoObra.value).toFixed(2);
    total = parseFloat(parseFloat(total_presupuesto.innerHTML).toFixed(2)) + parseFloat(parseFloat(manoObraTotal.innerHTML).toFixed(2));
    total_presupuesto.innerHTML = parseFloat(total).toFixed(2);
}

function actualizarTablaPresupuesto(id_comprobante){
    limpiarManoObra();
    var tabla_insumos_presupuesto = document.getElementById("tabla_insumos_presupuesto");
    $(tabla_insumos_presupuesto).empty();

    var insumosPresupuesto = obtenerInsumos(id_comprobante, "presupuestos");
    insumosPresupuesto.done(function(responseInsumosPresupuesto) {
        if(responseInsumosPresupuesto != "error"){
            var info_insumos = JSON.parse(responseInsumosPresupuesto);
            var total_presupuesto = document.getElementById("total_presupuesto");
            total_presupuesto.innerHTML =  parseFloat("0").toFixed(2);
            for (var i = 0; i < info_insumos.length; i++) {
                if(info_insumos[i].descripcion == "MANO DE OBRA"){
                    var accion = "";
                    accion = '<a href="#" class="text-success" onclick="editManoObraPresupuesto(\'' + info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-floppy-disk"></i>';
                    accion += '<b> Guardar </b> </a>';

                    let row1 = tabla_insumos_presupuesto.insertRow(0);
                    let cell1_1 = row1.insertCell(0);
                    let cell1_2 = row1.insertCell(1);
                    let cell1_3 = row1.insertCell(2);
                    let cell1_4 = row1.insertCell(3);
                    let cell1_5 = row1.insertCell(4);
                    $(cell1_5).addClass("modelo");
        
                    cell1_1.innerHTML = info_insumos[i].descripcion;
                    cell1_2.innerHTML = 1;
                    cell1_3.id = "manoObraCell";
                    cell1_3.innerHTML = "<input class='text-dark text-bg-secondary bg-opacity-25 modelo' type='number' onchange='actualizarPrecioPresupuesto()' name='manoObra' id='manoObra' min='0.00' step='100.00' value='" + parseFloat(info_insumos[i].precio).toFixed(2) +"' placeholder='10.000,00' required>";
                    cell1_4.innerHTML = parseFloat(info_insumos[i].precio_total).toFixed(2);
                    cell1_4.id = "manoObraTotal";
                    cell1_5.innerHTML = accion;
                    
                }
                else{
                    var accion = "<div class='text-center mx-auto'>";
                    accion += '<a href="#" class="text-primary mx-2" onclick="editInsumo(\'' + info_insumos[i].id + '\', \'presupuesto\')">';
                        accion += '<i class="fa-solid fa-pen-to-square"></i>';
                    accion += '</a>';
                    accion += '<a href="#" class="text-danger mx-2" onclick="eliminarInsumoPresupuesto(\''+ info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-trash-can"></i>';
                    accion += '</a>';
                    
                    let row = tabla_insumos_presupuesto.insertRow();
                    row.id = "insumo-"+info_insumos[i].id;
                    let cell1 = row.insertCell(0);
                    let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(2);  
                    let cell4 = row.insertCell(3);
                    let cell5 = row.insertCell(4);
                    $(cell5).addClass("modelo");
    
                    cell1.innerHTML = info_insumos[i].descripcion;
                    cell2.innerHTML = info_insumos[i].cantidad;
                    cell3.innerHTML = parseFloat(info_insumos[i].precio).toFixed(2);
                    cell4.innerHTML = parseFloat(info_insumos[i].precio_total).toFixed(2);
                    cell5.innerHTML = accion;
                }
                
                var total = parseFloat(total_presupuesto.innerHTML) + parseFloat(info_insumos[i].precio_total);
                total_presupuesto.innerHTML = total.toFixed(2);
            }
        }
    });
    var descripcion = document.getElementById("descripcion");
    var cantidad = document.getElementById("cantidad");
    var precio = document.getElementById("precio");
    var precio_total = document.getElementById("precio_total");
    
    descripcion.value = "";
    cantidad.value = "";
    precio.value = "";
    precio_total.innerHTML = "";
}

function obtenerInsumos(id_comprobante, comprobante){
    var action = 'obtenerInsumos';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id_comprobante, comprobante:comprobante}
    });
}

function abrirModalRecibo(){
    $('#facturacionModal').modal('hide');

    var reciboObtenido = obtenerRecibo(id_orden);
    // id	id_orden	id_cliente	fecha
    reciboObtenido.done(function (responseRecibo) {
        if(responseRecibo != "error"){
            var info_recibo = JSON.parse(responseRecibo)[0];
            insertarRecibo(info_recibo);
        }
        else {
            var reciboCargado = crearRecibo(id_orden);
            reciboCargado.done(function(responseReciboCargado) {
                if(responseReciboCargado != "error"){
                    var info_recibo = JSON.parse(responseReciboCargado)[0];
                    insertarRecibo(info_recibo);
                }
            });
        }
    });
    // actualizarTablaRecibo(id_recibo);
    
    mostrarModal("reciboModal");
}

function actualizarTablaRecibo(id_recibo){
    limpiarManoObra();

    var tabla_insumos_recibo = document.getElementById("tabla_insumos_recibo");
    $(tabla_insumos_recibo).empty();

    var insumosRecibo = obtenerInsumos(id_recibo, "recibos");
    insumosRecibo.done(function(responseInsumosRecibo) {
        if(responseInsumosRecibo != "error"){
            var info_insumos = JSON.parse(responseInsumosRecibo);
            var total_recibo = document.getElementById("total_recibo");
            total_recibo.innerHTML =  parseFloat("0").toFixed(2);
            for (var i = 0; i < info_insumos.length; i++) {
                if(info_insumos[i].descripcion == "MANO DE OBRA"){
                    var accion = "";
                    accion = '<a href="#" class="text-success" onchange="actualizarPrecioRecibo()" onclick="editManoDeObraTrabajo(\'' + info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-floppy-disk"></i>';
                    accion += '<b> Guardar </b> </a>';

                    let row1 = tabla_insumos_recibo.insertRow(0);
                    row1.id = info_insumos[i].id;
                    let cell1_1 = row1.insertCell(0);
                    let cell1_2 = row1.insertCell(1);
                    let cell1_3 = row1.insertCell(2);
                    let cell1_4 = row1.insertCell(3);
                    let cell1_5 = row1.insertCell(4);
                    $(cell1_5).addClass("modelo");
        
                    cell1_1.innerHTML = info_insumos[i].descripcion;
                    cell1_2.innerHTML = 1;
                    cell1_3.id = "manoObraCell";
                    cell1_3.innerHTML = "<input class='text-dark text-bg-secondary bg-opacity-25 modelo' type='number' onchange='actualizarPrecioRecibo()' name='manoObra' id='manoObra' min='0.00' step='100.00' value='" + parseFloat(info_insumos[i].precio).toFixed(2) +"' placeholder='10.000,00' required>";
                    cell1_4.innerHTML = parseFloat(info_insumos[i].precio_total).toFixed(2);
                    cell1_4.id = "manoObraTotal";
                    cell1_5.innerHTML = accion;
                    
                }
                else{
                    var accion = "<div class='text-center mx-auto'>";
                        accion += '<a href="#" class="text-primary mx-2" onclick="editInsumo(\'' + info_insumos[i].id + '\', \'recibo\')">';
                            accion += '<i class="fa-solid fa-pen-to-square"></i>';
                        accion += '</a>';
                        accion += '<a href="#" class="text-danger mx-2" onclick="eliminarInsumoRecibo(\''+ info_insumos[i].id + '\')">';
                            accion += '<i class="fa-solid fa-trash-can"></i>';
                        accion += '</a>';
                    accion += '</div>';
                    
                    let row = tabla_insumos_recibo.insertRow();
                    row.id = "insumo-"+info_insumos[i].id;
                    let cell1 = row.insertCell(0);
                    let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(2);  
                    let cell4 = row.insertCell(3);
                    let cell5 = row.insertCell(4);
                    $(cell5).addClass("modelo");
    
                    cell1.innerHTML = info_insumos[i].descripcion;
                    cell2.innerHTML = info_insumos[i].cantidad;
                    cell3.innerHTML = parseFloat(info_insumos[i].precio).toFixed(2);
                    cell4.innerHTML = parseFloat(info_insumos[i].precio_total).toFixed(2);
                    cell5.innerHTML = accion;
                }
                
                var total = parseFloat(parseFloat(total_recibo.innerHTML).toFixed(2)) + parseFloat(parseFloat(info_insumos[i].precio_total).toFixed(2))
                total_recibo.innerHTML = parseFloat(total).toFixed(2);
            }
        }
    });
    var descripcion = document.getElementById("descripcionRecibo");
    var cantidad = document.getElementById("cantidadRecibo");
    var precio = document.getElementById("precioRecibo");
    var precio_total = document.getElementById("precio_total_insumo");
    
    descripcion.value = "";
    cantidad.value = "";
    precio.value = "";
    precio_total.innerHTML = "";
}

function obtenerRecibo(id) {
    var action = 'obtenerRecibo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id}
    });
}

function crearRecibo(id) {
    var action = 'crearRecibo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id}
    });        
}

function insertarRecibo(recibo) {
    reciboNro.innerHTML = recibo.id;
    reciboNroOrden.innerHTML = id_orden;
    reciboFecha.value = recibo.fechaInput;
    // reciboHora.innerHTML = recibo.hora;

    reciboClienteNombre.value = recibo.nombre;
    if(recibo.mail){
        reciboClienteMail.value = recibo.mail;
    }
    else{
        reciboClienteMail.value = "-";        
    }
    reciboClienteTelefono.value = recibo.telefono;
    if(recibo.domicilio){
        reciboClienteDomicilio.value = recibo.domicilio;
    }
    else{
        reciboClienteDomicilio.value = "-";        
    }

    actualizarTablaRecibo(recibo.id);
}

function actualizarPrecioRecibo() {
    var cantidad = document.getElementById("cantidadRecibo");
    var precio = document.getElementById("precioRecibo");
    var precio_total = document.getElementById("precio_total_insumo");
    precio_total.innerHTML = parseFloat(precio.value * cantidad.value).toFixed(2);

    var manoObra = document.getElementById("manoObra");
    var manoObraTotal = document.getElementById("manoObraTotal");
    
    var total_recibo = document.getElementById("total_recibo");
    var total = parseFloat(parseFloat(total_recibo.innerHTML).toFixed(2)) - parseFloat(parseFloat(manoObraTotal.innerHTML).toFixed(2));
    total_recibo.innerHTML = parseFloat(total).toFixed(2);

    manoObraTotal.innerHTML = parseFloat(manoObra.value).toFixed(2);
    total = parseFloat(parseFloat(total_recibo.innerHTML).toFixed(2)) + parseFloat(parseFloat(manoObraTotal.innerHTML).toFixed(2));
    total_recibo.innerHTML = parseFloat(total).toFixed(2);
}

function editManoObraPresupuesto(id) {
    var manoObra = document.getElementById("manoObra");
    var manoObraUpdate = actualizarManoObra(id, manoObra.value, "insumos_presupuestos");
    manoObraUpdate.done(function(response) {
        if(response != "error"){
            // var rowManoObra = $($('#tabla_insumos_presupuesto')[0].rows[0]);
            successGradiente($($('#tabla_insumos_presupuesto')[0].rows[0]));
        }
        else{
            alert(response);
        }
    });
}

function editManoDeObraTrabajo(id) {
    var manoObra = document.getElementById("manoObra");
    var manoObraUpdate = actualizarManoObra(id, manoObra.value, "insumos_recibos");
    manoObraUpdate.done(function(response) {
        if(response != "error"){
            successGradiente($($('#tabla_insumos_recibo')[0].rows[0]));
        }
        else{
            alert(response);
        }
    });
}

function actualizarManoObra(id, precio, tabla) {
    var action = 'actualizarInsumo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id, descripcion:"MANO DE OBRA", cantidad:1, precio:precio, precio_total:precio, tabla:tabla}
    });
}

function actualizarInsumo(id, insumo, comprobante) {
    var tabla = "";
    if(comprobante == "recibo"){
        tabla = "insumos_recibos";
    }
    else if(comprobante == "presupuesto"){
        tabla = "insumos_presupuestos";
    }
    var action = 'actualizarInsumo';
    const descripcion = insumo['descripcion'];
    const cantidad = insumo['cantidad'];
    const precio = insumo['precio'];
    const precio_total = insumo['precio_total'];

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id, descripcion:descripcion, cantidad:cantidad, precio:precio, precio_total:precio_total, tabla:tabla}
    });
}

function actualizarInputInsumoEdit(){
    document.getElementById('insumo-precio').value = parseFloat(document.getElementById('insumo-precio').value).toFixed(2);
    document.getElementById('insumo-precio-total').value = parseFloat(document.getElementById('insumo-cantidad').value * document.getElementById('insumo-precio').value).toFixed(2);
}

function editInsumo(id, comprobante){
    var insumo = document.getElementById("insumo-"+id).childNodes;
    ocultarModal(comprobante+"Modal");
    
    alertInfo.fire({
        title: 'Editar insumo',
        confirmButtonText:
            '<i class="fa fa-flopy-disk"></i> Guardar',
        confirmButtonColor: '#198754',
        showCancelButton: true,
        cancelButtonText: 'Volver',
        focusConfirm: true,
        html:
            '<label for="insumo-descripcion" class="swal2-input-label">Descripcion</label>' +
            '<input id="insumo-descripcion"class="swal2-input"  onchange="verificarDescripcion(this)" feedback="descripcionFeedback" value="'+ insumo[0].innerHTML  +'">' +
            '<p id="descripcionFeedback" class="my-2 text-center"></p>' +

            '<label for="insumo-cantidad" class="swal2-input-label">Cantidad</label>' +
            '<input id="insumo-cantidad" class="swal2-input" onchange="actualizarInputInsumoEdit()" value="'+ insumo[1].innerHTML  +'" type="number" placeholder="0">' +

            '<label for="insumo-precio" class="swal2-input-label">Precio</label>' +
            '<input id="insumo-precio" class="swal2-input" onchange="actualizarInputInsumoEdit()" value="'+ insumo[2].innerHTML  +'" type="number" min="0.00" step="100.00" placeholder="0.00">' +
            
            '<label for="insumo-precio-total" class="swal2-input-label">Precio total</label>' +
            '<input id="insumo-precio-total" class="swal2-input bg-secondary bg-opacity-10" value="'+ insumo[3].innerHTML  +'" disabled>'
            
    }).then((result) => {
        if (result.isConfirmed) {
            if(document.getElementById('insumo-descripcion').classList.contains("is-invalid")){
                alertWarning.fire({
                    title: 'No se puede cargar un producto/servicio con errores',
                    icon: 'warning',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Volver',
                    showCloseButton: true
                }).then(() => {
                    editInsumo(id, comprobante);
                });
            }
            else{
                const insumoEdit = {};
                insumoEdit['descripcion'] = document.getElementById('insumo-descripcion').value;
                insumoEdit['cantidad'] = document.getElementById('insumo-cantidad').value;
                insumoEdit['precio'] = document.getElementById('insumo-precio').value;
                insumoEdit['precio_total'] = document.getElementById('insumo-precio-total').value;
                var insumoActualizar = actualizarInsumo(id, insumoEdit, comprobante);
                insumoActualizar.done(function(response) {
                    if(response != "error"){
                        alertSuccess.fire('Cambios guardados', '', 'success').then((result) => {
                            if(comprobante == "recibo"){
                                abrirModalRecibo();
                            }
                            else if(comprobante == "presupuesto"){
                                abrirModalPresupuesto();
                            };
                        });
                    }
                    else{
                        alert(response);
                    }
                });
            }
        }
        else if (result.isDismissed) {
            alertInfo.fire('No se guardaron los cambios', '', 'info').then((result) => {
                if(comprobante == "recibo"){
                    abrirModalRecibo();
                }
                else if(comprobante == "presupuesto"){
                    abrirModalPresupuesto();
                };
            });
        }
    });
}

function successGradiente(rowManoObra){
    var clases = "text-bg-success bg-opacity-50 bg-gradient is-valid";
    rowManoObra.addClass(clases);
    setTimeout(() => {
        rowManoObra.removeClass(clases);
        // clases = "text-bg-success bg-opacity-25 bg-gradient";
        // rowManoObra.addClass(clases);
        // setTimeout(() => {
        //     rowManoObra.removeClass(clases);
        // }, 150);
     }, 2000);

}

function eliminarInsumoRecibo(id){
    var eliminarInsumoSeleccionado = eliminarInsumo(id, "insumos_recibos");
    eliminarInsumoSeleccionado.done(function(response) {
        if(response != "error"){
            actualizarTablaRecibo(reciboNro.innerHTML);
        }
        else{
            alert(response);
        }
    });
}

function eliminarInsumoPresupuesto(id){
    var eliminarInsumoSeleccionado = eliminarInsumo(id, "insumos_presupuestos");
    eliminarInsumoSeleccionado.done(function(response) {
        if(response != "error"){
            actualizarTablaPresupuesto(presupuestoNro.innerHTML);
        }
        else{
            alert(response);
        }
    });
}

function eliminarInsumo(id, tabla) {
    var action = 'eliminarInsumo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id, tabla:tabla}
    });
}

function limpiarManoObra(){
    if(document.getElementById("manoObraCell")){
        manoObraCell.parentNode.removeChild(manoObraCell);
    }
    if(document.getElementById("manoObra")){
        manoObra.parentNode.removeChild(manoObra);
    }
    if(document.getElementById("manoObraTotal")){
        manoObraTotal.parentNode.removeChild(manoObraTotal);
    }
}

function abrirModalIngresos(mes, anio){
    $('#tablaIngresos').DataTable().destroy();
    $('#tablaIngresos_rows').empty();
    
    $('#tablaIngresos').DataTable({
        searchPanes: {
            layout: 'columns-2',
            cascadePanes: true,
            dtOpts: {
                paging: true,
                pagingType: 'numbers',
                searching: true,
            }
        },
        dom: '<"text-center" P> r <"col-lg-3 col-md-6 col-sm-12" B> <"wrapper" <"col-6 float-end" f> <"col-6 " l> t <"col-6 float-end" p> <"col-6 " i>>',
        buttons:[
            {
                extend: 'excelHtml5',
                text: '<i class="fa-regular fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-lg btn-success mb-2',
                exportOptions: {
                    columns: ':visible'
                },
                filename: 'Sistema Gestion - Finanzas - Ingresos ' + Number(mes+1) + "-" + anio,
            }
        ],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ ingresos",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún ingreso registrado",
            "sInfo":           "Mostrando ingresos del _START_ al _END_ de un total de _TOTAL_ ingresos",
            "sInfoEmpty":      "Mostrando ingresos del 0 al 0 de un total de 0 ingresos",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ ingresos)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            searchPanes: {
                title: {
                    _: 'Filtros seleccionados - %d',
                },
                collapseMessage : "Minimizar filtros",
                showMessage: "Mostrar filtros",
                clearMessage: "Limpiar filtros",
                emptyPanes: ""
            }
        },
        order: [[0, 'des']],
        columnDefs: [
            {
                searchPanes: {
                    show: true,
                    initCollapsed: true,
                    className: "",
                },
                targets: [4, 3]
            },
            { className: "dt-head-center", targets: "_all" },
            {targets: 0, visible:false},
            {targets: 1, orderData: [0,1]},
            {targets: 2},
            {targets: 3},
            {targets: 4},
            {targets: 5}
        ],
        responsive: true,
        autoWidth: false,
        
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'Todos'],
        ]
    });
    var tablaIngresos = $('#tablaIngresos').DataTable();

    ingresosModalTitle.innerHTML = "Ingresos de " + meses[mes] + " del " + anio;
    const manosObraObtenidas = seleccionarManosObra();
    manosObraObtenidas.done(function(response) {
        if(response != "error"){
            const manosObra = filtrarManoObraPorFecha(JSON.parse(response), mes, anio);
            for(var i = 0; i < manosObra.length; i++) {
                const ordenSeleccionada = seleccionarOrdenCompleta(manosObra[i].id_orden);
                ordenSeleccionada.done(function(responseOrden) {
                    if(responseOrden != "error"){
                        var boton = '<button class="btn btn-outline-dark btn-sm" onclick="buscarOrdenesRelacionadasFinanzas(\''+manosObra[i].id_orden+'\')" style="width: 100%;">';
                        boton += manosObra[i].id_orden;
                        boton += "</button>";

                        const ordenRelacionada = JSON.parse(responseOrden)[0];
                        const fecha_sort = manosObra[i].fecha_devolucion;
                        const fecha = manosObra[i].fecha;
                        const orden = boton;
                        const auto = ordenRelacionada.patente + " - " + ordenRelacionada.modelo;
                        const cliente = ordenRelacionada.nombre;
                        const mano_obra_precio = "$" + manosObra[i].precio;

                        // <th scope="col">Fecha-Sort</th>
                        // <th scope="col">Fecha</th>
                        // <th scope="col">Orden</th>
                        // <th scope="col">Auto</th>
                        // <th scope="col">Cliente</th>
                        // <th scope="col">Mano de obra</th>
                        const pago = "<input class='form-control' type='number' onchange='' id='pago-"+manosObra[i].id_orden+"' min='0.00' step='100.00' value='"+manosObra[i].cobro+"' placeholder='10.000,00'>";

                        var tr = tablaIngresos.row.add([fecha_sort, fecha, orden, auto, cliente, mano_obra_precio, pago]).draw().node();
                        
                        // tr.setAttribute("onclick", "abrirModalOrden("+manosObra[i].id_orden+")"); 
                    }
                });
            }
            
        }
    });
    mostrarModal("ingresosModal");    
}

function abrirModalPendientes(mes, anio){
    $('#tablaPendientes').DataTable().destroy();
    $('#tablaPendientes_rows').empty();
    
    $('#tablaPendientes').DataTable({
        searchPanes: {
            layout: 'columns-2',
            cascadePanes: true,
            dtOpts: {
                paging: true,
                pagingType: 'numbers',
                searching: true,
            }
        },
        dom: '<"text-center" P> r <"col-lg-3 col-md-6 col-sm-12" B> <"wrapper" <"col-6 float-end" f> <"col-6 " l> t <"col-6 float-end" p> <"col-6 " i>>',
        buttons:[
            {
                extend: 'excelHtml5',
                text: '<i class="fa-regular fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-lg btn-success mb-2',
                exportOptions: {
                    columns: ':visible'
                },
                filename: 'Sistema Gestion - Finanzas - Pendientes ' + Number(mes+1) + "-" + anio,
            }
        ],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ pendientes",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún pendiente registrado",
            "sInfo":           "Mostrando pendientes del _START_ al _END_ de un total de _TOTAL_ pendientes",
            "sInfoEmpty":      "Mostrando pendientes del 0 al 0 de un total de 0 pendientes",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ pendientes)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            searchPanes: {
                title: {
                    _: 'Filtros seleccionados - %d',
                },
                collapseMessage : "Minimizar filtros",
                showMessage: "Mostrar filtros",
                clearMessage: "Limpiar filtros",
                emptyPanes: ""
            }
        },
        order: [[0, 'asc']],
        columnDefs: [
            {
                searchPanes: {
                    show: true,
                    initCollapsed: true,
                },
                targets: [4, 3]
            },
            { className: "dt-head-center", targets: "_all" },
            {targets: 0, visible:false},
            {targets: 1, orderData: [0,1], sClass:"columnaFechaPendientes align-middle"},
            {targets: 2, sClass:"columnaOrdenPendientes align-middle"},
            {targets: 3, sClass:"align-middle"},
            {targets: 4, sClass:"align-middle"},
            {targets: 5, sClass:"columnaCobroPendientes align-middle"},
            {targets: 6, sClass:"columnaPagoPendientes align-middle"}
        ],
        responsive: true,
        autoWidth: false,
        
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, 'Todos'],
        ]
    });
    var tablaPendientes = $('#tablaPendientes').DataTable();

    pendientesModalTitle.innerHTML = "Pagos pendientes de " + meses[mes] + " del " + anio;
    const ordenesObtenidas = seleccionarOrdenesPendiente();
    ordenesObtenidas.done(function(response) {
        if(response != "error"){ // TODO FIXME
            const ordenes = filtrarCobrosPendientes(JSON.parse(response), mes, anio);
            for(var i = 0; i < ordenes.length; i++) {
                var boton = '<button class="btn btn-outline-dark btn-sm" onclick="buscarOrdenesRelacionadasFinanzas(\''+ordenes[i].id+'\')" style="width: 100%;">';
                boton += ordenes[i].id;
                boton += "</button>";

                const fecha_sort = ordenes[i].fecha;
                const fecha = ordenes[i].fecha_input;
                const orden = boton;
                const auto = ordenes[i].patente + " - " + ordenes[i].modelo;
                const cliente = ordenes[i].nombre;
                const cobro = "$" + ordenes[i].cobro;
                // const pagado = "$" + ordenes[i].pago;

                // <th scope="col">Fecha-Sort</th>
                // <th scope="col">Fecha</th>
                // <th scope="col">Orden</th>
                // <th scope="col">Auto</th>
                // <th scope="col">Cliente</th>
                // <th scope="col">Mano de obra</th>
                
                // const pago = "<input class='form-control' type='number' onchange='' id='pago-"+ordenes[i].id+"' min='0.00' step='100.00' value='"+ordenes[i].pago+"' placeholder='10.000,00'>";
                const pago = inputPago(ordenes[i]);
                var tr = tablaPendientes.row.add([fecha_sort, fecha, orden, auto, cliente, cobro, pago]).draw().node();
                
                // tr.setAttribute("onclick", "abrirModalOrden("+ordenes[i].id_orden+")"); 
            }            
        }
    });
    mostrarModal("pendientesModal");    
}

function inputPago(orden){
    return (
    '<div class="input-group text-center container-fluid">'+
        '<input class="form-control pagoGrupo-'+orden.id+'" type="number" value="'+orden.pago+'" min="0.00" step="100.00" id="pagoOrden-'+orden.id+'" placeholder="0" data-toggle="tooltip" title="Dinero total que el cliente pago hasta la fecha">' +
        '<span class="input-group-text text-bg-primary" data-toggle="tooltip" title="Insertar total del dinero que deba pagar el cliente">' +
            '<a href="#" onclick="completarPago(\'pagoOrden-'+orden.id+'\', \''+orden.cobro+'\')">' +
                '<i class="fa-solid fa-money-bill-1-wave text-bg-primary h3 mt-2"></i>' +
            '</a>' +
        '</span>' +
        '<span class="input-group-text text-bg-success">' +
            '<a href="#" onclick="guardarPago(\''+orden.id+'\', \'pagoOrden-'+orden.id+'\', \'pagoFeedback-'+orden.id+'\', \'pagoGrupo-'+orden.id+'\')">' +
                '<i class="fa-solid fa-floppy-disk text-bg-success h3 mt-2"></i>' +
            '</a>' +
        '</span>' +
        '<div class="valid-feedback mt-2">' +
            'Se guardo correctamente' +
        '</div>' +
        '<div class="invalid-feedback mt-2">' +
            '<p id="pagoFeedback-'+orden.id+'"></p>' +
        '</div>' +
    '</div>'
    );
}

function filtrarManoObraPorFecha(manosObra, mes, anio){
    var manosObraFiltradas = [];
    for(var i = 0; i < manosObra.length; i++){
        const fechaMano = new Date(manosObra[i].fecha_devolucion);
        if(fechaMano.getFullYear() == anio && fechaMano.getMonth() == mes){
            manosObraFiltradas.push(manosObra[i]);
        }
    }
    return manosObraFiltradas;
    
}

function filtrarCobrosPendientes(ordenes, mes, anio){
    var ordenesFiltradas = [];
    for(var i = 0; i < ordenes.length; i++){
        const fecha = new Date(ordenes[i].fecha);
        if(fecha.getFullYear() == anio && fecha.getMonth() == mes){
            ordenesFiltradas.push(ordenes[i]);
        }
    }
    return ordenesFiltradas;
}

function verificarDescripcion(descripcionInput){
    $(descripcionInput).removeClass('is-invalid');
    const feedback = document.getElementById(descripcionInput.getAttribute('feedback'));
    feedback.innerHTML = "";
    
    if(descripcionInput.value.toUpperCase() == "MANO DE OBRA"){
        $(descripcionInput).addClass('is-invalid');
        var alert = '<div class="alert alert-danger" role="alert">';
        alert += 'No se puede ingresar otra MANO DE OBRA <i class="fa-solid fa-circle-exclamation"></i>';
        alert += '</div>';
        feedback.innerHTML = alert;
    }
}

function actualizarFecha(id, fecha, comprobante){
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id_comprobante descripcion cantidad precio precio_total
        data: {
            action:"actualizarFecha",
            id:id,
            fecha:fecha,
            tabla:comprobante
        },
        success: function(response) {
            if (response != "error") {
                var fechaCambiada = JSON.parse(response);
                if(fechaCambiada){
                    alertSuccess.fire({
                        title: 'Fecha actualizada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#198754',
                        showCloseButton: true
                    }).then(() => {
                        // editInsumo(id, comprobante);
                    });
                }
            }
        },
        error: function(error) {
            alert(error);
        }
    });
}

function actualizarCobro(id){
    var cobro = traerCobroRecibo(id);
    
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id_comprobante descripcion cantidad precio precio_total
        data: {
            action:"actualizarCobro",
            id:id,
            cobro:cobro
        },
        success: function(response) {
            if (response != "error") {
                var cobroGuardado = JSON.parse(response);
                if(cobroGuardado){
                }
            }
            else {
                alertError.fire({
                    title: 'No se pudo guardar el cobro',
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Volver',
                    showCloseButton: true
                }).then(() => {
                    // editInsumo(id, comprobante);
                });
            }
        },
        error: function(error) {
            $(pagoOrden).addClass("is-invalid");
            pagoFeedback.innerHTML = "No se guardo correctamente";
            alert(error);
        }
    });
    return cobro;
}

function actualizarCobros(){
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id_comprobante descripcion cantidad precio precio_total
        data: {
            action:"actualizarCobros"
        },
        success: function(response) {
            if (response != "error") {
                var cobroGuardado = JSON.parse(response);
                if(cobroGuardado){
                    alertSuccess.fire('Cambios guardados', '', 'success')
                }
            }
            else {
                alertError.fire({
                    title: 'No se pudo guardar el cobro',
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Volver',
                    showCloseButton: true
                }).then(() => {
                    // editInsumo(id, comprobante);
                });
            }
        },
        error: function(error) {
            $(pagoOrden).addClass("is-invalid");
            pagoFeedback.innerHTML = "No se guardo correctamente";
            alert(error);
        }
    });

}

function buscarOrdenesRelacionadasFinanzas(id_orden){
    sessionStorage.setItem('ordenBuscada', '" Orden '+id_orden+' "');
    location.replace("index.php?pagina=ordenes_historicas");
}

function guardarPago(id, pagoTag, feedbackTag, pagoGrupoTag){
    var pago = document.getElementById(pagoTag);
    var feedback = document.getElementById(feedbackTag);
    $(pago).removeClass("is-valid is-invalid");
    if(pago.value < 0){
        $(pago).addClass("is-invalid");
        feedback.innerHTML = "Debe ingresar un monto mayor a 0";
        return;
    }
    
    var action = "guardarPago";

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id_comprobante descripcion cantidad precio precio_total
        data: {
            action:action,
            id:id,
            pago:pago.value
        },
        success: function(response) {
            if (response != "error") {
                var pagoGuardado = JSON.parse(response);
                if(pagoGuardado){
                    const pagoGrupo = document.getElementsByClassName(pagoGrupoTag);
                    for (var i = 0; i < pagoGrupo.length; i++) {
                        successGradiente($(pagoGrupo[i]));
                    }
                }
            }
        },
        error: function(error) {
            $(pago).addClass("is-invalid");
            feedback.innerHTML = "No se guardo correctamente";
            alert(error);
        }
    });
}

function completarPago(pagoTag, cobro){
    var pago = document.getElementById(pagoTag);
    pago.value = cobro;
}

function agregarServicioTabla(servicio) {
    var tablaServicios = $('#tablaServicios').DataTable();
    var accion = "<div class='text-center mx-auto'>";
        accion += '<a href="#" class="text-primary mx-2" onclick="editServicio(\'' + servicio.id + '\', \'recibo\')">';
            accion += '<i class="fa-solid fa-pen-to-square"></i>';
        accion += '</a>';
        accion += '<a href="#" class="text-danger mx-2" onclick="eliminarServicio(\''+ servicio.id + '\')">';
            accion += '<i class="fa-solid fa-trash-can"></i>';
        accion += '</a>';
    accion += '</div>';

    var tr = tablaServicios.row.add([servicio.descripcion, parseFloat(servicio.precio).toFixed(2), servicio.fecha, servicio.fecha_input, accion]).draw().node();
    tr.id = "servicio-" + servicio.id;
}

function editServicio(id) {
    var servicio = document.getElementById("servicio-" + id).childNodes;
    var fecha = servicio[2].innerHTML.split("/")[2] + "-" + servicio[2].innerHTML.split("/")[1] + "-" + servicio[2].innerHTML.split("/")[0];
    
    alertInfo.fire({
        title: 'Editar servicio',
        confirmButtonText:
            '<i class="fa fa-flopy-disk"></i> Guardar',
        confirmButtonColor: '#198754',
        showCancelButton: true,
        cancelButtonText: 'Volver',
        focusConfirm: true,
        html:
            '<label for="servicio-descripcion" class="swal2-input-label">Descripcion</label>' +
            '<input id="servicio-descripcion" class="swal2-input text-uppercase" value="'+ servicio[0].innerHTML  +'">' +

            // '<label for="servicio-cantidad" class="swal2-input-label">Cantidad</label>' +
            // '<input id="servicio-cantidad" class="swal2-input" onchange="//actualizarInputInsumoEdit()" value="'+ servicio[1].innerHTML  +'" type="number" placeholder="0">' +

            '<label for="servicio-precio" class="swal2-input-label">Precio</label>' +
            '<input id="servicio-precio" class="swal2-input" onchange="//actualizarInputInsumoEdit()" value="'+ servicio[1].innerHTML  +'" type="number" min="0.00" step="100.00" placeholder="0.00">' +
            
            '<label for="servicio-fecha" class="swal2-input-label">Fecha</label>' +
            '<input id="servicio-fecha" class="swal2-input" value="'+ fecha  +'" type="date">'
            
    }).then((result) => { // TODO
        if (result.isConfirmed) {
            // if(document.getElementById('insumo-descripcion').classList.contains("is-invalid")){
            //     alertWarning.fire({
            //         title: 'No se puede cargar un producto/servicio con errores',
            //         icon: 'warning',
            //         showConfirmButton: false,
            //         showCancelButton: true,
            //         cancelButtonText: 'Volver',
            //         showCloseButton: true
            //     }).then(() => {
            //         editServicio(id);
            //     });
            // }
            // else{
                const servicioEdit = {};
                servicioEdit['descripcion'] = document.getElementById('servicio-descripcion').value.toUpperCase();
                servicioEdit['precio'] = document.getElementById('servicio-precio').value;
                servicioEdit['fecha'] = document.getElementById('servicio-fecha').value;
                var servicioActualizar = actualizarServicio(id, servicioEdit);
                servicioActualizar.done(function (response) {
                    if (response != "error") {
                        alertSuccess.fire('Cambios guardados', '', 'success').then((result) => {
                            // servicio[0].innerHTML = servicioEdit['descripcion'];
                            // servicio[1].innerHTML = servicioEdit['precio'];
                            // var fecha_dividida = servicioEdit['fecha'].split("-");
                            // servicio[2].innerHTML = fecha_dividida[2] + "/" + fecha_dividida[1] + "/" + fecha_dividida[0];
                            
                            // var tablaServicios = $('#tablaServicios').DataTable();
                            // tablaServicios.order( [ 0, 'asc' ] ).draw();
                            location.replace("index.php?pagina=servicios");
                        });
                    }
                    else{
                        alert(response);
                    }
                });
            // }
        }
        else if (result.isDismissed) {
            alertInfo.fire('No se guardaron los cambios', '', 'info');
        }
    });
}

function actualizarServicio(id, servicio) {
    var action = 'actualizarServicio';
    const descripcion = servicio['descripcion'];
    const precio = servicio['precio'];
    const fecha = servicio['fecha'];

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id, descripcion:descripcion, precio:precio, fecha:fecha}
    });
}

function eliminarServicio(id) {
    
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: {
            action:"eliminarServicio",
            id:id
        },
        success: function (response) {
            if (response != "error") {
                alertSuccess.fire('Serivicio eliminado').then((result) => {
                    location.replace("index.php?pagina=servicios");
                    return;
                });
            }
            else{
                alertError.fire('El serivicio no fue eliminado correctamente').then((result) => {
                    location.replace("index.php?pagina=servicios");
                    return;
                });
            }
        },
        error: function(error) {
            alert(error);
        }
    });
}