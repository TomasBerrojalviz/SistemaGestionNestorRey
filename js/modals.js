
const clientes = obtenerClientes();

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
var autoPatente = document.getElementById("autoPatente");
var autoMarca = document.getElementById("autoMarca");
var autoModelo = document.getElementById("autoModelo");
var autoYear = document.getElementById("autoYear");
var autoCliente = document.getElementById("autoCliente");
var btn_auto_modal = document.getElementById("btn_auto_modal");

$( document ).ready(function() {
    //MODAL FORM AGREGAR MARCA
    $('#btnAgregarMarca').click(function(e){ 
        e.preventDefault();

        abrirModalMarca(0);
    });

    //MODAL FORM EDITAR MARCA
    $('.editMarca').click(function(e){ 
        e.preventDefault();
        var id_marca = $(this).attr('id-marca');

        abrirModalMarca(id_marca);
    });
    
    //MODAL FORM AGREGAR MODELO
    $('#btnAgregarModelo').click(function(e){ 
        e.preventDefault();

        abrirModalModelo(0);
    });

    //MODAL FORM EDITAR MODELO
    $('.editModelo').click(function(e){ 
        e.preventDefault();
        var id_modelo = $(this).attr('id-modelo');

        abrirModalModelo(id_modelo);
    });
    
    //MODAL FORM AGREGAR CLIENTE
    $('#btnAgregarCliente').click(function(e){ 
        e.preventDefault();

        abrirModalCliente(0);
    });

    //MODAL FORM EDITAR CLIENTE
    $('.editCliente').click(function(e){ 
        e.preventDefault();
        var id_modelo = $(this).attr('id-cliente');

        abrirModalCliente(id_modelo);
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

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: {action:action, id:id_marca, marca:marcaValor.value},
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

    //MODAL FORM ELIMINAR MODELO
    $('.deleteModelo').click(function(e){ 
        e.preventDefault();
        var id_modelo = $(this).attr('id-modelo');
        var action = 'borrarModelo';

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
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
            async: true,
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
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                data: {action:action, id:marcaId.value, marca:marcaValor.value},
                success: function(response) {
                    if (response != "error") {
                        var marca = JSON.parse(response);
                        if(marca){
                            if(window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }

                            ocultarModal("marcaModal");
                            mostrarModal("succesModal");
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
        // e.preventDefault();

        if(marcaModelo.classList.contains('is-invalid')){
            alert("Ingrese un modelo valido");  
        }
        else if(!marcaModelo.validity.valid){
            $(marcaModelo).addClass('is-invalid');
        }
        else if(!modeloValor.validity.valid){
            $(modeloValor).addClass('is-invalid');
        }
        else{
            var action = btn_modelo_modal.getAttribute('accion');
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
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
                            mostrarModal("succesModal");
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
        // e.preventDefault();

        if(clienteTelefono.classList.contains('is-invalid')){
            alert("Ingrese un telefono valido");  
            e.preventDefault();
        }
        else if(clienteMail.classList.contains('is-invalid')){
            alert("Ingrese un mail valido");  
            e.preventDefault();
        }
        else if(!clienteNombre.validity.valid){
            $(clienteNombre).addClass('is-invalid');
        }
        else if(!clienteTelefono.validity.valid){
            $(clienteTelefono).addClass('is-invalid');
        }
        else{
            var action = btn_cliente_modal.getAttribute('accion');
            console.log(action);
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                data: {action:action, id:clienteId.value, nombre:clienteNombre.value, telefono:clienteTelefono.value, mail:clienteMail.value, domicilio:clienteDomicilio.value},
                success: function(response) {
                    console.log(response);
                    if (response != "error") {
                        var clienteCargado = JSON.parse(response);
                        if(clienteCargado){
                            if(window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }

                            ocultarModal("clienteModal");
                            mostrarModal("succesModal");
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
            alert("Ingrese una patente valida");  
            e.preventDefault();
        }
        else if(autoMarca.classList.contains('is-invalid')){
            alert("Ingrese una marca valida");  
            e.preventDefault();
        }
        else if(autoModelo.classList.contains('is-invalid')){
            alert("Ingrese un modelo valido");  
            e.preventDefault();
        }
        else if(autoCliente.classList.contains('is-invalid')){
            alert("Ingrese un cliente valido");  
            e.preventDefault();
        }
        else if(!autoPatente.validity.valid){
            $(autoPatente).addClass('is-invalid');
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
            var action = btn_auto_modal.getAttribute('accion');
            console.log(action);
            var id_estado = 0;
            var id_modelo = 0;
            var modeloBuscado = obtenerModelo(id_modelo);
            modeloBuscado.done(function(responseCliente){
                var info_modelo = JSON.parse(responseCliente);
                modeloValor.value = info_modelo[0].modelo;
                var marcaModeloValor = obtenerMarca(info_modelo[0].id_marca);
                marcaModeloValor.done(function(responseCliente){
                    var info_marca_modelo = JSON.parse(responseCliente);
                    marcaModelo.value = info_marca_modelo[0].marca;
                });
                
            });
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                // id_estado patente	id_modelo	year	id_cliente
                data: {action:action, id:autoId.value, id_estado:id_estado, patente:autoPatente.value, id_modelo:id_modelo, year:autoYear.value, id_cliente:id_cliente},
                success: function(response) {
                    console.log(response);
                    if (response != "error") {
                        var autoCargado = JSON.parse(response);
                        if(autoCargado){
                            if(window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }

                            ocultarModal("autoModal");
                            mostrarModal("succesModal");
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
        marcaModalTitle.innerHTML = "Agregar modelo";
        marcaId.value = 0;
        marcaValor.value = "";
        btn_marca_modal.setAttribute("accion", "agregarMarca");
        btn_marca_modal.value = "Agregar modelo";
    }
    else{
        marcaModalTitle.innerHTML = "Editar modelo";
        marcaId.value = id;
        var marcaEditar = obtenerMarca(id);
        marcaEditar.done(function(responseCliente){
            var info_marca = JSON.parse(responseCliente);
            marcaValor.value = info_marca[0].marca;
        });
        
        btn_marca_modal.setAttribute("accion", "editarMarca");
        btn_marca_modal.value = "Editar modelo";

    }
    mostrarModal("marcaModal");
}

function abrirModalModelo(id) {
    $(marcaModelo).removeClass('is-invalid').removeClass('is-valid');

    if (id == 0){
        modeloModalTitle.innerHTML = "Agregar modelo";
        modeloId.value = 0;
        marcaModelo.value = "";
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
        clienteModalTitle.innerHTML = "Agregar cliente con jquery";
        clienteId.value = 0;
        clienteNombre.value = "";
        clienteTelefono.value = "";
        clienteMail.value = "";
        clienteDomicilio.value = "";
        btn_cliente_modal.setAttribute("accion", "agregarCliente");
        btn_cliente_modal.value = "Agregar cliente";
    }
    else{
        clienteModalTitle.innerHTML = "Editar cliente con jquery";
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
    $(autoPatente).removeClass('is-invalid').removeClass('is-valid');
    $(autoMarca).removeClass('is-invalid').removeClass('is-valid');
    $(autoModelo).removeClass('is-invalid').removeClass('is-valid');
    $(autoCliente).removeClass('is-invalid').removeClass('is-valid');

    if (id == 0){
        autoModalTitle.innerHTML = "Agregar auto con jquery";
        autoId.value = 0;
        autoPatente.value = "";
        autoMarca.value = "";
        autoModelo.value = "";
        autoYear.value = "";
        autoCliente.value = "";
        btn_auto_modal.setAttribute("accion", "agregarAuto");
        btn_auto_modal.value = "Agregar auto";
    }
    else{ //TODO TERMINAR AGREGAR VALORES MARCA MODELO Y CLIENTE
        autoModalTitle.innerHTML = "Editar auto con jquery";
        autoId.value = id;
        var autoEditar = obtenerAuto(id);
        autoEditar.done(function(responseCliente){
            var info_auto = JSON.parse(responseCliente);
            autoPatente.value = info_auto[0].patente;
            var autoEditar = obtenerAuto(id);
            autoEditar.done(function(responseCliente){
                var info_auto = JSON.parse(responseCliente);
            });
            autoModelo.value = info_auto[0].id_modelo;
            autoYear.value = info_auto[0].year;
            autoCliente.value = info_auto[0].id_cliente;
            
        });
        
        btn_auto_modal.setAttribute("accion", "editarAuto");
        btn_auto_modal.value = "Editar auto";

    }
    mostrarModal("autoModal");
}

function mostrarModal(tipoModal){
    $('#'+tipoModal).modal('show');
}

function ocultarModal(tipoModal){
    $('#'+tipoModal).modal('hide');
}

function obtenerClientes() {
    var action = 'seleccionarClientes';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action}
    });
}

function obtenerMarca(id_marca) {
    var action = 'seleccionarMarca';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, id_marca:id_marca}
    });
}

function obtenerModelo(id_modelo) {
    var action = 'seleccionarModelo';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, id_modelo:id_modelo}
    });
}

function obtenerModeloPorNombre(modelo) {
    var action = 'seleccionarModeloNombre';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, modelo:modelo}
    });
}

function obtenerCliente(id_cliente) {
    var action = 'seleccionarCliente';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, id_cliente:id_cliente}
    });
}