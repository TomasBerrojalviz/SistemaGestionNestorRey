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
        var action = 'seleccionarModelosMarca';

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

    // var modeloCorrecto = false;
    // var modeloAuto = $("#autoModelo").val().toUpperCase();
    // if(modeloAuto){
    //     var listaModelos = document.getElementById("modelosMarca");
    //     var elemModelos = listaModelos.childNodes;
    //     console.log($("#autoModelo").val());
    //     for (i = 0; i < elemModelos.length; i++) {
    //         if(elemModelos[i].value == modeloAuto) {
    //             modeloCorrecto = true;
    //             break;
    //         } 
    //     }
    // }
    // if(modeloCorrecto) {
    //     $("#autoModelo").removeClass('is-invalid');
    //     $("#autoModelo").addClass('is-valid');
    // }
    // else {
    //     $("#autoModelo").removeClass('is-valid');
    //     $("#autoModelo").addClass('is-invalid');
    // }
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

    if(mailCliente){
        if(mailCliente.match(regex)){
            $("#clienteMail").addClass('is-valid');
        }
        else{
            $("#clienteMail").addClass('is-invalid');
        }
    }
}

function verificarTelefono(){
    var telefonoCliente = $("#clienteTelefono").val();
    $("#clienteTelefono").removeClass('is-invalid').removeClass('is-valid');
    var telefonoFeedback = document.getElementById("telefonoFeedback");
    // const regex = /^[+]?[(]?[0-9]{1,3}[)]?[-\s\./0-9]*$/g;
    // const regex_nueva = /^[a-zA-Z]{2}([-]|\s)?[0-9]{3}([-]|\s)?[a-zA-Z]{2}$/g;
    const regex = /^[+]?[(\(|\s\()]?[0-9]{1,3}[(\)|\s\))]?[-\s\./0-9]*$/g;
    const regexWpp = /[(+|+54)]?[(\s|\-)]?[9][\s]?[11|15]?[(\s|\-)]?[0-9]{4}[(\s|\-)]?[0-9]{4}$/g;

    // +54 9 11 5311-7448

    if(telefonoCliente.length != 0){
        if(telefonoCliente.length < 8){
            $("#clienteTelefono").addClass('is-invalid');
            telefonoFeedback.innerHTML = "Demasiado corto. Ingrese un telefono valido";
        }
        else if(regexWpp.test(telefonoCliente) || regex.test(telefonoCliente)){
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
    document.getElementById("pagoCompleto").innerHTML = "";
    for(let i = 1; i < 5; i++) {
        if(i == 4 && pago < traerCobroRecibo(id_orden)){
            // continue;
            
            var boton = "<button class='btn btn-outline-dark text-bg-danger text-dark' onclick='abrirModalFacturacion()' style='width: 100%'>";
            boton +=        '<i class="fa-solid fa-hand-holding-dollar fa-flip-horizontal"> </i> <i class="fa-solid"> Falta pagar </i> <i class="fa-solid fa-hand-holding-dollar"></i>';
            boton +=    "</button>";
            document.getElementById("pagoCompleto").innerHTML = boton;
        }
        // else{
            var option = document.createElement("option");
            option.innerHTML = estadoText(i);
            option.value = i;
            if(id == i) {
                option.selected = true;
            }
            select.appendChild(option);
        // }
    }

}

function editarModal(){
    // preventDefault();
    $('#editarModeloModal').modal('show');

}

function setTablas(){
    $('#tableMarca').DataTable({
        dom: 'r <"col-lg-3 col-md-6 col-sm-12" B> <"wrapper" <"col-6 text-light float-end" f> <"col-6 text-light " l> t <"col-6 text-light float-end" p> <"col-6 text-light" i>>',
        // pagingType: "numbers",   
        buttons:[
            {
                extend: 'excelHtml5',
                text: '<i class="fa-regular fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-lg btn-success mb-2',
                exportOptions: {
                    columns: '1'
                },
                filename: 'Sistema Gestion - Marcas'
            }
        ],
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
        order: [[1, 'asc']],
        columnDefs: [
            { className: "dt-head-center", targets: "_all" }
        ],
        responsive: true,
        autoWidth: false,
    });

    $('#tableModelo').DataTable({
        dom: 'r <"col-lg-3 col-md-6 col-sm-12" B> <"wrapper" <"col-6 text-light float-end" f> <"col-6 text-light " l> t <"col-6 text-light float-end" p> <"col-6 text-light" i>>',
        buttons:[
            {
                extend: 'excelHtml5',
                text: '<i class="fa-regular fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-lg btn-success mb-2',
                exportOptions: {
                    columns: '1,2'
                },
                filename: 'Sistema Gestion - Modelos'
            }
        ],
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
        order: [[1, 'asc']],
        columnDefs: [
            { className: "dt-head-center", targets: "_all" }
        ],
    });

    $('#tableCliente').DataTable({
        dom: 'r <"col-lg-3 col-md-6 col-sm-12" B> <"wrapper" <"col-6 text-light float-end" f> <"col-6 text-light " l> t <"col-6 text-light float-end" p> <"col-6 text-light" i>>',
        buttons:[
            {
                extend: 'excelHtml5',
                text: '<i class="fa-regular fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-lg btn-success mb-2',
                exportOptions: {
                    columns: '1,2,3,4'
                }
            }
        ],
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
        order: [[1, 'asc']],
        columnDefs: [
            { className: "dt-head-center", targets: "_all" }
        ],
    });
    actualizarTablas();
}

// var aux = true;
// let timerInterval
// Swal.fire({
//   title: 'Auto close alert!',
//   html: 'I will close in <b></b> milliseconds.',
//   timer: 2000,
//   timerProgressBar: true,
//   didOpen: () => {
//     if(aux){
//         Swal.stopTimer();
//     }
//     else{
//         Swal.resumeTimer();
//     }
//     Swal.showLoading()
//     const b = Swal.getHtmlContainer().querySelector('b')
//     timerInterval = setInterval(() => {
//       b.textContent = Swal.getTimerLeft()
//     }, 100)
//   },
//   willClose: () => {
//     clearInterval(timerInterval)
//   }
// }).then((result) => {
//   /* Read more about handling dismissals below */
//   if (result.dismiss === Swal.DismissReason.timer) {
//     console.log('I was closed by the timer')
//   }
// })

function actualizarTablas() {

    let params = new URLSearchParams(location.search);
    var pagina = params.get('pagina');
    var paginasConTablas = ["autos", "ordenes", "ordenes_historicas", "marcas_modelos", "finanzas", "finanzas/ingresos", "finanzas/pendientes"];

    if(!paginasConTablas.includes(pagina)){
        return;
    }
    if(pagina == "autos"){
        cargarTabla('tableAuto');
    }
    else if(pagina == "ordenes"){  
        cargarTabla('tableOrdenes');
    }
    else if(pagina == "ordenes_historicas"){  
        cargarTabla('tablaOrdenesHistoricas');
    }
    else if(pagina.includes("finanzas")){
        if(pagina == "finanzas/ingresos"){
            cargarTabla('tableFinanzas');
        }
        else if(pagina == "finanzas/pendientes"){
            cargarTabla('tablePendientes');
        }
    }
    else{
        actualizarMarcasModelos();
    }
    var sp = document.getElementsByClassName("dtsp-topRow");
    for(var i = 0; i < sp.length; i++){
        $(sp[i]).removeClass("dtsp-bordered");
    }
}

function actualizarMarcasModelos(){
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
    // location.replace("index.php?pagina=ordenes");
    window.history.pushState(null,null,'index.php?pagina=ordenes_historicas');
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