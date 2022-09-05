const dataOrden = document.getElementsByClassName("dataOrden");
var tablasVacias = document.getElementsByClassName("dataTables_empty");

$( document ).ready(function() {    
    $('#tableAuto').DataTable();
    $("#tableAuto_filter").addClass('text-light float-end');
    $("#tableAuto_paginate").addClass('text-light float-end');
    $("#tableAuto_length").addClass('text-light  mx-1');
    $("#tableAuto_info").addClass('text-light mx-1');

    $('#tableMarca').DataTable();
    $("#tableMarca_filter").addClass('text-light float-end');
    $("#tableMarca_paginate").addClass('text-light float-end');
    $("#tableMarca_length").addClass('text-light mx-1');
    $("#tableMarca_info").addClass('text-light mx-1');

    $('#tableModelo').DataTable();
    $("#tableModelo_filter").addClass('text-light float-end');
    $("#tableModelo_paginate").addClass('text-light float-end');
    $("#tableModelo_length").addClass('text-light  mx-1');
    $("#tableModelo_info").addClass('text-light mx-1');
    
    $('#tableCliente').DataTable();
    $("#tableCliente_filter").addClass('text-light float-end');
    $("#tableCliente_paginate").addClass('text-light float-end');
    $("#tableCliente_length").addClass('text-light  mx-1');
    $("#tableCliente_info").addClass('text-light mx-1');
    
    $('#tableOrdenes').DataTable();
    $("#tableOrdenes_filter").addClass('text-light float-end');
    $("#tableOrdenes_paginate").addClass('text-light float-end');
    $("#tableOrdenes_length").addClass('text-light');
    var myElement = document.getElementById("tableOrdenes_length");
    // myElement.children[0].innerHTML = myElement.children[0].innerHTML.replace('Show', 'Mostrar');
    // myElement.children[0].innerHTML = myElement.children[0].innerHTML.replace('entries', 'entradas');
    // console.log(myElement.children[0].classList.add(''));
    // myElement.children[0].addClass('container-fluid');
    // console.log(myElement.children[0]);
    // myElement.addClass('text-light');
    // for (let i = 0; i < myElement.children.length; i++) {
    //     console.log(myElement.children[i]);
    //     console.log("--------------------------------");
    //     console.log(myElement.children[i].children[0]);
    //     console.log("--------------------------------");
    //     console.log(myElement.children[i].innerHTML);
    //     myElement.children[i].innerHTML = "Mostrar ";
    //     myElement.children[i].addChild(myElement.children[i].children[0]);
    //     myElement.children[i].innerHTML = " Entradas";
    //     for (let j = 0; j < myElement.children[i].children.length; j++) {
    //         console.log(myElement.children[i].children[j]);
    //     }
    // }
    $("#tableOrdenes_info").addClass('text-light mx-1');

    
    for (var i = 0; i < tablasVacias.length; i++) {
        var element = tablasVacias[i];
        element.innerHTML  = "No hay informacion cargada";
    }

    //MODAL FORM MARCA PARA AUTO
    $('#autoMarca').change(function(e){
        verificarMarca($(this));
        var marca = $(this).val();
        console.log(marca);
        var action = 'seleccionarModelos';

        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action:action, marca:marca},
            success: function(response) {
                // console.log(response);
                if (response != "error") {  
                    var modelosDeseados = JSON.parse(response);

                    var listaModelos = document.getElementById("modelosMarca");
                    while (listaModelos.firstChild) {
                        listaModelos.removeChild(listaModelos.firstChild);
                    }
                    modelosDeseados.forEach(modelo => {
                        listaModelos.appendChild(agregarOptionModelo(modelo));
                    });
                    
                    verificarModelo();

                    // console.log(response);
                    // console.log(modelosDeseados);

                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });
    
    //MODAL FORM MODELO PARA AUTO
    $('#autoModelo').change(function(e){
        verificarModelo();
        // var modeloCorrecto = false;
        // var listaModelos = document.getElementById("modelosMarca");
        // var elemModelos = listaModelos.childNodes;  
        // var modeloAuto = $("#agregarModeloAuto").val().toUpperCase();
        // for (i = 0; i < elemModelos.length; i++) {
        //     if(elemModelos[i].value == modeloAuto) {
        //         modeloCorrecto = true;
        //     }

        // }
        
        // if(modeloCorrecto) {
        //     $("#agregarModeloAuto").removeClass('is-invalid');
        //     $("#agregarModeloAuto").addClass('is-valid');
        // }
        // else {
        //     $("#agregarModeloAuto").removeClass('is-valid');
        //     $("#agregarModeloAuto").addClass('is-invalid');
        // }

    });

    //BOTON AUTO
    // $('.btnAuto').click(function(e){
    //     e.preventDefault();
    //     var id_auto = $(this).attr('id-auto');

    //     abrirModalAuto(id_auto);

    // });

    //TOCAR FILA
    $('.fila').click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var tipoModal = $(this).attr('tipoModal');
        console.log(tipoModal);

        if(tipoModal == "orden")
            abrirModalOrden(id);
        else if(tipoModal == "auto")
            abrirModalAuto(id);

    });
});

