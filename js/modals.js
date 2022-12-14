
var clientes = obtenerClientes();
var marcas = obtenerMarcas();
var modelos = obtenerModelos();

// VAR MODAL MARCA
var marcaModalTitle = document.getElementById("marcaModalTitle");
var marcaId = document.getElementById("marcaId");
var marcaValor = document.getElementById("marca");
var btn_marca_modal = document.getElementById("btn_marca_modal");

// VAR MODAL MODELO
var modeloModalTitle = document.getElementById("modeloModalTitle");
var modeloId = document.getElementById("modeloId");
var marcaModelo = document.getElementById("marcaModelo");
var modeloValor = document.getElementById("modelo");
var btn_modelo_modal = document.getElementById("btn_modelo_modal");

// VAR MODAL CLIENTE
var clienteModalTitle = document.getElementById("clienteModalTitle");
var clienteId = document.getElementById("clienteId");
var clienteNombre = document.getElementById("clienteNombre");
var clienteTelefono = document.getElementById("clienteTelefono");
var clienteMail = document.getElementById("clienteMail");
var clienteDomicilio = document.getElementById("clienteDomicilio");
var btn_cliente_modal = document.getElementById("btn_cliente_modal");

// VAR MODAL AUTO
var autoModalTitle = document.getElementById("autoModalTitle");
var autoId = document.getElementById("autoId");
var autoIdModelo = document.getElementById("autoIdModelo");
var autoIdCliente = document.getElementById("autoIdCliente");
var autoPatente = document.getElementById("autoPatente");
var autoMarca = document.getElementById("autoMarca");
var autoModelo = document.getElementById("autoModelo");
var autoYear = document.getElementById("autoYear");
var autoCliente = document.getElementById("autoCliente");
var btn_auto_modal = document.getElementById("btn_auto_modal");

var enter = false;


