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
var ordenAutoAnio = document.getElementById("ordenAutoAnio");
var ordenAutoModelo = document.getElementById("ordenAutoModelo");
var ordenCliente = document.getElementById("ordenCliente");
var pagoOrden = document.getElementById('pagoOrden');
var pago = 0;

var ordenClienteNombre = document.getElementById("ordenClienteNombre");
var ordenClienteTelefono = document.getElementById("ordenClienteTelefono");
var ordenClienteMail = document.getElementById("ordenClienteMail");
var ordenClienteDomicilio = document.getElementById("ordenClienteDomicilio");

var btn_orden_modal = document.getElementById("btn_orden_modal");
var id_orden = 0;

//VAR NOTA
var notaId = document.getElementById("notaId");
var notaTxt = document.getElementById("notaTxt");
var notaAdjuntos = document.getElementById("notaAdjuntos");
var adjuntos =  document.getElementById("adjuntos");
var adjuntos_error =  document.getElementById("adjuntos_error");

var adjuntos_view = document.getElementById("adjuntos_view");

//VAR HISTORIAL
const btn_cerrar_historial = document.getElementsByClassName("btn_cerrar_historial");

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
    $('[data-toggle="tooltip"]').tooltip();
    //MODAL ADJUNTOS VIEW
    $('.btnAdjuntos').click(function(e){
    });

    //MODAL FORM CREAR ORDEN
    $('#btnAgregarOrden').click(function(e){ 
        e.preventDefault();

        abrirModalOrden(0);
    });

    //CHANGE CARGAR AUTO ORDEN
    $('#ordenAuto').change(function(e){
        e.preventDefault();
        $(ordenAuto).removeClass('is-invalid').removeClass('is-valid');
        // ordenAuto.value
        var listaAutos = document.getElementById("dataListAutos");
        var autoInvalido = true;
        for(var i = 0; i < listaAutos.childElementCount; i++){
            if(listaAutos.children[i].value == ordenAuto.value){
                $(ordenAuto).addClass('is-valid');
                return;
            }
        }
        if(!ordenAuto.validity.valid || autoInvalido){
            $(ordenAuto).addClass('is-invalid');
        }

    });

    //CHANGE PROBLEMA ORDEN
    $('#ordenProblema').change(function(e){
        e.preventDefault();
        $(ordenProblema).removeClass('is-invalid');

        if(!ordenProblema.validity.valid){
            $(ordenProblema).addClass('is-invalid');
        }

    });

    //BTN MODAL ORDEN 
    $('#btn_orden_modal').click(function(e){
        var action = btn_orden_modal.getAttribute('accion');
        if(!ordenAuto.validity.valid){
            $(ordenAuto).addClass('is-invalid');
        }
        if(!ordenProblema.validity.valid){
            $(ordenProblema).addClass('is-invalid');
        }
        if((ordenAuto.classList.contains('is-invalid') && action == "crearOrden") || ordenProblema.classList.contains('is-invalid')){
            e.preventDefault();
            return;
        }
        else{
            e.preventDefault();
            var autoSeleccionado = ordenAuto.value.split(" - ");

            var autoBuscado = obtenerAutoPorPatente(autoSeleccionado[0]);
            autoBuscado.done(function(responseAuto){
                if(responseAuto != "error" || action == "editarOrden"){
                    var auto_id = 0;
                    if(action == "crearOrden"){
                        var info_auto = JSON.parse(responseAuto);
                        ordenCliente.value = info_auto[0].id_cliente;
                        auto_id = info_auto[0].id;
                    }
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        async: false,
                        // id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_comprobante	fecha_devolucion	estado
                        data: {
                            action:action,
                            id:ordenId.value,
                            estado:ordenEstado.value,
                            id_auto:auto_id,
                            problema:ordenProblema.value,
                            fecha_recibido:fecha_recibido.value,
                            fecha_devolucion:fecha_devolucion.value
                        },
                        success: function(response) {
                            if (response != "error") {
                                var autoCargado = JSON.parse(response);
                                if(autoCargado){
                                    if(window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                    if(action == "editarOrden"){
                                        mostrarModal("ordenModal");
                                    }
                                    else{
                                        ocultarModal("ordenModal");
                                        modalAbierto = null;
                                    }
                                    mostrarModal("successModal");
                                }
                            }
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                }
            });
        }
                
    });
    //MODAL FACTURACION
    $('#btnFacturacion').click(function(e){
        e.preventDefault();
        abrirModalFacturacion();
    });
    //MODAL TRABAJO
    $('#btnTrabajo').click(function(e){
        e.preventDefault();

        abrirModalTrabajo();
    });
    //MODAL HISTORIAL AGREGAR
    $('#btn_historial_nota').click(function(e){
        e.preventDefault();
        
        abrirModalHistorial("NOTAS");
    });
    //ADJUNTOS NOTA
    $('#notaAdjuntos').change(function(e){
        mostrarAdjuntos();
    });
    //ADJUNTOS NOTA
    $('#notaTxt').change(function(e){
        console.log(notaTxt.value.length);
        if(notaTxt.value.length > 600){
            notaTxt.setAttribute("error", "error");
            $(notaTxt).addClass('is-invalid');
        }
        else{
            notaTxt.setAttribute("error", "no-error");
            $(notaTxt).removeClass('is-invalid');
        }
    });
    //BTN CARGAR NOTA
    $('#btn_nota_modal').click(function(e){
        e.preventDefault();
        
        // cargarNota();
        while (adjuntos_error.firstChild) {
            adjuntos_error.removeChild(adjuntos_error.firstChild);
        }
        console.log(notaAdjuntos.files);
        if(adjuntos.getAttribute("error") != "error" && notaTxt.getAttribute("error") != "error") {
            subirNota(notaAdjuntos.files,"notas", notaId.value);
        }
        else {
            var alert = '<div class="alert alert-danger text-center" role="alert">';
            alert += '<i class="fa-solid fa-circle-exclamation"></i> No se puede agregar mientras haya errores <i class="fa-solid fa-circle-exclamation"></i>';
            alert += '</div>';
            adjuntos_error.innerHTML += alert;
        }
        
    });
    //MODAL NOTAS AGREGAR
    $('#btn_agregar_nota').click(function(e){
        e.preventDefault();
        
        // abrirModalCambios();
        abrirModalNota();
    });
    //MODAL HISTORIAL AGREGAR
    $('#btn_historial_cambios').click(function(e){
        e.preventDefault();
        
        abrirModalHistorial("CAMBIOS");
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
                        ocultarModal("autoModal");
                        ocultarModal("cambiosModal");
                        // if(window.history.replaceState) {
                        //     window.history.replaceState(null, null, window.location.href);
                        // }
                        mostrarModal("successModal");
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
    modalAbierto = "ORDEN";
    $(ordenAuto).removeClass('is-invalid').removeClass('is-valid');
    $(ordenProblema).removeClass('is-invalid').removeClass('is-valid');
    $('#flush-auto').collapse('hide');
    $('#panel-cambios').collapse('hide');
    $('#flush-cliente').collapse('hide');

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
        
        ordenId.value = id;
        
        id_orden = id;

        for (var i = 0; i < dataOrden.length; i++) {
            var element = dataOrden[i];
            element.style.display = "initial";
        }
        var orden = seleccionarOrdenCompleta(id);
        orden.done(function(responseOrden) {
            var info_orden = JSON.parse(responseOrden)[0];
            mostrarCambiosAuto(info_orden.id_auto);
            ordenAutoPatente.value = info_orden.patente;
            ordenAutoAnio.value = info_orden.anio;
            ordenAutoModelo.value = info_orden.modelo;
            // ordenCliente.value = info_orden.id_cliente;
            ordenClienteNombre.value = info_orden.nombre;
            ordenClienteTelefono.value = info_orden.telefono;
            ordenClienteMail.value = info_orden.mail;
            ordenClienteDomicilio.value = info_orden.domicilio;

            ordenModalTitle.innerHTML = "Orden Nro°" + id + " - Auto: " + ordenAutoPatente.value + " " + ordenAutoModelo.value + " - Cliente: " + ordenClienteNombre.value;
            fecha_recibido.value = info_orden.fecha_recibido_input;
            ordenProblema.value = info_orden.problema;
            pago = info_orden.pago;
            pagoOrden.value = pago;
            var cargoOrden = document.getElementById('cargoOrden');
            cargoOrden.value = info_orden.cobro;

            estadosSelect(info_orden.estado, ordenEstado);
            
            var btnTrabajo = document.getElementById("btnTrabajo");
            var btnFacturacion = document.getElementById("btnFacturacion");
            var showEntrega = document.getElementById("showEntrega");
            showEntrega.style.display = "none";
            if(ordenEstado.value == 4){
                showEntrega.style.display = "";
                fecha_devolucion.value = info_orden.fecha_devolucion_input;
            }
            if(ordenEstado.value == 2){
                btnTrabajo.disabled = true;
                btnFacturacion.disabled = true;
            }
            else{
                btnTrabajo.disabled = false;
                btnFacturacion.disabled = false;
            }
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

function seleccionarOrdenCompleta(id_buscado) {
    var action = 'seleccionarOrdenCompleta';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_orden:id_buscado}
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

function abrirModalNota(){
    while (adjuntos_error.firstChild) {
        adjuntos_error.removeChild(adjuntos_error.firstChild);
    }
    while (adjuntos.firstChild) {
        adjuntos.removeChild(adjuntos.firstChild);
    }
    $(notaTxt).removeClass('is-invalid');
    notaAdjuntos.value = "";
    
    notaId.value=0;
    notaTxt.value="";
    notaAdjuntos;

    ocultarModal("trabajoModal");
    mostrarModal("notaModal");
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

function checkFiltro(filtro){
    var input = document.getElementById(filtro.id + "Fecha");
    console.log(filtro);
    console.log(input);
    if(filtro.checked){
        input.style.display = "";
        const hoy = new Date().toISOString().split('T')[0];
        var date = document.getElementById(filtro.id + "Date");
        date.value = hoy;

    }
    else{
        input.style.display = "none";
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

function abrirModalHistorial(tipo){
    var volver = "";
    switch(modalAbierto){
        case "ORDEN":
            ocultarModal("ordenModal");
            ocultarModal("trabajoModal");
            volver = 'ORDEN';
        break;
        case "AUTO":
            ocultarModal("autoModal");
            volver = 'AUTO';
        break;
    }
    if($('#tablaHistorial').DataTable())
        $('#tablaHistorial').DataTable().destroy();
    if(tipo == "CAMBIOS"){
        var autoObtenido = obtenerAutoCompleto(autoCambio.value);
        autoObtenido.done(function(responseAuto) {
            if(responseAuto != "error"){
                var info_auto = JSON.parse(responseAuto)[0];
                historialModalTitle.innerHTML = "Historial de cambios del auto " + info_auto.patente + " " + info_auto.modelo;
            }
        });
        for (var i = 0; i < btn_cerrar_historial.length; i++) {
            var element = btn_cerrar_historial[i];
            element.setAttribute("onclick","DisplayVolver('"+volver+"')");
        }
        var tablaHistorial = $('#tablaHistorial').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ cambios",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún cambio cargado",
                "sInfo":           "Mostrando cambios del _START_ al _END_ de un total de _TOTAL_ cambios",
                "sInfoEmpty":      "Mostrando cambios del 0 al 0 de un total de 0 cambios",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ cambios)",
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
                }
            },
            columns: [
                {title: 'Fecha', targets: 0, ordering: true, width: "25%"},
                {title: 'Descripcion', targets: 1, ordering: true, width: "75%"},
                {targets: 2, visible:false, data: null}
            ],
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
                        var fechaInput = '<span style="display: none;">'+info_cambios[i].fecha_cambio+'</span>'+transDate(info_cambios[i].fecha_cambio);
                        tablaHistorial.row.add([fechaInput, "Cambio de aceite "+info_cambios[i].aceite+" a "+info_cambios[i].km_actual]).draw(false);
                    }
                    if(info_cambios[i].filtro_aceite != "0000-00-00 00:00:00"){
                        var fechaInput = '<span style="display: none;">'+info_cambios[i].filtro_aceite+'</span>'+transDate(info_cambios[i].filtro_aceite);
                        tablaHistorial.row.add([fechaInput, "Cambio de filtro de aceite"]).draw(false);
                    }
                    if(info_cambios[i].filtro_aire != "0000-00-00 00:00:00"){
                        var fechaInput = '<span style="display: none;">'+info_cambios[i].filtro_aire+'</span>'+transDate(info_cambios[i].filtro_aire);
                        tablaHistorial.row.add([fechaInput, "Cambio de filtro de aire"]).draw(false);
                    }
                    if(info_cambios[i].filtro_combustible != "0000-00-00 00:00:00"){
                        var fechaInput = '<span style="display: none;">'+info_cambios[i].filtro_combustible+'</span>'+transDate(info_cambios[i].filtro_combustible);
                        tablaHistorial.row.add([fechaInput, "Cambio de filtro de combustible"]).draw(false);
                    }
                    if(info_cambios[i].filtro_habitaculo != "0000-00-00 00:00:00"){
                        var fechaInput = '<span style="display: none;">'+info_cambios[i].filtro_habitaculo+'</span>'+transDate(info_cambios[i].filtro_habitaculo);
                        tablaHistorial.row.add([fechaInput, "Cambio de filtro de habitaculo"]).draw(false);
                    }
                }
            }
        });
    }
    else if(tipo == "NOTAS"){
        historialModalTitle.innerHTML = "Historial de las notas de la orden " + id_orden;
        for (var i = 0; i < btn_cerrar_historial.length; i++) {
            var element = btn_cerrar_historial[i];
            element.setAttribute("onclick","DisplayVolver('TRABAJO')");
        }
        var tablaHistorial = $('#tablaHistorial').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ notas",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningúna nota cargada",
                "sInfo":           "Mostrando notas del _START_ al _END_ de un total de _TOTAL_ notas",
                "sInfoEmpty":      "Mostrando notas del 0 al 0 de un total de 0 notas",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ notas)",
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
                }
            },
            columns: [
                {title: 'Fecha', targets: 0, width: "25%", ordering: true},
                {title: 'Nota', targets: 1, ordering: true},
                {title: 'Adjuntos', targets: 2, ordering: true, width: "15%"}
            ],
            order: [[0, 'desc']],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        tablaHistorial.rows().remove().draw();
        
        var notasObtenidas = obtenerNotas();
        // id	id_orden	id_cliente	fecha
        notasObtenidas.done(function(responseCambios) {
            if(responseCambios != "error"){
                var info_notas = JSON.parse(responseCambios);
                for(var i = 0; i < info_notas.length; i++){
                    var fechaCompleta = info_notas[i].fecha + " " + info_notas[i].hora;
                    var fechaOrdenable = info_notas[i].fecha.split("/");
                    var fechaInput = '<span style="display: none;">'+fechaOrdenable[2]+fechaOrdenable[1]+fechaOrdenable[0]+" "+info_notas[i].hora+'</span>'+fechaCompleta;
                    var tr = tablaHistorial.row.add([fechaInput, info_notas[i].nota, setBotonAdjuntos(info_notas[i].id, info_notas[i].adjuntos)]).draw().node();
                }
            }
        });
    }
    setFormatTabla("tablaHistorial", 0);
    mostrarModal("historialModal");
}

