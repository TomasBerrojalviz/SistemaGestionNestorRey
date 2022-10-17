
var presupuestoNro = document.getElementById("presupuestoNro");
var presupuestoFecha = document.getElementById("presupuestoFecha");
var presupuestoHora = document.getElementById("presupuestoHora");
var presupuestoVto = document.getElementsByClassName("presupuestoVto");
var presupuestoClienteNombre = document.getElementById("presupuestoClienteNombre");
var presupuestoClienteMail = document.getElementById("presupuestoClienteMail");
var presupuestoClienteTelefono = document.getElementById("presupuestoClienteTelefono");
var presupuestoClienteDomicilio = document.getElementById("presupuestoClienteDomicilio");


$( document ).ready(function() {
    //GENERAR PDF PRESUPUESTO
    $('#btn_presupuesto_modal').click(function(e){
        e.preventDefault();
        
        generarPDF("presupuesto", presupuestoNro.innerHTML);
    });
    //AGREGAR PRODUCTO PRESUPUESTO
    $('#agregar_producto_presupuesto').click(function(e){
        e.preventDefault();
        var action = "agregarInsumo";
        
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
                        console.log(insumoAgregado);
                        actualizarTablaPresupuesto(presupuestoNro.innerHTML);
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
    $('#llegadaModal').modal('hide');
    var presupuestoObtenido = obtenerPresupuesto(id_orden);
    // id	id_orden	id_cliente	fecha
    presupuestoObtenido.done(function(responsePresupuesto) {
        if(responsePresupuesto != "error"){
            console.log(responsePresupuesto);
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
                    accion = '<a href="#" class="text-success" onclick="editManoDeObraPresupuesto(\'' + info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-floppy-disk"></i>';
                    accion += '<b> Guardar </b> </a>';

                    let row1 = tabla_insumos_presupuesto.insertRow(0);
                    let cell1_1 = row1.insertCell(0);
                    let cell1_2 = row1.insertCell(1);
                    let cell1_3 = row1.insertCell(2);
                    let cell1_4 = row1.insertCell(3);
                    let cell1_5 = row1.insertCell(4);
        
                    cell1_1.innerHTML = info_insumos[i].descripcion;
                    cell1_2.innerHTML = 1;
                    cell1_3.innerHTML = "<input class='text-dark text-bg-secondary bg-opacity-25' type='number' onchange='actualizarPrecioPresupuesto()' name='manoObra' id='manoObra' min='0.00' step='100.00' value='" + parseFloat(info_insumos[i].precio).toFixed(2) +"' placeholder='10.000,00' required>";
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

function abrirModalInsumosTrabajo(){
    $('#trabajoModal').modal('hide');

    var reciboObtenido = obtenerRecibo(id_orden);
    // id	id_orden	id_cliente	fecha
    reciboObtenido.done(function(responseRecibo) {
        if(responseRecibo != "error"){
            console.log(responseRecibo);
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
    
    mostrarModal("insumosModal");
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
                    accion = '<a href="#" class="text-success" onclick="editManoDeObraTrabajo(\'' + info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-floppy-disk"></i>';
                    accion += '<b> Guardar </b> </a>';

                    let row1 = tabla_insumos_recibo.insertRow(0);
                    let cell1_1 = row1.insertCell(0);
                    let cell1_2 = row1.insertCell(1);
                    let cell1_3 = row1.insertCell(2);
                    let cell1_4 = row1.insertCell(3);
                    let cell1_5 = row1.insertCell(4);
        
                    cell1_1.innerHTML = info_insumos[i].descripcion;
                    cell1_2.innerHTML = 1;
                    cell1_3.innerHTML = "<input class='text-dark text-bg-secondary bg-opacity-25' type='number' onchange='actualizarPrecioRecibo()' name='manoObra' id='manoObra' min='0.00' step='100.00' value='" + parseFloat(info_insumos[i].precio).toFixed(2) +"' placeholder='10.000,00' required>";
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
    presupuestoNro.innerHTML = recibo.id;
    presupuestoFecha.innerHTML = recibo.fecha;
    presupuestoHora.innerHTML = recibo.hora;

    var fechaVto = new Date();
    var fechaPresupuesto = recibo.fecha.split("/");
    fechaVto.setFullYear(fechaPresupuesto[2],fechaPresupuesto[1],fechaPresupuesto[0]);
    fechaVto.setDate(fechaVto.getDate()+7);
    
    for(var i = 0; i < presupuestoVto.length; i++) {
        presupuestoVto[i].innerHTML = fechaVto.getDate()+"/"+fechaVto.getMonth()+"/"+fechaVto.getFullYear();
    }

    presupuestoClienteNombre.value = recibo.nombre;
    if(recibo.mail){
        presupuestoClienteMail.value = recibo.mail;
    }
    else{
        presupuestoClienteMail.value = "-";        
    }
    presupuestoClienteTelefono.value = recibo.telefono;
    if(recibo.domicilio){
        presupuestoClienteDomicilio.value = recibo.domicilio;
    }
    else{
        presupuestoClienteDomicilio.value = "-";        
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