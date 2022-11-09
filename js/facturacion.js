const pagoGrupo = document.getElementsByClassName("pagoGrupo");

var pagoOrden = document.getElementById("pagoOrden");
var pagoFeedback = document.getElementById("pagoFeedback");

var presupuestoNro = document.getElementById("presupuestoNro");
var presupuestoNroOrden = document.getElementById("presupuestoNroOrden");
var presupuestoFecha = document.getElementById("presupuestoFecha");
var presupuestoHora = document.getElementById("presupuestoHora");
var presupuestoVto = document.getElementsByClassName("presupuestoVto");
var presupuestoClienteNombre = document.getElementById("presupuestoClienteNombre");
var presupuestoClienteMail = document.getElementById("presupuestoClienteMail");
var presupuestoClienteTelefono = document.getElementById("presupuestoClienteTelefono");
var presupuestoClienteDomicilio = document.getElementById("presupuestoClienteDomicilio");

var reciboNro = document.getElementById("reciboNro");
var reciboFecha = document.getElementById("reciboFecha");
var reciboHora = document.getElementById("reciboHora");
var reciboVto = document.getElementsByClassName("reciboVto");
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
        
        pagoOrden.value = cargoOrden.value
    });
    //GUARDAR PAGO DEL CLIENTE
    $('#guardar_pago_orden').click(function(e){
        e.preventDefault();
        $(pagoOrden).removeClass("is-valid is-invalid");
        if(pagoOrden.value < 0){
            $(pagoOrden).addClass("is-invalid");
            pagoFeedback.innerHTML = "Debe ingresar un monto mayor a 0";
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
                id:id_orden,
                pago:pagoOrden.value
            },
            success: function(response) {
                if (response != "error") {
                    var pagoGuardado = JSON.parse(response);
                    if(pagoGuardado){
                        for (var i = 0; i < pagoGrupo.length; i++) {
                            successGradiente($(pagoGrupo[i]));
                        }
                    }
                }
            },
            error: function(error) {
                $(pagoOrden).addClass("is-invalid");
                pagoFeedback.innerHTML = "No se guardo correctamente";
                alert(error);
            }
        });
    });
    //AGREGAR PRODUCTO PRESUPUESTO
    $('#agregar_producto_presupuesto').click(function(e){
        e.preventDefault();
        var action = "agregarInsumo";
        var tabla = "insumos_presupuestos";
        
        var descripcion = document.getElementById("descripcion");
        var cantidad = document.getElementById("cantidad");
        var precio = document.getElementById("precio");
        var precio_total = document.getElementById("precio_total");

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
    presupuestoFecha.innerHTML = presupuesto.fecha;
    presupuestoHora.innerHTML = presupuesto.hora;

    var fechaVto = new Date();
    var fechaPresupuesto = presupuesto.fecha.split("/");
    fechaVto.setFullYear(fechaPresupuesto[2],fechaPresupuesto[1],fechaPresupuesto[0]);
    fechaVto.setDate(fechaVto.getDate()+7);
    
    for(var i = 0; i < presupuestoVto.length; i++) {
        presupuestoVto[i].innerHTML = fechaVto.getDate()+"/"+fechaVto.getMonth()+"/"+fechaVto.getFullYear();
    }

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
                    var accion = "";
                    accion = '<a href="#" class="text-danger" onclick="eliminarInsumoPresupuesto(\''+ info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-trash-can"></i>';
                    accion += '</a>';
                    
                    let row = tabla_insumos_presupuesto.insertRow();
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
    $('#trabajoModal').modal('hide');

    var reciboObtenido = obtenerRecibo(id_orden);
    // id	id_orden	id_cliente	fecha
    reciboObtenido.done(function(responseRecibo) {
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
                    var accion = "";
                    accion = '<a href="#" class="text-danger" onclick="eliminarInsumoRecibo(\''+ info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-trash-can"></i>';
                    accion += '</a>';
                    
                    let row = tabla_insumos_recibo.insertRow();
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
    reciboFecha.innerHTML = recibo.fecha;
    reciboHora.innerHTML = recibo.hora;

    var fechaVto = new Date();
    var fecharecibo = recibo.fecha.split("/");
    fechaVto.setFullYear(fecharecibo[2],fecharecibo[1],fecharecibo[0]);
    fechaVto.setDate(fechaVto.getDate()+7);
    
    for(var i = 0; i < reciboVto.length; i++) {
        reciboVto[i].innerHTML = fechaVto.getDate()+"/"+fechaVto.getMonth()+"/"+fechaVto.getFullYear();
    }

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
    var action = 'actualizarManoObra';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id, precio:precio, tabla:tabla}
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

function actualizarFecha(id, tabla){        
    var action = "actualizarFecha";
    var tabla = "recibos";

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id_comprobante descripcion cantidad precio precio_total
        data: {
            action:action,
            id:id,
            tabla:tabla
        },
        success: function(response) {
            if (response != "error") {
                var fechaActualizada = JSON.parse(response);
                if(fechaActualizada){
                }
            }
        },
        error: function(error) {
            alert(error);
        }
    });
}