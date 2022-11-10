var tablasVacias = document.getElementsByClassName("dataTables_empty");
var modalAbierto = "";

// VAR DATA LIST MARCA
var dataListMarca = document.getElementById("marcas");
var dataListModelo = document.getElementById("modelos");

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
            async: false,
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

    // //TOCAR FILA
    // $('.fila').click(function(e){
    //     e.preventDefault();
    //     if (e.target.parentNode.className  == ' columnaAccion' || e.target.parentNode.parentNode.className  == ' columnaAccion'){
    //         return;
    //     }
    //     var id = $(this).attr('id');
    //     var tipoModal = $(this).attr('tipoModal');

    //     if(tipoModal == "orden"){
    //         modalAbierto = "ORDEN";
    //         abrirModalOrden(id);
    //     }
    //     else if(tipoModal == "auto"){
    //         modalAbierto = "AUTO";
    //         abrirModalAuto(id);
    //     }

    // });
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
        async: false,
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
        async: false,
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
        async: false,
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
    var telefonoFeedback = document.getElementById("telefonoFeedback");
    const regex = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;

    if(telefonoCliente.length != 0){
        if(telefonoCliente.length < 8){
            $("#clienteTelefono").addClass('is-invalid');
            telefonoFeedback.innerHTML = "Demasiado corto. Ingrese un telefono valido";
        }
        else if(regex.test(telefonoCliente)){
            $("#clienteTelefono").addClass('is-valid');
        }
        else{
            $("#clienteTelefono").addClass('is-invalid');
            telefonoFeedback.innerHTML = "Formato incorrecto. Ingrese un telefono valido";
        }
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
        if(i == 4 && pago < traerCobroRecibo()){
            continue;
        }
        else{
            var option = document.createElement("option");
            option.innerHTML = estadoText(i);
            option.value = i;
            if(id == i) {
                option.selected = true;
            }
            select.appendChild(option);
        }
    }

}

function editarModal(){
    // preventDefault();
    $('#editarModeloModal').modal('show');

}

function setTablas(){
    $('#tableMarca').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ marcas",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningúna marca cargada",
            "sInfo":           "Mostrando marcas del _START_ al _END_ de un total de _TOTAL_ marcas",
            "sInfoEmpty":      "Mostrando marcas del 0 al 0 de un total de 0 marcas",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ marcas)",
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
        order: [[1, 'asc']]
    });
    if(document.getElementById("tableMarca_paginate")){
        $("#tableMarca_filter").addClass('text-light float-end mx-2');
        document.getElementById("tableMarca_paginate").removeAttribute('class');
        $("#tableMarca_paginate").addClass('text-light float-end my-2');
        $("#tableMarca_length").addClass('text-light mx-1');
        $("#tableMarca_info").addClass('text-light mx-1');
    }

    $('#tableModelo').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ modelos",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún modelo cargado",
            "sInfo":           "Mostrando modelos del _START_ al _END_ de un total de _TOTAL_ modelos",
            "sInfoEmpty":      "Mostrando modelos del 0 al 0 de un total de 0 modelos",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ modelos)",
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
        order: [[1, 'asc']]
    });
    if(document.getElementById("tableModelo_paginate")){
        $("#tableModelo_filter").addClass('text-light float-end mx-2');
        document.getElementById("tableModelo_paginate").removeAttribute('class');
        $("#tableModelo_paginate").addClass('text-light float-end my-2');
        $("#tableModelo_length").addClass('text-light mx-1');
        $("#tableModelo_info").addClass('text-light mx-1');
    }

    $('#tableCliente').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ clientes",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún cliente cargado",
            "sInfo":           "Mostrando clientes del _START_ al _END_ de un total de _TOTAL_ clientes",
            "sInfoEmpty":      "Mostrando clientes del 0 al 0 de un total de 0 clientes",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ clientes)",
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
        order: [[1, 'asc']]
    });
    if(document.getElementById("tableCliente_paginate")){
        $("#tableCliente_filter").addClass('text-light float-end mx-2');
        document.getElementById("tableCliente_paginate").removeAttribute('class');
        $("#tableCliente_paginate").addClass('text-light float-end my-2');
        $("#tableCliente_length").addClass('text-light mx-1');
        $("#tableCliente_info").addClass('text-light mx-1');
    }
    actualizarTablas();
}

function actualizarTablas() {
    let params = new URLSearchParams(location.search);
    var pagina = params.get('pagina');
    var paginasConTablas = ["autos", "ordenes", "marcas_modelos"];

    if(!paginasConTablas.includes(pagina)){
        return;
    }
    if(pagina == "autos"){
        cargarTabla('tableAuto');
    }
    if(pagina == "ordenes"){
        cargarTabla('tableOrdenes');
    }
    else{
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
}

function generarPDF(tipo, id){
    // 210 x 297 mm
    var ancho = 824;
    var alto = 568;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));
    var nombreVentana = "";
    var url = "";

    if(tipo == "presupuesto"){
        url = 'vista/utils/generarPresupuesto.php?pr='+id;
        nombreVentana = "Presupuesto";
    }
    else if(tipo == "recibo"){
        url = 'vista/utils/generarRecibo.php?re='+id;
        nombreVentana = "Recibo";
    }
    window.open(url, nombreVentana, "left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizeble=si,menubar=no");
}