function obtenerNotas(){
    var action = 'obtenerNotas';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_orden:id_orden}
    });

}

function subirNota(archivos, tipo, id){
    var formData = new FormData();
			
    // Read selected files
    for (var i = 0; i < archivos.length; i++) {
        formData.append("files[]", archivos[i]);
    }
    formData.append("dir_base", tipo);
    formData.append("nota", notaTxt.value);
    formData.append("id", id);
    formData.append("id_orden", id_orden);
    formData.append("action", "cargarAdjuntosNota");

    var xhttp = new XMLHttpRequest();

    // Set POST method and ajax file path
    xhttp.open("POST", "files.php", true);

    // call on request changes state
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var response = this.responseText;
            ocultarModal("notaModal");
            if(response){
                if(response.includes("correctamente")){
                    var successRespuesta = document.getElementById("successRespuesta");
                    successRespuesta.innerHTML = response;
                    mostrarModal("successModal");
                }
                else{
                    var errorRespuesta = document.getElementById("successRespuesta");
                    errorRespuesta.innerHTML = response;
                    mostrarModal("errorModal");
                }
                // alert(response);
            }
        }
    };
    
    // Send request with data
    xhttp.send(formData);
}

function mostrarAdjuntos() {
    var archivos = [];
    for(var i = 0; i < notaAdjuntos.files.length; i++){
        var aux = [];
        aux["url"] = URL.createObjectURL(notaAdjuntos.files[i]);
        aux["name"] = notaAdjuntos.files[i].name;
        aux["size"] = notaAdjuntos.files[i].size;
        archivos[i] = aux;
    }
    crearVisualizadorAdjuntos(adjuntos, archivos, false);
}

