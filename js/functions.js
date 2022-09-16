var tablasVacias = document.getElementsByClassName("dataTables_empty");
var modalAbierto = "";

$( document ).ready(function() {
    // modalAbierto = false;
    setTablas();

    
    for (var i = 0; i < tablasVacias.length; i++) {
        var element = tablasVacias[i];
        element.innerHTML  = "No hay informacion cargada";
    }

    //MODAL FORM MARCA PARA AUTO
    $('#autoMarca').change(function(e){
        actualizarTablas();
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

        if(tipoModal == "orden"){
            modalAbierto = "ORDEN";
            abrirModalOrden(id);
        }
        else if(tipoModal == "auto"){
            modalAbierto = "AUTO";
            abrirModalAuto(id);
        }

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
    console.log(select);
    console.log(id);

}

function editarModal(){
    // preventDefault();
    $('#editarModeloModal').modal('show');
    
}

function setTablas(){ 
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
    $("#tableOrdenes_info").addClass('text-light mx-1');

    actualizarTablas();
}

function actualizarTablas() {
    
    clientes = obtenerClientes();
    marcas = obtenerMarcas();
    modelos = obtenerModelos();
    
    marcas.done(function(responseMarcas){
        if(responseMarcas != "error"){
            var info_marcas = JSON.parse(responseMarcas);
            console.log(info_marcas);
            
            while (dataListMarca.firstChild) {
                dataListMarca.removeChild(dataListMarca.firstChild);
            }

            info_marcas.forEach(marca => {
                dataListMarca.appendChild(agregarOptionMarca(marca));
            });
        }
    });
    modelos.done(function(responseModelos){
        if(responseModelos != "error"){
            var info_modelos = JSON.parse(responseModelos);
            console.log(info_modelos);
            
            while (dataListModelo.firstChild) {
                dataListModelo.removeChild(dataListModelo.firstChild);
            }
            
            info_modelos.forEach(modelo => {
                dataListModelo.appendChild(agregarOptionMarca(modelo));
            });
        }
    });
}

function generarPDF(tipo, id, cliente){
    // 210 x 297 mm
    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));
    var nombreVentana = "";
    var url = "";

    if(tipo == "presupuesto"){
        url = 'vista/utils/generarPresupuesto.php?pr='+id+'&cl='+cliente;
        nombreVentana = "Presupuesto";
    }
    window.open(url, nombreVentana, "left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizeble=si,menubar=no");
}