
// VAR MODAL OREDEN
var ordenModalTitle = document.getElementById("ordenModalTitle");
var ordenId = document.getElementById("ordenId");
var fecha_recibido = document.getElementById("fecha_recibido");
var id_recibo = document.getElementById("id_recibo");
var ordenProblema = document.getElementById("ordenProblema");
var ordenEstado = document.getElementById("ordenEstado");
var ordenAutoPatente = document.getElementById("ordenAutoPatente");
var ordenAutoMarca = document.getElementById("ordenAutoMarca");
var ordenAutoModelo = document.getElementById("ordenAutoModelo");
var ordenNotas = document.getElementById("ordenNotas");
var ordenAutoCliente = document.getElementById("ordenAutoCliente");
var btn_orden_modal = document.getElementById("btn_orden_modal");

$( document ).ready(function() {

    //MODAL FORM CREAR ORDEN
    $('#btnAgregarOrden').click(function(e){ 
        e.preventDefault();

        abrirModalOrden(0);
    });

    //BTN MODAL ORDEN 
    $('#btn_orden_modal').click(function(e){
        
        // var ordenModalTitle = document.getElementById("ordenModalTitle");
        // var ordenId = document.getElementById("ordenId");
        // var fecha_recibido = document.getElementById("fecha_recibido");
        // var id_recibo = document.getElementById("id_recibo");
        // var ordenProblema = document.getElementById("ordenProblema");
        // var ordenAutoPatente = document.getElementById("ordenAutoPatente");
        // var ordenAutoMarca = document.getElementById("ordenAutoMarca");
        // var ordenAutoModelo = document.getElementById("ordenAutoModelo");
        // var ordenNotas = document.getElementById("ordenNotas");
        // var ordenAutoCliente = document.getElementById("ordenAutoCliente");
        // var btn_orden_modal = document.getElementById("btn_orden_modal");
 
        // if(ordenInvalida()){
        //     error(error.message);
        // }
        // else{
            e.preventDefault(); 
            var action = btn_orden_modal.getAttribute('accion');

            var autoBuscado = obtenerAutoPorPatente(ordenAutoPatente.value);
            autoBuscado.done(function(responseAuto){
                if(responseAuto != "error"){
                    var info_auto = JSON.parse(responseAuto);
                    console.log(info_auto);
                    ordenAutoCliente.value = info_auto[0].id_cliente;
                    var id_presupuesto =  0;
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        async: true,
                        // id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado
                        data: {
                            action:action,
                            id:ordenId.value,
                            estado:ordenEstado.value,
                            id_auto:info_auto[0].id,
                            problema:ordenProblema.value,
                            notas:ordenNotas.value,
                            id_recibo:id_recibo.value,
                            id_presupuesto:id_presupuesto,

                            // TODO AGREGAR TODO

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
                                }
                            }
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                }
            });
            // });
        // }
                
    });
    //MODAL LLEGADA
    $('#btnLlegada').click(function(e){
        e.preventDefault();
        modalAbierto = "LLEGADA";

        $('#ordenModal').modal('hide');
        
        mostrarModal("llegadaModal");
    });
    //MODAL TRABAJO
    $('#btnTrabajo').click(function(e){
        e.preventDefault();
        modalAbierto = "TRABAJO";

        $('#ordenModal').modal('hide');
        
        mostrarModal("trabajoModal");
    });
    //MODAL ENTREGA
    $('#btnEntrega').click(function(e){
        e.preventDefault();
        modalAbierto = "ENTREGA";

        $('#ordenModal').modal('hide');
        
        mostrarModal("entregaModal");
    });
    //MODAL PRESUPUESTO
    $('#btnPresupuesto').click(function(e){
        console.log("presupuestoModalLabel");
        e.preventDefault();
        $('#llegadaModal').modal('hide');
        
        mostrarModal("presupuestoModal");
    });

});


function abrirModalOrden(id) {
    
    // var ordenModalTitle = document.getElementById("ordenModalTitle");
    // var ordenId = document.getElementById("ordenId");
    // var fecha_recibido = document.getElementById("fecha_recibido");
    // var id_recibo = document.getElementById("id_recibo");
    // var ordenProblema = document.getElementById("ordenProblema");
    // var ordenAutoPatente = document.getElementById("ordenAutoPatente");
    // var ordenAutoMarca = document.getElementById("ordenAutoMarca");
    // var ordenAutoModelo = document.getElementById("ordenAutoModelo");
    // var ordenNotas = document.getElementById("ordenNotas");
    // var ordenAutoCliente = document.getElementById("ordenAutoCliente");
    // var btn_orden_modal = document.getElementById("btn_orden_modal");

    $(ordenAutoPatente).removeClass('is-invalid').removeClass('is-valid');
    $(ordenAutoCliente).removeClass('is-invalid').removeClass('is-valid');

    if (id == 0){
        for (var i = 0; i < dataOrden.length; i++) {
            var element = dataOrden[i];
            element.style.display = "none";
        }
        ordenModalTitle.innerHTML = "Crear orden";
        ordenId.value = 0;
        ordenProblema.value = "";
        ordenAutoPatente.value = "";
        ordenAutoPatente.disabled = false;
        ordenAutoPatente.readonly = false;
        ordenNotas.value = "";
        btn_orden_modal.setAttribute("accion", "crearOrden");
        btn_orden_modal.value = "Crear orden";
    }
    else{ //TODO TERMINAR OBTENER DATOS
        ordenModalTitle.innerHTML = "Orden";
        ordenId.value = id;
        // id_recibo = obtenerRecibo();
        // ordenProblema = obtenerProblema();
        // ordenNotas = obtenerNotas();
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
                ordenAutoPatente.value = info_auto[0].patente;
                ordenAutoPatente.disabled = true;
                ordenAutoPatente.readonly = true;
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
            ordenEstado.value = info_orden[0].id_estado;
            estadosSelect(ordenEstado.value, ordenEstado);
            fecha_recibido.value = info_orden[0].fecha_recibido;
            id_recibo.value = info_orden[0].id_recibo;
            ordenProblema.value = info_orden[0].problema;
            ordenNotas.value = info_orden[0].notas;
        });
        
        btn_orden_modal.setAttribute("accion", "editarOrden");
        btn_orden_modal.value = "Guardar";

    }
    mostrarModal("ordenModal");
}

function obtenerOrden(id_orden) {
    var action = 'seleccionarOrden';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, id_orden:id_orden}
    });
}