function setBotonAdjuntos(id, cantidad_adjuntos){
    var boton = '<button id="'+id+'" onclick="displayAdjuntos(\''+id+'\');" ';
    if(cantidad_adjuntos != 0){
        boton += 'class="btn btn-sm btn-outline-dark text-bg-success">';
    }
    else{
        boton += 'class="btn btn-sm btn-outline-dark text-bg-warning">';
    }
    boton += cantidad_adjuntos+" adjuntos";
    boton += "</button>";

    return boton;
}

function abrirModalAdjuntos(id) {
    var action = "bajarAdjuntosNota";
    var src = 'uploads/notas/'+id;

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, src:src},
        success: function(response) {
            if (response != "error") {
                var adjuntos = JSON.parse(response);
                var archivos = [];
                var nombres_archivos = Object.values(adjuntos);

                for(var i  = 0; i < nombres_archivos.length; i++) {
                    var aux = [];
                    aux["url"] = src+'/'+nombres_archivos[i];
                    aux["name"] = nombres_archivos[i];
                    archivos[i] = aux;
                }

                crearVisualizadorAdjuntos(adjuntos_view, archivos, true);
                mostrarModal("adjuntosModal");
            }
        },
        error: function(error) {
            alert(error);
        }
    });
}

function displayAdjuntos(id){
    abrirModalAdjuntos(id);
}