function verificarCliente(){
    var nombreCliente = $("#autoCliente").val();
    $("#autoCliente").removeClass('is-invalid').removeClass('is-valid');
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
                $("#autoCliente").addClass('is-valid');
            }
            else{
                $("#autoCliente").addClass('is-invalid');
            }
        },
        error: function(error) {
            $("#autoCliente").addClass('is-invalid');
        }
    });
}

function verificarMarca(marcaLabel){
    var marcaAuto = marcaLabel.val();
    marcaLabel.removeClass('is-invalid').removeClass('is-valid');
    var action = 'verificarMarca';

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, marcaAuto:marcaAuto},
        success: function(response) {
            if (response != "error") {
                var marca = JSON.parse(response);
                marcaLabel.addClass('is-valid');
            }
            else{
                marcaLabel.addClass('is-invalid');
            }
        },
        error: function(error) {
            marcaLabel.addClass('is-invalid');
        }
    });

}

function verificarModelo(){
    var modeloAuto = $("#autoModelo").val();
    console.log(modeloAuto);
    $("#autoModelo").removeClass('is-invalid').removeClass('is-valid');
    var action = 'verificarModelo';

    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action:action, modeloAuto:modeloAuto},
        success: function(response) {
            if (response != "error") {
                var modelo = JSON.parse(response);
                $("#autoModelo").addClass('is-valid');
            }
            else{
                $("#autoModelo").addClass('is-invalid');
            }
        },
        error: function(error) {
            $("#autoModelo").addClass('is-invalid');
        }
    });
    
    var modeloCorrecto = false;
    var listaModelos = document.getElementById("modelosMarca");
    var elemModelos = listaModelos.childNodes;
    console.log($("#autoModelo").val());
    var modeloAuto = $("#autoModelo").val().toUpperCase();
    for (i = 0; i < elemModelos.length; i++) {
        if(elemModelos[i].value == modeloAuto) {
            modeloCorrecto = true;
        }

    }
    
    if(modeloCorrecto) {
        $("#autoModelo").removeClass('is-invalid');
        $("#autoModelo").addClass('is-valid');
    }
    else {
        $("#autoModelo").removeClass('is-valid');
        $("#autoModelo").addClass('is-invalid');
    }
}

function verificarNombreCliente(){
    var nombreCliente= $("#clienteNombre").val();
    $("#clienteNombre").removeClass('is-invalid').removeClass('is-valid');

    if(nombreCliente){
        $("#clienteNombre").addClass('is-valid');
    }
    else{
        $("#clienteNombre").addClass('is-invalid');
    }
}
function verificarMail(){
    var mailCliente= $("#clienteMail").val();
    $("#clienteMail").removeClass('is-invalid').removeClass('is-valid');
    const regex = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;

    if(mailCliente.match(regex)){
        $("#clienteMail").addClass('is-valid');
    }
    else{
        $("#clienteMail").addClass('is-invalid');
    }
}

function verificarTelefono(){
    var telefonoCliente = $("#clienteTelefono").val();
    $("#clienteTelefono").removeClass('is-invalid').removeClass('is-valid');
    const regex = /(\+)*([0-9]+)/;

    if(telefonoCliente.match(regex)){
        $("#clienteTelefono").addClass('is-valid');
    }
    else{
        $("#clienteTelefono").addClass('is-invalid');
    }
}

function estadoText(id){
    switch(id) {
        case 1:
            return "Pendiente";
        case 2:
            return "Cancelado";
        case 3:
            return "Finalizado";
        case 4:
            return "Entregado";
        case 5:
            return "Pendiente de pago";
        default:
            return "Estado incorrecto";
    }
}

function estadosSelect(id, select){
    console.log(select);
    console.log(id);
    while (select.firstChild) {
        select.removeChild(select.firstChild);
    }
    for(let i = 1; i < 6; i++) {
        var option = document.createElement("option");
        option.innerHTML = estadoText(i);
        option.value = i;
        if(id == i) {
            option.selected = true;
        }
        select.appendChild(option);
    }

}

function recargar(){
    location.reload();
}
function editarModal(){
    // preventDefault();
    $('#editarModeloModal').modal('show');
    
}