function abrirArchivo(url, nombreVentana){
    // window.location.href = url;

    var ancho = 824;
    var alto = 568;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    var ventana = window.open(url, nombreVentana, "left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizeble=no,menubar=no");
    if(!(url.includes("pdf") || url.includes("jpg") || url.includes("jpeg") || url.includes("png") || url.includes("tiff") || url.includes("svg") || url.includes("txt"))){
        setTimeout(() => {
            ventana.close();
        }, 500);

    }
}

function crearVisualizadorAdjuntos(visualizador, archivos, click){
    var clickAbrir = '';
    var j = -1;
    var row = [];

    while (visualizador.firstChild) {
        visualizador.setAttribute("error", "no-error");
        $(visualizador).removeClass('is-invalid');
        visualizador.removeChild(visualizador.firstChild);
    }
    for(var i = 0; i < archivos.length; i++){
        if(click){
            clickAbrir = 'onclick="abrirArchivo(\''+archivos[i].url+'\',\''+archivos[i].name+'\');"';
            if(archivos[i].size > 10000000){
                visualizador.setAttribute("error","error");
                alert = '<div class="alert alert-danger" role="alert">';
                alert += 'Excede tamaño maximo <i class="fa-solid fa-circle-exclamation"></i>';
                alert += '</div>';
                src = "img/error.png";
            }   
        }
        var src = archivos[i].url;
        var split_file = archivos[i].name.split(".");
        var ext = split_file[split_file.length - 1];
        var not_valid_ext = ["exe", "lnk"];
        var alert = "";
        var style = "width: auto;";

        if(not_valid_ext.includes(ext)){
            visualizador.setAttribute("error","error");
            alert = '<div class="alert alert-danger" role="alert">';
            alert += 'Tipo incorrecto <i class="fa-solid fa-circle-exclamation"></i>';
            alert += '</div>';
            src = "img/error.png";
        }


        if(ext == "pdf"){
            src = "img/pdf.png";
        }
        else if(ext == "doc" || ext == "docx" || ext == "dot" || ext == "dotx"){
            src = "img/word.png";
        }
        else if(ext == "xlsx" || ext == "xlsm" || ext == "xls" || ext == "xml" || ext == "xlr"){
            src = "img/excel.png";
        }
        else if(ext == "rar" || ext == "zip" || ext == "7z"){
            src = "img/rar.png";
        }
        else if(ext == "mp4" || ext == "mov" || ext == "wmv" || ext == "avi" || ext == "mkv"){
            src = "img/video.png";
        }
        else if(ext == "txt"){
            src = "img/txt.png";
        }
        else{
            // src = src;
            style = "width: 100%;";
        }

        var preview = '<div class="card col-4 mt-2 text-center" style="display: block; padding: 0px 0px 0px 0px;" '+clickAbrir+'>'; // PROBLEMA CON ROW
                preview += '<img src="'+src+'" alt="'+archivos[i].name+'" class="rounded-top" height="150px" style="'+style+'">';
                preview += '<div class="card-body">';
                    preview += '<h5 class="card-text">'+archivos[i].name+'</h5>';
                    preview += alert;
                preview += '</div>';
            preview += '</div>';
        preview += '</div>';

        if((i % 3) == 0){
            j++;
            row[j] = document.createElement("div");
            row[j].className = 'row mb-2';

        }
        row[j].innerHTML += preview;
    }
    for(var i = 0; i < row.length; i++){
        visualizador.appendChild(row[i]);
    }
}

function imprimir(){

    btn_print.style.display = "none";

}

function transDate(date){
    var d = new Date(date);

    return d.getDate() + "/" + (+d.getMonth()+1) + "/" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
}
function sortTablaOrdenes(){
    var tablaOrdenes = $('#tableOrdenes').DataTable();

    tablaOrdenes
        .order( [ 0, 'asc' ] )
        .draw();
}

function ocultarClase(clase){
    // colAuto.style.display = "initial";
    for (var i = 0; i < clase.length; i++) {
        var element = clase[i];
        element.style.display = "none";
    }
}
function mostrarClase(clase){
    // colAuto.style.display = "none";
    for (var i = 0; i < clase.length; i++) {
        var element = clase[i];
        element.style.display = "initial";
    }
}

function buscarOrdenesRelacionadas(){
    sessionStorage.setItem('autoBuscado', autoPatente.value);
    window.history.pushState(null,null,'index.php?pagina=ordenes');
}

function obtenerAutoCompleto(id_auto) {
    var action = 'seleccionarAutoCompleto';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action, id_auto:id_auto}
    });
}