const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
const meses_numero = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

const alertSuccess = Swal.mixin({
    allowOutsideClick: false,
    customClass: {
        confirmButton: 'btn btn-success'
    },
    buttonsStyling: false,
    icon: 'success',
    showConfirmButton: true,
    confirmButtonText: 'Aceptar',
    showCloseButton: true
});

const alertWarning = Swal.mixin({
    allowOutsideClick: false,
    customClass: {
        cancelButton: 'btn btn-secondary'
    },
    buttonsStyling: false,
    icon: 'warning',
    showConfirmButton: false,
    showCancelButton: true,
    cancelButtonText: 'Volver',
    showCloseButton: true
});

const alertError = Swal.mixin({
    allowOutsideClick: false,
    customClass: {
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: false,
    icon: 'error',
    showConfirmButton: false,
    showCancelButton: true,
    cancelButtonText: 'Volver',
    showCloseButton: true
});

const alertInfo = Swal.mixin({
    allowOutsideClick: false,
    // customClass: {
    //     cancelButton: 'btn btn-danger',
    // },
    // buttonsStyling: false,
    icon: 'info',
    // showConfirmButton: false,
    // showCancelButton: true,
    // cancelButtonText: 'Volver',
    showCloseButton: true
});

var columnaEstado = document.getElementsByClassName("columnaEstado");
var columnaPatente = document.getElementsByClassName("columnaPatente");
var columnaLlegada = document.getElementsByClassName("columnaLlegada");
var columnaProblema = document.getElementsByClassName("columnaProblema");
var columnaDevolucion = document.getElementsByClassName("columnaDevolucion");

var columnaModelo = document.getElementsByClassName("columnaModelo");
var columnaAnio = document.getElementsByClassName("columnaAnio");
var columnaClienteNombre = document.getElementsByClassName("columnaClienteNombre");

function fila(elem){
    var id = $(elem).attr('id');
    var tipoModal = $(elem).attr('tipoModal');

    if(tipoModal == "orden"){
        abrirModalOrden(id);
    }
    else if(tipoModal == "auto"){
        abrirModalAuto(id);
    }
    else if(tipoModal == "ingreso"){
        console.log(id);
        // abrirModalIngreso(id);
    }
}

function cargarTabla(nombreTabla){
    var width = $(document).innerWidth();
    if(width < 720){
        var show = false;
    }else{
        var show = true;
    }
    if(nombreTabla == "tableOrdenes"){
        // alert("Entramos a cargarTabla");
        $('#tableOrdenes').DataTable().destroy();
        $('#tableOrdenes_rows').empty();
        // Estado Posicion hidden
        // Estado
        // Auto 
        // Modelo hidden
        // Llegada
        // Problema
        // Devolucion
        // Solucion hidden
        
        var tablaOrdenes = $('#tableOrdenes').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ ordenes",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningúna orden cargada",
                "sInfo":           "Mostrando ordenes del _START_ al _END_ de un total de _TOTAL_ ordenes",
                "sInfoEmpty":      "Mostrando ordenes del 0 al 0 de un total de 0 ordenes",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ ordenes)",
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
            order: [[0, 'asc']],
            columnDefs: [
                {targets: 0, visible:false},
                {targets: 1, sClass:"columnaEstado", orderData: [0,4,7]},
                {targets: 2, sClass:"columnaPatente", orderData: [2,0,4]},
                {targets: 3, visible:false},
                {targets: 4, sClass:"columnaLlegada"},
                {targets: 5, sClass:"columnaProblema"},
                {targets: 6, orderData: [7,0,4]},
                {targets: 7, visible:false},
                {targets: 8, sClass:"columnaDevolucion"},
                {targets: 9, visible:false}
            ],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        // var tablaOrdenes = $('#tableOrdenes').DataTable();
        var ordenesSeleccionadas = seleccionarOrdenes();
        ordenesSeleccionadas.done(function(responseOrdenes) {
            if(responseOrdenes != "error"){
                var ordenes = JSON.parse(responseOrdenes);
                for(var i = 0; i < ordenes.length; i++){
                    var estadoPosicion = posicionEstado(ordenes[i].estado); //hidden
                    var estado = setBotonEstado(ordenes[i].id, ordenes[i].estado);
                    var patente = ordenes[i].patente;
                    var modelo_orden = ordenes[i].modelo + " Nro orden " + ordenes[i].id; //hidden

                    var pagado = '<i class="fa-regular fa-circle-check text-success h3"></i>';
                    var pago_sort = 1;
                    // if(ordenes[i].pago < traerCobroRecibo(ordenes[i].id)){
                    if(ordenes[i].pago < ordenes[i].cobro || ordenes[i].cobro == 0){
                        pagado = '<i class="fa-regular fa-circle-xmark text-danger h3"></i>';
                        pago_sort = 0;
                    }
                    
                    var fechaOrdenable = ordenes[i].fecha_recibido.split("/");
                    var llegada = '<span style="display: none;">'+fechaOrdenable[2]+fechaOrdenable[1]+fechaOrdenable[0]+'</span>'+ordenes[i].fecha_recibido;
                    var problema = ordenes[i].problema;
                    var entrega = ordenes[i].fecha_devolucion;
                    var solucion = ordenes[i].solucion; //hidden

                    var tr = tablaOrdenes.row.add([estadoPosicion, estado, patente, modelo_orden, llegada, problema, pagado, pago_sort, entrega, solucion]).draw().node();
                    tr.id = ordenes[i].id;
                    $(tr).addClass('fila');
                    tr.setAttribute("tipoModal", "orden");
                    tr.setAttribute("onclick", "fila(this)");   
                }
            }
            for(var i=0; i<columnaEstado.length; i++) {
                columnaEstado[i].setAttribute("style", "max-width: 170px;");
                columnaPatente[i].setAttribute("style", "max-width: 100px;");
                columnaLlegada[i].setAttribute("style", "max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
                columnaProblema[i].setAttribute("style", "max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
                columnaDevolucion[i].setAttribute("style", "max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            }
            $("#tableOrdenes_filter").addClass('text-light float-end mx-2');
            document.getElementById("tableOrdenes_paginate").removeAttribute('class');
            $("#tableOrdenes_paginate").addClass('text-light float-end my-2');
            $("#tableOrdenes_length").addClass('text-light');
            $("#tableOrdenes_info").addClass('text-light');
        });
        var autoBuscado = sessionStorage.getItem('autoBuscado');
        // alert(autoBuscado);
        if(autoBuscado){
            // alert(autoBuscado);
            // var table = $('#tableOrdenes').DataTable();
            tablaOrdenes.search(autoBuscado).draw(true);
            sessionStorage.setItem('autoBuscado', "");
        }
        else {
            var ordenBuscada = sessionStorage.getItem('ordenBuscada');
            if(ordenBuscada){
                tablaOrdenes.search(ordenBuscada).draw(true);
                sessionStorage.setItem('ordenBuscada', "");
            }
        }
    }
    else if(nombreTabla == "tableAuto"){
        $('#tableAuto').DataTable().destroy();
        $('#tableAuto_rows').empty();
        // Estado Posicion hidden
        // Estado
        // Auto 
        // Modelo hidden
        // Llegada
        // Problema
        // Devolucion
        // Solucion hidden
        
        $('#tableAuto').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ autos",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún auto cargado",
                "sInfo":           "Mostrando autos del _START_ al _END_ de un total de _TOTAL_ autos",
                "sInfoEmpty":      "Mostrando autos del 0 al 0 de un total de 0 autos",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ autos)",
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
                {targets: 0, sClass:"columnaPatente"},
                {targets: 1, sClass:"columnaModelo"},
                {targets: 2, sClass:"columnaAnio"},
                {targets: 3, sClass:"columnaClienteNombre"},
                {targets: 4, visible:false} //hidden telefono
            ],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        var tablaAutos = $('#tableAuto').DataTable();
        var autosSeleccionadas = seleccionarAutos();
        autosSeleccionadas.done(function(responseAutos) {
            if(responseAutos != "error"){
                var autos = JSON.parse(responseAutos);
                for(var i = 0; i < autos.length; i++){
                    var patente = autos[i].patente;
                    var modelo = autos[i].modelo;
                    var anio = autos[i].anio;
                    var nombre = autos[i].nombre;
                    var telefono = autos[i].telefono; //hidden
                    
                    var tr = tablaAutos.row.add([patente, modelo, anio, nombre, telefono]).draw().node();
                    tr.id = autos[i].id;
                    $(tr).addClass('fila');
                    tr.setAttribute("tipoModal", "auto");
                    tr.setAttribute("onclick", "fila(this)");   
                }
            }
            for(var i=0; i<columnaPatente.length; i++) {
                columnaPatente[i].setAttribute("style", "max-width: 150px;");
                // columnaModelo[i].setAttribute("style", "max-width: 160px;");
                columnaAnio[i].setAttribute("style", "max-width: 100px;");
                // columnaClienteNombre[i].setAttribute("style", "max-width: 160px;");
            }
            $("#tableAuto_filter").addClass('text-light float-end mx-2');
            document.getElementById("tableAuto_paginate").removeAttribute('class');
            $("#tableAuto_paginate").addClass('text-light float-end my-2');
            $("#tableAuto_length").addClass('text-light  mx-1');
            $("#tableAuto_info").addClass('text-light mx-1');
        });

    }
    else if(nombreTabla == "tableFinanzas"){
        $('#tableFinanzas').DataTable().destroy();
        $('#tableFinanzas_rows').empty();
        
        $('#tableFinanzas').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ ingresos",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún ingreso registrado",
                "sInfo":           "Mostrando ingresos del _START_ al _END_ de un total de _TOTAL_ ingresos",
                "sInfoEmpty":      "Mostrando ingresos del 0 al 0 de un total de 0 ingresos",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ ingresos)",
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
            order: [[1, 'des']],
            columnDefs: [
                {targets: 0},
                {targets: 1, visible:false},
                {targets: 2, orderData: [1,1]},
                {targets: 3}
            ],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        var tablaFinanzas = $('#tableFinanzas').DataTable();
        var manosObraSeleccionadas = seleccionarManosObra();
        manosObraSeleccionadas.done(function(response) {
            if(response != "error"){
                const manosObras = JSON.parse(response);
                const ingresos = obtenerIngresos(manosObras);
                for(let anio in ingresos){
                    for(let mes_nro in ingresos[anio]){
                        let mes = meses[mes_nro];
                        let mes_sort = anio + "-" + meses_numero[mes_nro];
                        let ingreso = "$" + ingresos[anio][mes_nro];
                        
                        var tr = tablaFinanzas.row.add([anio, mes_sort, mes, ingreso]).draw().node();
                        tr.id = mes_sort;
                        
                        $(tr).addClass('fila');
                        tr.setAttribute("tipoModal", "ingreso");
                        tr.setAttribute("onclick", "abrirModalIngresos("+mes_nro+", "+anio+")"); 
                    }
                }
            }
            $("#tableFinanzas_filter").addClass('text-light float-end mx-2');
            document.getElementById("tableFinanzas_paginate").removeAttribute('class');
            $("#tableFinanzas_paginate").addClass('text-light float-end my-2');
            $("#tableFinanzas_length").addClass('text-light  mx-1');
            $("#tableFinanzas_info").addClass('text-light mx-1');
        });
    }
}

function posicionEstado(estado){
    switch(estado){
        case 1: //Pendiente
            return 2;
        case 2: //Cancelado
            return 5;
        case 3: //Finalizado
            return 1;
        case 4: //Entregado
            return 4;
        case 5: //Pendiente de pago
            return 0;
        default: //Estado incorrecto
            return -1;
    }

    // 1 FINALIZADO
    // 2 PENDIENTE
    // 3 ENTREGADO
    // 4 CANCELADO
    // -1 INCORRECTO

}

function seleccionarOrdenes(){
    var action = 'seleccionarOrdenes';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}

function setBotonEstado(id, estado){
    var clase_btn_estado = "";
    var estado_str = "";
    var iconoBtn = "";
    if(estado == 1){
        clase_btn_estado = "text-bg-danger";
        estado_str = "Pendiente";
        iconoBtn = '<i class="fa-solid fa-screwdriver-wrench fa-flip-horizontal"></i> <i class="fa-solid"> '+estado_str+'</i> <i class="fa-solid fa-screwdriver-wrench"></i>';
    }
    else if(estado == 2){
        clase_btn_estado = "text-bg-secondary";
        estado_str = "Cancelado";
        iconoBtn = '<i class="fa-solid fa-rectangle-xmark"> '+estado_str+' </i> <i class="fa-solid fa-rectangle-xmark"></i>';
    }
    else if(estado == 3){
        clase_btn_estado = "text-bg-warning";
        estado_str = "Finalizado";
        iconoBtn = '<i class="fa-solid fa-car-on"> '+estado_str+' </i> <i class="fa-solid fa-car-on"></i>';
    }
    else if(estado == 4){
        clase_btn_estado = "text-bg-success";
        estado_str = "Entregado";
        iconoBtn = '<i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> '+estado_str+' </i> <i class="fa-solid fa-car-burst"> </i>';
    }
    else if(estado == 5){
        clase_btn_estado = "text-bg-danger text-dark";
        estado_str = "Falta pagar";  
        iconoBtn = '<i class="fa-solid fa-hand-holding-dollar fa-flip-horizontal"> </i> <i class="fa-solid"> '+estado_str+' </i> <i class="fa-solid fa-hand-holding-dollar"></i>';
    }
    var boton = "<button id='"+id+"' tipoModal='orden' class='btn btn-sm btn-outline-dark btnOrden "+clase_btn_estado+"' style='width: 170px;'>";
    boton += iconoBtn;
    boton += "</button>";

    return boton;
}

function seleccionarAutos(){
    var action = 'seleccionarAutos';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}

function setFormatTabla(tabla, blanco){
    document.getElementById(""+tabla+"_paginate").removeAttribute('class');
    $("#"+tabla+"_filter").addClass('float-end mx-2');
    $("#"+tabla+"_paginate").addClass('float-end my-2');
    $("#"+tabla+"_length").addClass('mx-1');
    $("#"+tabla+"_info").addClass('mx-1');
    if(blanco){
        $("#"+tabla+"_filter").addClass('text-light');
        $("#"+tabla+"_paginate").addClass('text-light');
        $("#"+tabla+"_length").addClass('text-light');
        $("#"+tabla+"_info").addClass('text-light');
    }
}

function seleccionarManosObra(){
    var action = 'obtenerManosObra';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}

function obtenerIngresos(manosObras){
    var ingresos = {};
    for(var i=0; i<manosObras.length; i++){
        if(manosObras[i].fecha_devolucion){
            const fecha = new Date(manosObras[i].fecha_devolucion);
            const anio = fecha.getFullYear();
            const mes_sort = fecha.getMonth();
            const ingreso = manosObras[i].precio;
            if(!ingresos[anio]){
                ingresos[anio] = {};
            }
            if(ingresos[anio][mes_sort]){
                ingresos[anio][mes_sort] += ingreso;
            }
            else{
                ingresos[anio][mes_sort] = ingreso;
            }
        }
    }
    return ingresos;
}