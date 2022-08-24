
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

    //BTN MODAL MARCA 
    $('#btn_marca_modal').click(function(e){ 
        e.preventDefault();
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
    });
    
    //BTN MODAL MODELO 
    $('#btn_modelo_modal').click(function(e){ 
        e.preventDefault();

        if(marcaModelo.classList.contains('is-invalid')){
            alert("Ingrese una marca valida");  
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