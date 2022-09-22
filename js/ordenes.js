const dataOrden = document.getElementsByClassName("dataOrden");
const cambiosAceiteDatos = document.getElementsByClassName("cambiosAceiteDatos");

var ordenModalTitle = document.getElementById("ordenModalTitle");
var ordenId = document.getElementById("ordenId");
var fecha_recibido = document.getElementById("fecha_recibido");
var id_recibo = document.getElementById("id_recibo");
var ordenProblema = document.getElementById("ordenProblema");
var ordenEstado = document.getElementById("ordenEstado");
var colAuto = document.getElementById("colAuto");
var ordenAuto = document.getElementById("ordenAuto");
var ordenAutoPatente = document.getElementById("ordenAutoPatente");
var ordenAutoMarca = document.getElementById("ordenAutoMarca");
var ordenAutoModelo = document.getElementById("ordenAutoModelo");
var ordenAutoCliente = document.getElementById("ordenAutoCliente");
var btn_orden_modal = document.getElementById("btn_orden_modal");
var id_orden = 0;
var presupuestoNro = document.getElementById("presupuestoNro");
var presupuestoFecha = document.getElementById("presupuestoFecha");
var presupuestoHora = document.getElementById("presupuestoHora");
var presupuestoVto = document.getElementsByClassName("presupuestoVto");
var presupuestoClienteNombre = document.getElementById("presupuestoClienteNombre");
var presupuestoClienteMail = document.getElementById("presupuestoClienteMail");
var presupuestoClienteTelefono = document.getElementById("presupuestoClienteTelefono");
var presupuestoClienteDomicilio = document.getElementById("presupuestoClienteDomicilio");

//VAR CAMBIOS
var cambiosModalTitle = document.getElementById("cambiosModalTitle");
var aceiteCheck = document.getElementById("aceiteCheck");
var aceiteCheckFiltro = document.getElementById("aceiteCheckFiltro");
var aireCheck = document.getElementById("aireCheck");
var combustibleCheck = document.getElementById("combustibleCheck");
var habitaculoCheck = document.getElementById("habitaculoCheck");
var fecha_cambio = document.getElementById("fecha_cambio");
var aceite = document.getElementById("aceite");
var km_actual = document.getElementById("km_actual");
var prox_cambio = document.getElementById("prox_cambio");
var filtro_aceite = document.getElementById("filtro_aceite");
var filtro_aire = document.getElementById("filtro_aire");
var filtro_combustible = document.getElementById("filtro_combustible");
var filtro_habitaculo = document.getElementById("filtro_habitaculo");
var btn_cambios_modal = document.getElementById("btn_cambios_modal");
var aceite_ins = document.getElementById("aceite_ins");
var km_actual_ins = document.getElementById("km_actual_ins");
var prox_cambio_ins = document.getElementById("prox_cambio_ins");
var filtro_aire = document.getElementById("filtro_aire");
var filtro_combustible = document.getElementById("filtro_combustible");
var filtro_habitaculo = document.getElementById("filtro_habitaculo");
var autoCambio = document.getElementById("autoCambio");

