// $.getScript("modals.js");

$( document ).ready(function() {


    //MODAL FORM EDIT CLIENTE
    $('.editCliente').click(function(e){ 
        e.preventDefault();
        var id_cliente = $(this).attr('idCliente');
        var action = 'seleccionarCliente';
        
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action:action, id_cliente:id_cliente},
            success: function(response) {
                if (response != "error") {
                    var info = JSON.parse(response);
                    $("#clienteEditarId").val(info[0].id);
                    $("#clienteEditarNombre").val(info[0].nombre);
                    $("#clienteEditarTelefono").val(info[0].telefono);
                    $("#clienteEditarMail").val(info[0].mail);
                    $("#clienteEditarDomicilio").val(info[0].domicilio);
                    // console.log(info);
                    
                    $('#clienteEditarModal').modal('show');

                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });
    
    //MODAL FORM MODELOS DE MARCA
    $('#agregarMarcaAuto').change(function(e){
        var marca = $(this).val();
        // console.log(marca);
        var action = 'seleccionarModelos';

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action:action, marca:marca},
            success: function(response) {
                if (response != "error") {  
                    var modelosDeseados = JSON.parse(response);

                    var listaModelos = document.getElementById("modelosMarca");
                    while (listaModelos.firstChild) {
                        listaModelos.removeChild(listaModelos.firstChild);
                    }
                    modelosDeseados.forEach(modelo => {
                        // console.log(modelo);
                        listaModelos.appendChild(agregarOptionModelo(modelo));
                    });

                    // console.log(response);
                    // console.log(modelosDeseados);

                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });

    //MODAL FORM CLIENTES PARA AUTO
    $('#btnAgregarAuto').click(function(e){
        // var action = 'seleccionarClientes';
        clientes.done(function(responseCliente){
            var info_cliente = JSON.parse(responseCliente);
            
            var listaClientes = document.getElementById("dataListClientes");
            while (listaClientes.firstChild) {
                listaClientes.removeChild(listaClientes.firstChild);
            }
            info_cliente.forEach(cliente => {
                console.log(cliente);
                listaClientes.appendChild(agregarOptionCliente(cliente));
            });
        });
    });
});

function verificarCliente(){
    var nombreCliente = $("#agregarCliente").val();
    $("#agregarCliente").removeClass('is-invalid').removeClass('is-valid');
    // $.get("../mod_ou/procesos/procesar_sector_search.php", {SEARCH:SECTOR},
    // function(data) {	
    //     if(data.ID_OU != 0 && data.DISPONIBLE == 'TRUE'){
    //         $("#f_id_sector").val(data.ID_OU);	
    //         $("#f_sector").addClass('is-valid');
    //     }else{
    //         $("#f_sector").addClass('is-invalid');
    //         $("#f_sector_error").addClass('invalid-feedback').text('El sector es invalido!');
    //     }
    // }, 'json');
    var action = 'verificarCliente';

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, nombreCliente:nombreCliente},
        success: function(response) {
            if (response != "error") {
                var cliente = JSON.parse(response);
                $("#agregarCliente").addClass('is-valid');
            }
            else{
                $("#agregarCliente").addClass('is-invalid');
            }
        },
        error: function(error) {
            $("#agregarCliente").addClass('is-invalid');
        }
    });
}

function verificarMarca(){
    var marcaAuto = $("#agregarMarcaAuto").val();
    $("#agregarMarcaAuto").removeClass('is-invalid').removeClass('is-valid');
    var action = 'verificarMarca';

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, marcaAuto:marcaAuto},
        success: function(response) {
            if (response != "error") {
                var marca = JSON.parse(response);
                $("#agregarMarcaAuto").addClass('is-valid');
            }
            else{
                $("#agregarMarcaAuto").addClass('is-invalid');
            }
        },
        error: function(error) {
            $("#agregarMarcaAuto").addClass('is-invalid');
        }
    });
}

function verificarModelo(){
    var modeloAuto = $("#agregarModeloAuto").val();
    $("#agregarModeloAuto").removeClass('is-invalid').removeClass('is-valid');
    var action = 'verificarModelo';

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, modeloAuto:modeloAuto},
        success: function(response) {
            if (response != "error") {
                var modelo = JSON.parse(response);
                $("#agregarModeloAuto").addClass('is-valid');
            }
            else{
                $("#agregarModeloAuto").addClass('is-invalid');
            }
        },
        error: function(error) {
            $("#agregarModeloAuto").addClass('is-invalid');
        }
    });
}

        // success: function(response) {
        //     if (response != "error") {
        //         var info = JSON.parse(response);
                
        //         console.log(info);
        //         $("#listaMarcas").val(info[0].marca);

        //         marca = (info[0].marca);
        //         console.log(marca);
        //     }
        // },
        // error: function(error) {
        //     alert(error);
        // }
        

function recargar(){
    location.reload();
}
function editarModal(){
    // preventDefault();
    $('#editarModeloModal').modal('show');
    
}