$( document ).ready(function() {
    //MODAL FORM AGREGAR MARCA
    $('#btnAgregarMarca').click(function(e){ 
        e.preventDefault();
        if(modalAbierto){
            $('#autoModal').modal('hide');
        }

        abrirModalMarca(0);
    });
    
    //MODAL FORM AGREGAR MODELO
    $('#btnAgregarModelo').click(function(e){ 
        e.preventDefault();
        if(modalAbierto){
            $('#autoModal').modal('hide');
        }

        abrirModalModelo(0);
    });
    
    //MODAL FORM AGREGAR CLIENTE
    $('#btnAgregarCliente').click(function(e){ 
        e.preventDefault();
        var parent = this.parentNode;
        while(!parent.classList.contains("modal") && parent.tagName !=  "MAIN"){
            parent = parent.parentNode;
            if(parent.classList.contains("modal")){
                $(parent).modal('hide');
                // console.log(parent);
                modalAuto = true;
            }
        }

        abrirModalCliente(0);
    });

    //MODAL FORM AGREGAR AUTO
    $('#btnAgregarAuto').click(function(e){ 
        e.preventDefault();

        abrirModalAuto(0);
    });

    //MODAL FORM ELIMINAR MARCA
    $('.deleteMarca').click(function(e){ 
        e.preventDefault();
        var id_marca = $(this).attr('id-marca');
        var action = 'borrarMarca';
        console.log(id_marca);

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            data: {action:action, id:id_marca, marca:marcaValor.value},
            success: function(response) {
                console.log(response);
                if (response != "error") {
                    var marca = JSON.parse(response);
                    if(marca){
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }

                        mostrarModal("deleteModal");
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //MODAL FORM ELIMINAR MODELO
    $('.deleteModelo').click(function(e){ 
        e.preventDefault();
        var id_modelo = $(this).attr('id-modelo');
        var action = 'borrarModelo';

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            data: {action:action, id:id_modelo},
            success: function(response) {
                if (response != "error") {
                    var marca = JSON.parse(response);
                    if(marca){
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }

                        mostrarModal("deleteModal");
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //ELIMINAR CLIENTE
    $('.deleteCliente').click(function(e){ 
        e.preventDefault();
        var id_cliente = $(this).attr('id-cliente');
        var action = 'borrarCliente';

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: false,
            data: {action:action, id:id_cliente},
            success: function(response) {
                if (response != "error") {
                    var cliente = JSON.parse(response);
                    if(cliente){
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }

                        mostrarModal("deleteModal");
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //BTN MODAL MARCA 
    $('#btn_marca_modal').click(function(e){ 
        // e.preventDefault();
        if(!marcaValor.validity.valid){
            $(marcaValor).addClass('is-invalid');
        }
        else {
            var action = btn_marca_modal.getAttribute('accion');
            e.preventDefault(); 
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: false,
                data: {action:action, id:marcaId.value, marca:marcaValor.value},
                success: function(response) {
                    if (response != "error") {
                        var marca = JSON.parse(response);
                        if(marca){

                            if(window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }

                            ocultarModal("marcaModal");
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
    
    //BTN MODAL MODELO 
    $('#btn_modelo_modal').click(function(e){

        if(marcaModelo.classList.contains('is-invalid')){
            // alert("Ingrese un modelo valido");  TODO
        }
        else if(!marcaModelo.validity.valid){
            $(marcaModelo).addClass('is-invalid');
        }
        else if(!modeloValor.validity.valid){
            $(modeloValor).addClass('is-invalid');
        }
        else{
            var action = btn_modelo_modal.getAttribute('accion'); 
            e.preventDefault(); 
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: false,
                data: {action:action, id:modeloId.value, modelo:modeloValor.value, marcaModelo:marcaModelo.value},
                success: function(response) {
                    console.log(response);
                    if (response != "error") {
                        var modeloCargado = JSON.parse(response);
                        if(modeloCargado){
                            if(window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }

                            ocultarModal("modeloModal");
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

    //BTN MODAL CLIENTE 
    $('#btn_cliente_modal').click(function(e){ 

        if(clienteTelefono.classList.contains('is-invalid')){
            // alert("Ingrese un telefono valido");  TODO
            e.preventDefault();
        }
        else if(clienteMail.classList.contains('is-invalid')){
            // alert("Ingrese un mail valido");  TODO
            e.preventDefault();
        }
        else if(!clienteNombre.validity.valid){
            $(clienteNombre).addClass('is-invalid');
        }
        else if(!clienteTelefono.validity.valid){
            $(clienteTelefono).addClass('is-invalid');
        }
        else{
            e.preventDefault();
            var action = btn_cliente_modal.getAttribute('accion');
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: false,
                data: {action:action, id:clienteId.value, nombre:clienteNombre.value, telefono:clienteTelefono.value, mail:clienteMail.value, domicilio:clienteDomicilio.value},
                success: function(response) {
                    console.log(response);
                    if (response != "error") {
                        if(window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        ocultarModal("clienteModal");
                        if(response == "Duplicado"){
                            errorRespuesta.innerHTML = "El cliente " + clienteNombre.value + " ya se encuentra registrado.";
                            mostrarModal("errorModal");
                        }
                        else {
                            var clienteCargado = JSON.parse(response);
                            if(clienteCargado){
                                mostrarModal("successModal");
                            }
                        }
                    }
                },
                error: function(error) {
                    alert(error);
                }
            });
        }
    });

    //BTN MODAL AUTO 
    $('#btn_auto_modal').click(function(e){
 
        if(autoPatente.classList.contains('is-invalid')){
            // alert("Ingrese una patente valida");  TODO
            e.preventDefault();
        }
        else if(autoMarca.classList.contains('is-invalid')){
            // alert("Ingrese una marca valida");  TODO
            e.preventDefault();
        }
        else if(autoModelo.classList.contains('is-invalid')){
            // alert("Ingrese un modelo valido");  TODO
            e.preventDefault();
        }
        else if(autoCliente.classList.contains('is-invalid')){
            // alert("Ingrese un cliente valido");  TODO
            e.preventDefault();
        }
        else if(!autoPatente.validity.valid){
            // $(autoPatente).addClass('is-invalid');
        }
        else if(!autoMarca.validity.valid){
            $(autoMarca).addClass('is-invalid');
        }
        else if(!autoModelo.validity.valid){
            $(autoModelo).addClass('is-invalid');
        }
        else if(!autoCliente.validity.valid){
            $(autoCliente).addClass('is-invalid');
        }
        else{
            e.preventDefault(); 
            var action = btn_auto_modal.getAttribute('accion');
            console.log(action);
            autoIdModelo.value = 0;
            autoIdCliente.value = 0;
            
            var modeloBuscado = obtenerModeloPorNombre(autoModelo.value);
            modeloBuscado.done(function(responseModelo){
                if(responseModelo != "error"){
                    var info_modelo = JSON.parse(responseModelo);
                    autoIdModelo.value = info_modelo[0].id;
                    clientes.done(function(responseCliente){
                        if(responseCliente != "error"){
                            var info_cliente = JSON.parse(responseCliente);
                            for(var i = 0; i < info_cliente.length; i++){
                                if(info_cliente[i].nombre == autoCliente.value){
                                    autoIdCliente.value = info_cliente[i].id;
                                }
                            
                            }
                            $.ajax({
                                type: "POST",
                                url: "ajax.php",
                                async: false,
                                // patente	id_modelo	anio	id_cliente
                                data: {action:action, id:autoId.value, id_modelo:autoIdModelo.value, patente:autoPatente.value, anio:autoYear.value, id_cliente:autoIdCliente.value},
                                success: function(response) {
                                    console.log(response);
                                    if (response != "error") {
                                        var autoCargado = JSON.parse(response);
                                        if(autoCargado){
                                            if(window.history.replaceState) {
                                                window.history.replaceState(null, null, window.location.href);
                                            }
                                            modalAbierto = false;
                                            ocultarModal("autoModal");
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
        }
                
    });
    
    $(".modal").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            if (enter) {
                // alert("Doble enter hhmmmm!!");
                event.preventDefault();
                enter = false;
            }
            else{
                enter = true;
                setTimeout(() => {
                    enter = false;
                 }, 500);
            }
        }
    });

    $('.modal').keyup(function(e){
        if(e.key == "Escape"){
            e.preventDefault();
            // console.log(e.key);
            // console.log(e.target.children[0].children[0].children[0].children[1]);
            e.target.children[0].children[0].children[0].children[1].click();
            // DisplayVolver("HOME");
        }
    });
    
});

function agregarOptionMarca(marca) {
    var option = document.createElement("option");
    option.id = marca["id"];
    option.value = marca["marca"];

    return option;

}
function agregarOptionModelo(modelo) {
    var option = document.createElement("option");
    option.id = modelo["id"];
    option.value = modelo["modelo"];

    return option;

}

function agregarOptionCliente(cliente) {
    var option = document.createElement("option");
    option.id = cliente["id"];
    option.value = cliente["nombre"];

    return option;
}

function abrirModalMarca(id) {

    if (id == 0){
        marcaModalTitle.innerHTML = "Agregar marca";
        marcaId.value = 0;
        marcaValor.value = "";
        btn_marca_modal.setAttribute("accion", "agregarMarca");
        btn_marca_modal.value = "Agregar marca";
    }
    else{
        marcaModalTitle.innerHTML = "Editar marca";
        marcaId.value = id;
        var marcaEditar = obtenerMarca(id);
        marcaEditar.done(function(responseCliente){
            var info_marca = JSON.parse(responseCliente);
            marcaValor.value = info_marca[0].marca;
        });
        
        btn_marca_modal.setAttribute("accion", "editarMarca");
        btn_marca_modal.value = "Editar marca";

    }
    mostrarModal("marcaModal");
}

function abrirModalModelo(id) {
    $(marcaModelo).removeClass('is-invalid').removeClass('is-valid');

    if (id == 0){
        modeloModalTitle.innerHTML = "Agregar modelo";
        modeloId.value = 0;
        if(modalAbierto){
            marcaModelo.value = autoMarca.value;
        }
        else{
            marcaModelo.value = "";
        }
        modeloValor.value = "";
        btn_modelo_modal.setAttribute("accion", "agregarModelo");
        btn_modelo_modal.value = "Agregar modelo";
    }
    else{
        modeloModalTitle.innerHTML = "Editar modelo";
        modeloId.value = id;
        var modeloEditar = obtenerModelo(id);
        modeloEditar.done(function(responseCliente){
            var info_modelo = JSON.parse(responseCliente);
            modeloValor.value = info_modelo[0].modelo;
            var marcaModeloValor = obtenerMarca(info_modelo[0].id_marca);
            marcaModeloValor.done(function(responseCliente){
                var info_marca_modelo = JSON.parse(responseCliente);
                marcaModelo.value = info_marca_modelo[0].marca;
            });
            
        });
        
        btn_modelo_modal.setAttribute("accion", "editarModelo");
        btn_modelo_modal.value = "Editar modelo";

    }
    mostrarModal("modeloModal");
}

function abrirModalCliente(id) {
    $(clienteTelefono).removeClass('is-invalid').removeClass('is-valid');
    $(clienteMail).removeClass('is-invalid').removeClass('is-valid');

    if (id == 0){
        clienteModalTitle.innerHTML = "Agregar cliente";
        clienteId.value = 0;
        clienteNombre.value = "";
        clienteTelefono.value = "";
        clienteMail.value = "";
        clienteDomicilio.value = "";
        btn_cliente_modal.setAttribute("accion", "agregarCliente");
        btn_cliente_modal.value = "Agregar cliente";
    }
    else{
        clienteModalTitle.innerHTML = "Editar cliente";
        clienteId.value = id;
        var clienteEditar = obtenerCliente(id);
        clienteEditar.done(function(responseCliente){
            var info_cliente = JSON.parse(responseCliente);
            clienteNombre.value = info_cliente[0].nombre;
            clienteTelefono.value = info_cliente[0].telefono;
            clienteMail.value = info_cliente[0].mail;
            clienteDomicilio.value = info_cliente[0].domicilio;
            
        });
        
        btn_cliente_modal.setAttribute("accion", "editarCliente");
        btn_cliente_modal.value = "Editar cliente";

    }
    mostrarModal("clienteModal");
}

function abrirModalAuto(id) {
    actualizarMarcasModelos();
    modalAbierto = "AUTO";
    $(autoPatente).removeClass('is-invalid').removeClass('is-valid');
    $(autoMarca).removeClass('is-invalid').removeClass('is-valid');
    $(autoModelo).removeClass('is-invalid').removeClass('is-valid');
    $(autoCliente).removeClass('is-invalid').removeClass('is-valid');

    var cambiosDisplay = document.getElementById("cambiosDisplay");
    if (id == 0){
        cambiosDisplay.style.display = "none";
        autoModalTitle.innerHTML = "Agregar auto";
        autoId.value = 0;
        autoPatente.value = "";
        autoMarca.value = "";
        autoModelo.value = "";
        autoYear.value = "";
        autoCliente.value = "";
        btn_auto_modal.setAttribute("accion", "agregarAuto");
        btn_auto_modal.value = "Agregar auto";
        if(marcaModelo.value){
            autoMarca.value = marcaModelo.value;
            verificarMarca($(autoMarca));
        }
        else if(marca.value){
            autoMarca.value = marca.value;
            verificarMarca($(autoMarca));
        }
        if(modelo.value){
            autoModelo.value = modelo.value;
            verificarModelo();
        }
        if(clienteNombre.value){
            autoCliente.value = clienteNombre.value;
            verificarCliente();
        }
    }
    else{
        $('#panel-cambios').collapse('hide');
        cambiosDisplay.style.display = "initial";
        autoId.value = id;
        mostrarCambiosAuto(id);
        var autoEditar = obtenerAuto(id);
        autoEditar.done(function(responseAuto){
            var info_auto = JSON.parse(responseAuto);
            autoPatente.value = info_auto[0].patente;
            var modeloAuto = obtenerModelo(info_auto[0].id_modelo);
            modeloAuto.done(function(responseModelo){
                var info_modelo = JSON.parse(responseModelo);
                autoModelo.value = info_modelo[0].modelo;
                var marcaAuto = obtenerMarca(info_modelo[0].id_marca);
                marcaAuto.done(function(responseMarca){
                    var info_marca = JSON.parse(responseMarca);
                    autoMarca.value = info_marca[0].marca;
                });
                
            });
            autoYear.value = info_auto[0].anio;
            var clienteAuto = obtenerCliente(info_auto[0].id_cliente);
            clienteAuto.done(function(responseCliente){
                var info_cliente = JSON.parse(responseCliente);
                autoCliente.value = info_cliente[0].nombre;
                
            });
            autoModalTitle.innerHTML = "Auto: " + autoPatente.value + " " + autoMarca.value + " " + autoModelo.value + " - Cliente: " + autoCliente.value;
            
        });
        
        btn_auto_modal.setAttribute("accion", "editarAuto");
        btn_auto_modal.value = "Guardar";

    }
    mostrarModal("autoModal");
}


function mostrarModal(tipoModal){
    $('#'+tipoModal).modal('show');
}

function ocultarModal(tipoModal){
    $('#'+tipoModal).modal('hide');
}

function obtenerMarcas() {
    var action = 'obtenerMarcas';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}

function obtenerModelos() {
    var action = 'obtenerModelos';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}


function obtenerClientes() {
    var action = 'seleccionarClientes';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}

function obtenerMarca(id_marca) {
    var action = 'seleccionarMarca';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_marca:id_marca}
    });
}

function obtenerModelo(id_modelo) {
    var action = 'seleccionarModelo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_modelo:id_modelo}
    });
}

function obtenerAutoPorPatente(patente) {
    var action = 'seleccionarAutoPorPatente';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, patente:patente}
    });
}

function obtenerModeloPorNombre(modelo) {
    var action = 'seleccionarModeloNombre';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, modelo:modelo}
    });
}

function obtenerCliente(id_cliente) {
    var action = 'seleccionarCliente';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_cliente:id_cliente}
    });
}

function obtenerAuto(id_auto) {
    var action = 'seleccionarAuto';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_auto:id_auto}
    });
}

function recargar(){
    console.log($(event.target).attr('data-bs-dismiss'));
    var cerrar = $(event.target).attr('data-bs-dismiss');
    console.log(cerrar);
    if(modalAuto){
        mostrarModal("autoModal");
    }
    else if(cerrar == "modal"){
        console.log(cerrar);
    }
    else {
        location.reload();
    }
}

function DisplayVolver(FORM){
    console.log();
    successRespuesta.innerHTML = "";
    errorRespuesta.innerHTML = "";
    if(modalAbierto && FORM == "HOME" && FORM != "HOME_ORDEN"){
        FORM = modalAbierto;
    }
    // console.log(FORM);
    if(FORM == "AUTO"){
        $("#errorModal").modal('hide');
        $("#successModal").modal('hide');
        $("#deleteModal").modal('hide');
        $("#clienteModal").modal('hide');
        $("#marcaModal").modal('hide');
        $("#modeloModal").modal('hide');
        abrirModalAuto(autoId.value);
        actualizarTablas();
    }
    else if(FORM == "ORDEN"){
        $("#errorModal").modal('hide');
        $("#successModal").modal('hide');
        $("#deleteModal").modal('hide');
        if(event.target.id == "btn_success_modal"){
            actualizarTablas();
        }
        // $("#clienteModal").modal('hide');
        // $("#marcaModal").modal('hide');
        // $("#modeloModal").modal('hide');
        // $("#autoModal").modal('hide');
        // $("#ordenModal").modal('show');
        abrirModalOrden(id_orden);
    }
    else if(FORM == "HOME" || FORM == "HOME_ORDEN"){
        $("#errorModal").modal('hide');
        $("#successModal").modal('hide');
        $("#deleteModal").modal('hide');
        actualizarTablas();
        location.reload();
    }
    else if(FORM == "FACTURACION"){
        $("#errorModal").modal('hide');
        $("#successModal").modal('hide');
        $("#deleteModal").modal('hide');
        $("#presupuestoModal").modal('hide');
        abrirModalFacturacion();
    }
    else if(FORM == "TRABAJO"){
        $("#errorModal").modal('hide');
        $("#successModal").modal('hide');
        $("#deleteModal").modal('hide');
        $("#reciboModal").modal('hide');
        abrirModalTrabajo();
    }
    else if(FORM == "ADJUNTOS"){
        $("#adjuntosModal").modal('hide');
        $("#historialModal").modal('show');
    }
    else if(FORM == "PENDIENTES"){
        ocultarModal("pendientesModal");
        location.reload();
    }
    // if(FORM == "VINCULADOS"){
    //     $("#ModalMessageReturn").modal('hide');
    //     DisplayVinculados();
    // }
}

//MODAL FORM EDITAR MARCA
function editarMarca(marca){
    var id_marca = $(marca).attr('id-marca');

    abrirModalMarca(id_marca);

}

//MODAL FORM EDITAR MODELO
function editarModelo(modelo){
    var id_modelo = $(modelo).attr('id-modelo');

    abrirModalModelo(id_modelo);
}

//MODAL FORM EDITAR CLIENTE
function editarCliente(cliente){
    var id_modelo = $(cliente).attr('id-cliente');

    abrirModalCliente(id_modelo);
}