$( document ).ready(function() {

    //MODAL FORM CREAR ORDEN
    $('#btnAgregarOrden').click(function(e){ 
        e.preventDefault();

        abrirModalOrden(0);
    });

    //BTN MODAL ORDEN 
    $('#btn_orden_modal').click(function(e){
        e.preventDefault();
        var action = btn_orden_modal.getAttribute('accion');
        var autoSeleccionado = ordenAuto.value.split(" - ");

        var autoBuscado = obtenerAutoPorPatente(autoSeleccionado[0]);
        autoBuscado.done(function(responseAuto){
            if(responseAuto != "error" || action == "editarOrden"){
                var auto_id = 0;
                if(action == "crearOrden"){
                    var info_auto = JSON.parse(responseAuto);
                    ordenAutoCliente.value = info_auto[0].id_cliente;
                    auto_id = info_auto[0].id;

                }
                var id_presupuesto =  0;
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    async: false,
                    // id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado
                    data: {
                        action:action,
                        id:ordenId.value,
                        estado:ordenEstado.value,
                        id_auto:auto_id,
                        problema:ordenProblema.value,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response != "error") {
                            var autoCargado = JSON.parse(response);
                            if(autoCargado){
                                if(window.history.replaceState) {
                                    window.history.replaceState(null, null, window.location.href);
                                }

                                ocultarModal("ordenModal");
                                mostrarModal("successModal");
                                modalAbierto = null;
                            }
                        }
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
        });
                
    });
    //MODAL LLEGADA
    $('#btnLlegada').click(function(e){
        e.preventDefault();

        $('#ordenModal').modal('hide');
        
        mostrarModal("llegadaModal");
    });
    //MODAL TRABAJO
    $('#btnTrabajo').click(function(e){
        e.preventDefault();

        $('#ordenModal').modal('hide');
        
        mostrarModal("trabajoModal");
    });
    //MODAL ENTREGA
    $('#btnEntrega').click(function(e){
        e.preventDefault();

        $('#ordenModal').modal('hide');
        
        mostrarModal("entregaModal");
    });
    //MODAL PRESUPUESTO
    $('#btnPresupuesto').click(function(e){
        e.preventDefault();

        abrirModalPresupuesto();
    });
    //MODAL INSUMOS
    $('#btnInsumos').click(function(e){
        e.preventDefault();
        $('#trabajoModal').modal('hide');
        
        mostrarModal("insumosModal");
    });
    //MODAL HISTORIAL AGREGAR
    $('#btn_historial_cambios').click(function(e){
        e.preventDefault();
        
        abrirModalHistorial();
    });
    //MODAL CAMBIOS AGREGAR
    $('#btn_agregar_cambios').click(function(e){
        e.preventDefault();
        
        abrirModalCambios();
    });
    //AGREGAR CAMBIOS
    $('#btn_cambios_modal').click(function(e){
        e.preventDefault();
        var action = btn_cambios_modal.getAttribute('accion');
        var fecha_cambio_aux = "";
        var aceite_aux = "";
        var km_actual_aux = "";
        var prox_cambio_aux = "";
        var filtro_aceite_aux = "";
        var filtro_aire_aux = "";
        var filtro_combustible_aux = "";
        var filtro_habitaculo_aux = "";
        if(aceiteCheck.checked){
            fecha_cambio_aux = 'DEFAULT';
            aceite_aux = aceite_ins.value;
            km_actual_aux = km_actual_ins.value;
            prox_cambio_aux = prox_cambio_ins.value;
            console.log("aceite.value = " + aceite_aux);
            console.log("km_actual.value = " + km_actual_aux);
            console.log("prox_cambio.value = " + prox_cambio_aux);
        }
        if(aceiteCheckFiltro.checked){
            filtro_aceite_aux = 'DEFAULT';
        }
        if(aireCheck.checked){
            filtro_aire_aux = 'DEFAULT';
        }
        if(combustibleCheck.checked){
            filtro_combustible_aux = 'DEFAULT';
        }
        if(habitaculoCheck.checked){
            filtro_habitaculo_aux = 'DEFAULT';
        }
        
        // id	id_auto	fecha_cambio	aceite	km_actual	prox_cambio	filtro_aceite	filtro_aire	filtro_combustible	filtro_habitaculo
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            data: {action:action, id_auto:autoCambio.value, fecha_cambio:fecha_cambio_aux, aceite:aceite_aux, km_actual:km_actual_aux, prox_cambio:prox_cambio_aux, filtro_aceite:filtro_aceite_aux, filtro_aire:filtro_aire_aux, filtro_combustible:filtro_combustible_aux, filtro_habitaculo:filtro_habitaculo_aux},
            success: function(response) {
                if (response != "error") {
                    var cambioAgregado = JSON.parse(response);
                    if(cambioAgregado){
                        ocultarModal("ordenModal");
                        ocultarModal("cambiosModal");
                        mostrarModal("successModal");
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        abrirModalOrden(id_orden);
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });
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
            // id_presupuesto descripcion cantidad precio precio_total
            data: {
                action:action,
                id_presupuesto:presupuestoNro.innerHTML,
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


function abrirModalOrden(id) {
    $(ordenAuto).removeClass('is-invalid').removeClass('is-valid');
    $(ordenAuto).removeClass('is-invalid').removeClass('is-valid');
    $('#panelsStayOpen-collapseOne').removeClass('show');
    var panelsStayOpen_btn = document.getElementById("panelsStayOpen_btn");
    $(panelsStayOpen_btn).addClass('collapsed');
    panelsStayOpen_btn.setAttribute("aria-expanded", "false");

    if (id == 0){
        colAuto.style.display = "initial";
        for (var i = 0; i < dataOrden.length; i++) {
            var element = dataOrden[i];
            element.style.display = "none";
        }
        ordenModalTitle.innerHTML = "Crear orden";
        ordenId.value = 0;
        ordenProblema.value = "";
        ordenAuto.value = "";
        btn_orden_modal.setAttribute("accion", "crearOrden");
        btn_orden_modal.value = "Crear orden";
    }
    else{ //TODO TERMINAR OBTENER DATOS
        colAuto.style.display = "none";
        
        ordenModalTitle.innerHTML = "Orden";
        ordenId.value = id;
        
        id_orden = id;

        // id_recibo = obtenerRecibo();
        // ordenProblema = obtenerProblema();
        for (var i = 0; i < dataOrden.length; i++) {
            var element = dataOrden[i];
            element.style.display = "initial";
        }
        var orden = obtenerOrden(id);
        orden.done(function(responseOrden) {
            var info_orden = JSON.parse(responseOrden);
            var autoEditar = obtenerAuto(info_orden[0].id_auto);
            autoEditar.done(function(responseAuto){
                var info_auto = JSON.parse(responseAuto);
                mostrarCambiosAuto(info_auto[0].id);
                ordenAutoPatente.value = info_auto[0].patente;
                var modeloAuto = obtenerModelo(info_auto[0].id_modelo);
                modeloAuto.done(function(responseModelo){
                    var info_modelo = JSON.parse(responseModelo);
                    ordenAutoModelo.value = info_modelo[0].modelo;
                    var marcaAuto = obtenerMarca(info_modelo[0].id_marca);
                    marcaAuto.done(function(responseMarca){
                        var info_marca = JSON.parse(responseMarca);
                        ordenAutoMarca.value = info_marca[0].marca;
                    });
                    
                });
                // ordenEstado.value = obtenerEstado(id);
                var clienteAuto = obtenerCliente(info_auto[0].id_cliente);
                clienteAuto.done(function(responseCliente){
                    var info_cliente = JSON.parse(responseCliente);
                    ordenAutoCliente.value = info_cliente[0].nombre;
                    
                });
                
            });
            estadosSelect(info_orden[0].estado, ordenEstado);
            
            var btnEntrega = document.getElementById("btnEntrega");
            if(ordenEstado.value > 3){
                btnEntrega.disabled = false;
            }
            else{
                btnEntrega.disabled = true;
            }
            fecha_recibido.value = transDate(info_orden[0].fecha_recibido);
            id_recibo.value = info_orden[0].id_recibo;
            ordenProblema.value = info_orden[0].problema;
        });
        
        btn_orden_modal.setAttribute("accion", "editarOrden");
        btn_orden_modal.value = "Guardar";

    }
    mostrarModal("ordenModal");
}

function obtenerOrden(id_buscado) {
    var action = 'seleccionarOrden';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_orden:id_buscado}
    });
}

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

function actualizarTablaPresupuesto(id_presupuesto){
    var tabla_insumos = document.getElementById("tabla_insumos");
    $(tabla_insumos).empty();

    var insumosPresupuesto = obtenerInsumosPresupuesto(id_presupuesto);
    insumosPresupuesto.done(function(responseInsumosPresupuesto) {
        if(responseInsumosPresupuesto != "error"){
            var info_insumos = JSON.parse(responseInsumosPresupuesto);
            var total_presupuesto = document.getElementById("total_presupuesto");
            total_presupuesto.innerHTML =  parseFloat("0").toFixed(2);
            
    //     <tr>
    //     <th>Mano de obra</th>
    //     <th>1</th>
    //     <th>
    //         <input class="text-dark text-bg-secondary bg-opacity-25" type="number" name="item1" id="item1" min="0.00" step="0.01" value="10000.00" placeholder="0.00" required>
    //     </th>
    //     <th>10.000,00</th>
    //     <th>(-)</th>
    // </tr>
            
            for (var i = 0; i < info_insumos.length; i++) {
                if(info_insumos[i].descripcion == "MANO DE OBRA"){
                    var accion = "";
                    accion = '<a href="#" class="text-success" onclick="editManoDeObraPresupuesto(\'' + info_insumos[i].id + '\')">';
                        accion += '<i class="fa-solid fa-floppy-disk"></i>';
                    accion += '<b> Guardar </b> </a>';

                    let row1 = tabla_insumos.insertRow(0);
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
                    
                    let row = tabla_insumos.insertRow();
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
                
                var total = parseFloat(parseFloat(total_presupuesto.innerHTML).toFixed(2)) + parseFloat(parseFloat(info_insumos[i].precio_total).toFixed(2))
                total_presupuesto.innerHTML = parseFloat(total).toFixed(2);
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

function obtenerInsumosPresupuesto(id_presupuesto){
    var action = 'obtenerInsumosPresupuesto';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id:id_presupuesto}
    });
}

function obtenerCambios(id_auto){
    var action = 'obtenerCambios';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_auto:id_auto}
    });

}

function mostrarCambiosAuto(id_auto){
    var cambiosObtenidos = obtenerCambios(id_auto);
    autoCambio.value = id_auto;
    // id	id_orden	id_cliente	fecha
    cambiosObtenidos.done(function(responseCambios) {
        if(responseCambios != "error"){
            var info_cambios = JSON.parse(responseCambios);
            var fecha_cambio_aux = [];
            var filtro_aceite_aux = [];
            var filtro_aire_aux = [];
            var filtro_combustible_aux = [];
            var filtro_habitaculo_aux = [];
            for(var i = 0; i < info_cambios.length; i++){
                fecha_cambio_aux.push(info_cambios[i].fecha_cambio);
                filtro_aceite_aux.push(info_cambios[i].filtro_aceite);
                filtro_aire_aux.push(info_cambios[i].filtro_aire);
                filtro_combustible_aux.push(info_cambios[i].filtro_combustible);
                filtro_habitaculo_aux.push(info_cambios[i].filtro_habitaculo);
            }
            var strDate = maxDate(fecha_cambio_aux);
            if(strDate == "0000-00-00 00:00:00"){
                fecha_cambio.innerHTML = "Sin cambios";
                aceite.innerHTML = "-";
                km_actual.innerHTML = "-";
                prox_cambio.innerHTML = "-";
            }
            else{
                for(i=0; i<info_cambios.length; i++){
                    if(info_cambios[i].fecha_cambio == strDate){
                        aceite.innerHTML = info_cambios[i].aceite;
                        km_actual.innerHTML = info_cambios[i].km_actual;
                        prox_cambio.innerHTML = info_cambios[i].prox_cambio;
                    }
                }
                fecha_cambio.innerHTML = transDate(strDate);
            }
            strDate = maxDate(filtro_aceite_aux);
            if(strDate == "0000-00-00 00:00:00"){
                filtro_aceite.innerHTML = "Sin cambios";
            }
            else{
                filtro_aceite.innerHTML = transDate(strDate);
            }
            strDate = maxDate(filtro_aire_aux);
            if(strDate == "0000-00-00 00:00:00"){
                filtro_aire.innerHTML = "Sin cambios";
            }
            else{
                filtro_aire.innerHTML = transDate(strDate);
            }
            strDate = maxDate(filtro_combustible_aux);
            if(strDate == "0000-00-00 00:00:00"){
                filtro_combustible.innerHTML = "Sin cambios";
            }
            else{
                filtro_combustible.innerHTML = transDate(strDate);
            }
            strDate = maxDate(filtro_habitaculo_aux);
            if(strDate == "0000-00-00 00:00:00"){
                filtro_habitaculo.innerHTML = "Sin cambios";
            }
            else{
                filtro_habitaculo.innerHTML = transDate(strDate);
            }
        }
        else{
            fecha_cambio.innerHTML = "Sin cambios";
            aceite.innerHTML = "-";
            km_actual.innerHTML = "-";
            prox_cambio.innerHTML = "-";
            filtro_aceite.innerHTML = "Sin cambios";
            filtro_aire.innerHTML = "Sin cambios";
            filtro_combustible.innerHTML = "Sin cambios";
            filtro_habitaculo.innerHTML = "Sin cambios";
        }

    });
}

function abrirModalCambios(){
    aceiteCheck.checked = false;
    aceiteCheckFiltro.checked = false;
    aireCheck.checked = false;
    combustibleCheck.checked = false;
    habitaculoCheck.checked = false;
    
    aceite_ins.value="";
    km_actual_ins.value="";
    prox_cambio_ins.value="";
    checkAceite();

    mostrarModal("cambiosModal");
}

function checkAceite(){
    if(aceiteCheck.checked){
        for (var i = 0; i < cambiosAceiteDatos.length; i++) {
            var element = cambiosAceiteDatos[i];
            element.disabled = false;
        }
    }
    else{
        for (var i = 0; i < cambiosAceiteDatos.length; i++) {
            var element = cambiosAceiteDatos[i];
            element.disabled = true;
        }
    }

}

function maxDate(dates){
    var dateAux = "0000-00-00 00:00:00";
    for (var i = 0; i < dates.length; i++) {
        if(dates[i] > dateAux){
            dateAux = dates[i];
        }
    }
    return dateAux;
}

function abrirModalHistorial(){
    if($('#tablaHistorial').DataTable())
        $('#tablaHistorial').DataTable().destroy();
    var tablaHistorial = $('#tablaHistorial').DataTable({
        order: [[0, 'desc']],
    });
    tablaHistorial.rows().remove().draw();
    
    var cambiosObtenidos = obtenerCambios(autoCambio.value);
    // id	id_orden	id_cliente	fecha
    cambiosObtenidos.done(function(responseCambios) {
        if(responseCambios != "error"){
            var info_cambios = JSON.parse(responseCambios);
            for(var i = 0; i < info_cambios.length; i++){
                if(info_cambios[i].fecha_cambio != "0000-00-00 00:00:00"){
                    tablaHistorial.row.add([transDate(info_cambios[i].fecha_cambio), "Cambio de aceite "+info_cambios[i].aceite+" a "+info_cambios[i].km_actual]).draw(false);
                }
                if(info_cambios[i].filtro_aceite != "0000-00-00 00:00:00"){
                    tablaHistorial.row.add([transDate(info_cambios[i].filtro_aceite), "Cambio de filtro de aceite"]).draw(false);
                }
                if(info_cambios[i].filtro_aire != "0000-00-00 00:00:00"){
                    tablaHistorial.row.add([transDate(info_cambios[i].filtro_aire), "Cambio de filtro de aire"]).draw(false);
                }
                if(info_cambios[i].filtro_combustible != "0000-00-00 00:00:00"){
                    tablaHistorial.row.add([transDate(info_cambios[i].filtro_combustible), "Cambio de filtro de combustible"]).draw(false);
                }
                if(info_cambios[i].filtro_habitaculo != "0000-00-00 00:00:00"){
                    tablaHistorial.row.add([transDate(info_cambios[i].filtro_habitaculo), "Cambio de filtro de habitaculo"]).draw(false);
                }
            }
        }
        else{
        }

    });
    mostrarModal("historialModal");
}