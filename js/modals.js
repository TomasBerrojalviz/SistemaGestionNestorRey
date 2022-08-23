
const clientes = obtenerClientes();

var marcaModalTitle = document.getElementById("marcaModalTitle");
var marcaId = document.getElementById("marcaId");
var marcaValor = document.getElementById("marca");
var btn_marca_modal = document.getElementById("btn_marca_modal");

$( document ).ready(function() {
    //MODAL FORM AGREGAR MARCA
    $('#btnAgregarMarca').click(function(e){ 
        e.preventDefault();

        abrirModalMarca(0);

        var action = 'agregarMarca';
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
                        mostrarModal("succesModal");
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });

    //MODAL FORM EDITAR MARCA
    $('.editMarca').click(function(e){ 
        e.preventDefault();
        var id_marca = $(this).attr('idMarca');

        abrirModalMarca(id_marca);
        var action = 'agregarMarca';
        
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
                        mostrarModal("succesModal");
                    }
                }
            },
            error: function(error) {
                alert(error);
            }
        });
        // e.preventDefault();
        // var action = 'seleccionarMarca';

        // $.ajax({
        //     type: "POST",
        //     url: "ajax.php",
        //     async: true,
        //     data: { action:action, id_marca:id_marca},
        //     success: function(response) {
        //         if (response != "error") {
        //             var info = JSON.parse(response);
        //             $("#editarMarcaId").val(info[0].id);
        //             $("#editarMarca").val(info[0].marca);
        //             // console.log(info);
                    
        //             $('#editarMarcaModal').modal('show');

        //         }
        //     },
        //     error: function(error) {
        //         alert(error);
        //     }
        // });
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
    marcaModalTitle = document.getElementById("marcaModalTitle");
    marcaId = document.getElementById("marcaId");
    marcaValor = document.getElementById("marca");
    btn_marca_modal = document.getElementById("btn_marca_modal");

    if (id == 0){
        marcaModalTitle.innerHTML = "Agregar marca por jquery";
        marcaId.value = 0;
        marcaValor.value = "";
        btn_marca_modal.value = "Agregar marca";
    }
    else{
        marcaModalTitle.innerHTML = "Editar marca por jquery";
        marcaId.value = id;
        var action = 'seleccionarMarca';

        // $.ajax({
        //     type: "POST",
        //     url: "ajax.php",
        //     async: true,
        //     data: { action:action, id_marca:id},
        //     success: function(response) {
        //         if (response != "error") {
        //             var info = JSON.parse(response);
                
        //             marcaValor.value = info[0].marca;
        //             // $("#editarMarcaId").val(info[0].id);
        //             // $("#editarMarca").val(info[0].marca);
        //             // console.log(info);
                    
        //             // $('#editarMarcaModal').modal('show');

        //         }
        //     },
        //     error: function(error) {
        //         alert(error);
        //     }
        // });
        
        var marcaEditar = obtenerMarca(id);
        marcaEditar.done(function(responseCliente){
            var info_marca = JSON.parse(responseCliente);
            marcaValor.value = info_marca[0].marca;
        });

        // marcaValor.value = "";
        btn_marca_modal.value = "Editar marca";

    }
    mostrarModal("marcaModal");
}

function mostrarModal(tipoModal){
    $('#'+tipoModal).modal('show');
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