function abrirModalTrabajo() {
    ocultarModal("ordenModal");

    // modalAbierto = "TRABAJO";

    mostrarModal("trabajoModal");
}

function traerCobroRecibo(id){
    var cobro = 0;

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        // id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_comprobante	fecha_devolucion	estado
        data: {
            action:"obtenerCobroRecibo",
            id:id
        },
        success: function(response) {
            if (response != "error") {
                cobro = JSON.parse(response)[0].cobro;
            }
        },
        error: function(error) {
            alert(error);
        }
    });
    return cobro;
    
    // var reciboObtenido = obtenerRecibo(id);
    // // id	id_orden	id_cliente	fecha
    // reciboObtenido.done(function(responseRecibo) {
    //     if(responseRecibo != "error"){
    //         var info_recibo = JSON.parse(responseRecibo)[0];
            
    //         var insumosRecibo = obtenerInsumos(info_recibo.id, "recibos");
    //         insumosRecibo.done(function(responseInsumosRecibo) {
    //             if(responseInsumosRecibo != "error"){
    //                 var info_insumos = JSON.parse(responseInsumosRecibo);
    //                 for (var i = 0; i < info_insumos.length; i++) {
    //                     precioRecibo += info_insumos[i].precio_total
    //                 }
    //             }
    //         });
    //     }
    // });
    // return precioRecibo;
}

function abrirModalFacturacion(){
    $('#ordenModal').modal('hide');
    modalAbierto = "FACTURACION";
    
    var cargoOrden = document.getElementById('cargoOrden');

    cargoOrden.value = actualizarCobro(id_orden);
    pagoOrden.value = pago;
    // console.log(cargoOrden.value + " " + pagoOrden.value);
    
    mostrarModal("facturacionModal");
}