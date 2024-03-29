const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));

const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
const meses_numero = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

const tabla_data = document.getElementsByClassName("tabla_data");

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

const alertLoading = Swal.mixin({
    allowOutsideClick: false,
    showConfirmButton: false,
    showCancelButton: false,
    showCloseButton: false,
    html:
    '<div class="text-center">' +
        '<div class="spinner-border row" style="width: 5rem; height: 5rem;" role="status">' +
            '<span class="visually-hidden">Cargando...</span>' +
        '</div>' +
        '<div>' +
            '<h3>Cargando</h3>' +
            '<div class="spinner-grow spinner-grow-sm" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '<div class="spinner-grow spinner-grow-sm" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '<div class="spinner-grow spinner-grow-sm" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
        '</div>' +
    '</div>',
    timer: 500,
});

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
    var show;
    if(width < 720){
        show = false;
    }else{
        show = true;
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
        var tablaOrdenes = $('#tableOrdenes').DataTable({
            searchPanes: {
                layout: 'auto',
                cascadePanes: true,
                dtOpts: {
                    paging: true,
                    pagingType: 'numbers',
                    searching: true,
                    // searching: false,
                    // info: true
                }
            },
            dom:
            '<"text-light" P>' +
            '<"col-lg-3 col-1" B>' +
            '<"row"' +
                '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                '<"col-md-6 col-sm-12 text-light" f>' +
                '<"col-12" t>' +
                '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                '<"col-md-6 col-sm-12 text-light" p>' +
            '>',
            buttons:[
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     text: '<i class="fa-regular fa-file-pdf"></i>',
                //     titleAttr: 'Exportar a PDF',
                //     className: 'btn btn-lg btn-danger mb-2',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'print',
                //     text: '<i class="fa-solid fa-print"></i>',
                //     titleAttr: 'Imprimir',
                //     className: 'btn btn-info mb-2',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // }
            ],
            processing: true,
            "language": {
                "loadingRecords": "&nbsp;",
                "processing": "Procesando...",
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
                },
                searchPanes: {
                    title: {
                        _: 'Filtros seleccionados - %d',
                    },
                    collapseMessage : "Minimizar filtros",
                    showMessage: "Mostrar filtros",
                    clearMessage: "Limpiar filtros",
                    emptyPanes: ""
                }
            },
            order: [[0, 'asc'], [7, 'asc'], [4, 'asc']],
            columnDefs: [
                {
                    searchPanes: {
                        show: true,
                        initCollapsed: true,
                    },
                    targets: [1, 2, 7]
                },
                // Estado Orden
                // Estado
                // Auto
                // Modelo
                // Llegada_sort
                // Llegada
                // Problema
                // Pago
                // Pago_sort
                // Entrega_sort
                // Entrega
                { className: "dt-head-center", targets: "_all" },
                {targets: 0, title: 'Estado Orden', visible:false},
                {targets: 1, title: 'Estado', sClass:"columnaEstado", orderData: [0,7,4]},
                {targets: 2, title: 'Auto', sClass:"columnaPatenteOrden", orderData: [2,0,4]},
                {targets: 3, title: 'Modelo', visible:false},
                {targets: 4, title: 'Llegada_sort', visible:false},
                {targets: 5, title: 'Llegada', sClass:"columnaLlegada", orderData: [4]},
                {targets: 6, title: 'Problema', sClass:"columnaProblema"},
                {targets: 7, title: 'Pago', sClass:"columnaPago", orderData: [7,0,4]},
                {targets: 8, title: 'Pago_sort', visible:false},
                {targets: 9, title: 'Entrega_sort', visible:false},
                {targets: 10, title: 'Entrega', sClass:"columnaDevolucion", orderData: [9]}
            ],
            responsive: false,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ],
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

                    // var llegada = '<span style="display: none;">'+fechaOrdenable[2]+fechaOrdenable[1]+fechaOrdenable[0]+'</span>'+ordenes[i].fecha_recibido;
                    var pagado = '<span style="display: none;">SI</span> <i class="fa-regular fa-circle-check text-success h3"></i>';
                    var pago_sort = 1;
                    // if(ordenes[i].pago < traerCobroRecibo(ordenes[i].id)){
                    if(ordenes[i].pago < ordenes[i].cobro || ordenes[i].cobro == 0){
                        pagado = '<span style="display: none;">NO</span> <i class="fa-regular fa-circle-xmark text-danger h3"></i>';
                        pago_sort = 0;
                    }

                    var tr = tablaOrdenes.row.add([estadoPosicion, estado, patente, modelo_orden, ordenes[i].fecha_recibido_sort, ordenes[i].fecha_recibido, ordenes[i].problema, pagado, pago_sort, ordenes[i].fecha_devolucion_sort, ordenes[i].fecha_devolucion]).draw().node();
                    tr.id = ordenes[i].id;
                    $(tr).addClass('fila');
                    tr.setAttribute("tipoModal", "orden");
                    tr.setAttribute("onclick", "fila(this)");   
                }
            }
            // 18
            // 11
            // 10
            // 45
            // 6
            // 10
            for (var i = 0; i < tabla_data.length; i++) {
                var element = tabla_data[i];
                element.style.display = "";
            }
            // document.getElementById("tableOrdenes")
            document.getElementById("loading_tab").style.display = "none";          

            // for(var i=0; i<columnaEstado.length; i++) {
            //     columnaEstado[i].setAttribute("style", "width: 200px;");
            //     columnaPatenteOrden[i].setAttribute("style", "width: 100px;");
            //     columnaLlegada[i].setAttribute("style", "width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaProblema[i].setAttribute("style", "max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaDevolucion[i].setAttribute("style", "width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            // }
            // for(var i=0; i<columnaEstado.length; i++) {
            //     columnaEstado[i].setAttribute("style", "width: 18%;");
            //     columnaPatenteOrden[i].setAttribute("style", "width: 11%;");
            //     columnaLlegada[i].setAttribute("style", "width: 10%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaProblema[i].setAttribute("style", "width: 45%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaDevolucion[i].setAttribute("style", "width: 10%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            // }
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
    if(nombreTabla == "tablaOrdenesHistoricas"){
        // alert("Entramos a cargarTabla");
        $('#tablaOrdenesHistoricas').DataTable().destroy();
        $('#tablaOrdenesHistoricas_rows').empty();
        // Estado Posicion hidden
        // Estado
        // Auto 
        // Modelo hidden
        // Llegada
        // Problema
        // Devolucion
        var tablaOrdenesHistoricas = $('#tablaOrdenesHistoricas').DataTable({
            // searchPanes: {
            //     layout: 'auto',
            //     cascadePanes: true,
            //     dtOpts: {
            //         paging: true,
            //         pagingType: 'numbers',
            //         searching: true,
            //         // searching: false,
            //         // info: true
            //     }
            // },
            dom:
            // '<"text-light" P>' +
            '<"row  justify-content-center text-center"' +
                '<"col-lg-3 col-1" B>' +
            '>' +
            '<"row"' +
                '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                '<"col-md-6 col-sm-12 text-light" f>' +
                '<"col-12" t>' +
                '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                '<"col-md-6 col-sm-12 text-light" p>' +
            '>',
            buttons:[
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     text: '<i class="fa-regular fa-file-pdf"></i>',
                //     titleAttr: 'Exportar a PDF',
                //     className: 'btn btn-lg btn-danger mb-2',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'print',
                //     text: '<i class="fa-solid fa-print"></i>',
                //     titleAttr: 'Imprimir',
                //     className: 'btn btn-info mb-2',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // }
            ],
            processing: true,
            "language": {
                "loadingRecords": "&nbsp;",
                "processing": "Procesando...",
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
                },
                searchPanes: {
                    title: {
                        _: 'Filtros seleccionados - %d',
                    },
                    collapseMessage : "Minimizar filtros",
                    showMessage: "Mostrar filtros",
                    clearMessage: "Limpiar filtros",
                    emptyPanes: ""
                }
            },
            order: [[0, 'asc'], [7, 'asc'], [4, 'asc']],
            columnDefs: [
                // {
                //     searchPanes: {
                //         show: true,
                //         initCollapsed: true,
                //     },
                //     targets: [3]
                // },
                // Estado Orden
                // Estado
                // Auto
                // Modelo
                // Llegada_sort
                // Llegada
                // Problema
                // Pago
                // Pago_sort
                // Entrega_sort
                // Entrega
                { className: "dt-head-center", targets: "_all" },
                {targets: 0, title: 'Estado Orden', visible:false},
                {targets: 1, title: 'Estado', sClass:"columnaEstado", orderData: [0,7,4]},
                {targets: 2, title: 'Auto', sClass:"columnaPatenteOrden", orderData: [2,0,4]},
                {targets: 3, title: 'Modelo', visible:false},
                {targets: 4, title: 'Llegada_sort', visible:false},
                {targets: 5, title: 'Llegada', sClass:"columnaLlegada", orderData: [4]},
                {targets: 6, title: 'Problema', sClass:"columnaProblema"},
                {targets: 7, title: 'Pago', sClass:"columnaPago", orderData: [7,0,4]},
                {targets: 8, title: 'Pago_sort', visible:false},
                {targets: 9, title: 'Entrega_sort', visible:false},
                {targets: 10, title: 'Entrega', sClass:"columnaDevolucion", orderData: [9]}
            ],
            responsive: false,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ],
        });
        // var tablaOrdenesHistoricas = $('#tablaOrdenesHistoricas').DataTable();
        var ordenesSeleccionadas = seleccionarOrdenesHistoricas();
        ordenesSeleccionadas.done(function(responseOrdenes) {
            if(responseOrdenes != "error"){
                var ordenes = JSON.parse(responseOrdenes);
                for(var i = 0; i < ordenes.length; i++){
                    var estadoPosicion = posicionEstado(ordenes[i].estado); //hidden
                    var estado = setBotonEstado(ordenes[i].id, ordenes[i].estado);
                    var patente = ordenes[i].patente;
                    var modelo_orden = ordenes[i].modelo + " Nro orden " + ordenes[i].id; //hidden

                    // var llegada = '<span style="display: none;">'+fechaOrdenable[2]+fechaOrdenable[1]+fechaOrdenable[0]+'</span>'+ordenes[i].fecha_recibido;
                    var pagado = '<span style="display: none;">SI</span> <i class="fa-regular fa-circle-check text-success h3"></i>';
                    var pago_sort = 1;
                    // if(ordenes[i].pago < traerCobroRecibo(ordenes[i].id)){
                    if(ordenes[i].pago < ordenes[i].cobro || ordenes[i].cobro == 0){
                        pagado = '<span style="display: none;">NO</span> <i class="fa-regular fa-circle-xmark text-danger h3"></i>';
                        pago_sort = 0;
                    }

                    var tr = tablaOrdenesHistoricas.row.add([estadoPosicion, estado, patente, modelo_orden, ordenes[i].fecha_recibido_sort, ordenes[i].fecha_recibido, ordenes[i].problema, pagado, pago_sort, ordenes[i].fecha_devolucion_sort, ordenes[i].fecha_devolucion]).draw().node();
                    tr.id = ordenes[i].id;
                    $(tr).addClass('fila');
                    tr.setAttribute("tipoModal", "orden");
                    tr.setAttribute("onclick", "fila(this)");   
                }
            }
            // 18
            // 11
            // 10
            // 45
            // 6
            // 10
            for (var i = 0; i < tabla_data.length; i++) {
                var element = tabla_data[i];
                element.style.display = "";
            }
            // document.getElementById("tablaOrdenesHistoricas")
            document.getElementById("loading_tab").style.display = "none";          

            // for(var i=0; i<columnaEstado.length; i++) {
            //     columnaEstado[i].setAttribute("style", "width: 200px;");
            //     columnaPatenteOrden[i].setAttribute("style", "width: 100px;");
            //     columnaLlegada[i].setAttribute("style", "width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaProblema[i].setAttribute("style", "max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaDevolucion[i].setAttribute("style", "width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            // }
            // for(var i=0; i<columnaEstado.length; i++) {
            //     columnaEstado[i].setAttribute("style", "width: 18%;");
            //     columnaPatenteOrden[i].setAttribute("style", "width: 11%;");
            //     columnaLlegada[i].setAttribute("style", "width: 10%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaProblema[i].setAttribute("style", "width: 45%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            //     columnaDevolucion[i].setAttribute("style", "width: 10%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;");
            // }
        });
        var autoBuscado = sessionStorage.getItem('autoBuscado');
        // alert(autoBuscado);
        if(autoBuscado){
            // alert(autoBuscado);
            // var table = $('#tableOrdenes').DataTable();
            tablaOrdenesHistoricas.search(autoBuscado).draw(true);
            sessionStorage.setItem('autoBuscado', "");
        }
        else {
            var ordenBuscada = sessionStorage.getItem('ordenBuscada');
            if(ordenBuscada){
                tablaOrdenesHistoricas.search(ordenBuscada).draw(true);
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
        
        $('#tableAuto').DataTable({
            // searchPanes: {
            //     cascadePanes: true,
            //     dtOpts: {
            //         paging: true,
            //         pagingType: 'numbers',
            //         searching: true,
            //     }
            // },
            dom:
            // '<"text-light" P>' +
            '<"col-lg-3 col-1" B>' +
            '<"row"' +
                '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                '<"col-md-6 col-sm-12 text-light" f>' +
                '<"col-12" t>' +
                '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                '<"col-md-6 col-sm-12 text-light" p>' +
            '>',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
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
                },
                // searchPanes: {
                //     title: {
                //         _: 'Filtros seleccionados - %d',
                //     },
                //     collapseMessage : "Minimizar filtros",
                //     showMessage: "Mostrar filtros",
                //     clearMessage: "Limpiar filtros",
                //     emptyPanes: ""
                // }
            },
            order: [[1, 'asc']],
            columnDefs: [
                // {
                //     searchPanes: {
                //         show: true,
                //         initCollapsed: true,
                //     },
                //     targets: [1, 3]
                // },
                { className: "dt-head-center", targets: "_all" },
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
            // for(var i=0; i<columnaPatente.length; i++) {
            //     columnaPatente[i].setAttribute("style", "max-width: 150px;");
            //     // columnaModelo[i].setAttribute("style", "max-width: 160px;");
            //     columnaAnio[i].setAttribute("style", "max-width: 100px;");
            //     // columnaClienteNombre[i].setAttribute("style", "max-width: 160px;");
            // }
        });

    }
    else if(nombreTabla == "tableFinanzas"){
        $('#tableFinanzas').DataTable().destroy();
        $('#tableFinanzas_rows').empty();
        
        $('#tableFinanzas').DataTable({
            searchPanes: {
                cascadePanes: true,
                dtOpts: {
                    paging: true,
                    pagingType: 'numbers',
                    searching: true,
                }
            },
            dom:
                '<"text-light" P>' +
                '<"col-lg-3 col-1" B>' +
                '<"row"' +
                    '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                    '<"col-md-6 col-sm-12 text-light" f>' +
                    '<"col-12" t>' +
                    '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                    '<"col-md-6 col-sm-12 text-light" p>' +
                '>',
            buttons:[
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
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
                },
                searchPanes: {
                    title: {
                        _: 'Filtros seleccionados - %d',
                    },
                    collapseMessage : "Minimizar filtros",
                    showMessage: "Mostrar filtros",
                    clearMessage: "Limpiar filtros",
                    emptyPanes: ""
                }
            },
            order: [[1, 'des']],
            columnDefs: [
                {
                    searchPanes: {
                        show: true,
                        initCollapsed: true,
                    },
                    targets: [0,2]
                },
                { className: "dt-head-center", targets: "_all" },
                {targets: 0},
                {targets: 1, visible:false},
                {targets: 2, orderData: [0,1]},
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
        });
    }
    else if(nombreTabla == "tablePendientes"){
        $('#tablePendientes').DataTable().destroy();
        $('#tablePendientes_rows').empty();
        
        $('#tablePendientes').DataTable({
            searchPanes: {
                cascadePanes: true,
                dtOpts: {
                    paging: true,
                    pagingType: 'numbers',
                    searching: true,
                }
            },
            dom: 
                '<"text-light" P>' +
                '<"col-lg-3 col-1" B>' +
                '<"row"' +
                    '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                    '<"col-md-6 col-sm-12 text-light" f>' +
                    '<"col-12" t>' +
                    '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                    '<"col-md-6 col-sm-12 text-light" p>' +
                '>',
            buttons:[
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ pendientes",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún pendiente registrado",
                "sInfo":           "Mostrando pendientes del _START_ al _END_ de un total de _TOTAL_ pendientes",
                "sInfoEmpty":      "Mostrando pendientes del 0 al 0 de un total de 0 pendientes",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ pendientes)",
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
                },
                searchPanes: {
                    title: {
                        _: 'Filtros seleccionados - %d',
                    },
                    collapseMessage : "Minimizar filtros",
                    showMessage: "Mostrar filtros",
                    clearMessage: "Limpiar filtros",
                    emptyPanes: ""
                }
            },
            order: [[1, 'des']],
            columnDefs: [
                {
                    searchPanes: {
                        show: true,
                        initCollapsed: true,
                    },
                    targets: [0,2]
                },
                { className: "dt-head-center", targets: "_all" },
                {targets: 0},
                {targets: 1, visible:false},
                {targets: 2, orderData: [0,1]},
                {targets: 3}
            ],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        var tablePendientes = $('#tablePendientes').DataTable();
        var ordenesSeleccionadas = seleccionarOrdenesPendiente();
        ordenesSeleccionadas.done(function(response) {
            if(response != "error"){
                const ordenes = JSON.parse(response);
                const pendientes = obtenerPendientes(ordenes);
                for(var anio in pendientes){
                    for(var mes_nro in pendientes[anio]){
                        var mes = meses[mes_nro];
                        var mes_sort = anio + "-" + meses_numero[mes_nro];
                        var pendiente = "$" + pendientes[anio][mes_nro]["pendiente"];
                        var pago = "$" + pendientes[anio][mes_nro]["pago"];
                        
                        var tr = tablePendientes.row.add([anio, mes_sort, mes, pendiente, pago]).draw().node();
                        tr.id = mes_sort;
                        
                        $(tr).addClass('fila');
                        tr.setAttribute("tipoModal", "pendientes");
                        tr.setAttribute("onclick", "abrirModalPendientes("+mes_nro+", "+anio+")"); 
                    }
                }
            }
        });
    }
    else if (nombreTabla == "tablaServicios") {
        $('#tablaServicios').DataTable().destroy();
        $('#tablaServicios_rows').empty();
        
        var fecha = document.getElementById("fecha");
        var date = new Date();
        fecha.value = date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate();

        
        $('#tablaServicios').DataTable({
            dom: 
                '<"col-lg-3 col-1" B>' +
                '<"row"' +
                    '<"col-md-6 col-sm-12 text-light mb-2" l>' +
                    '<"col-md-6 col-sm-12 text-light" f>' +
                    '<"col-12" t>' +
                    '<"col-md-6 col-sm-12 mb-2 text-light" i>' +
                    '<"col-md-6 col-sm-12 text-light" p>' +
                '>',
            buttons:[
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-regular fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-lg btn-success mb-2',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ servicios",
                "sZeroRecords":    "No se encontraron servicios",
                "sEmptyTable":     "Ningún servicio registrado",
                "sInfo":           "Mostrando servicios del _START_ al _END_ de un total de _TOTAL_ servicios",
                "sInfoEmpty":      "Mostrando servicios del 0 al 0 de un total de 0 servicios",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ servicios)",
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
                { className: "dt-head-center", targets: "_all" },
                {targets: 0},
                {targets: 1},
                {targets: 2, visible: false},
                {targets: 3, orderData: [2,0]},
                {targets: 4}
            ],
            responsive: true,
            autoWidth: false,
            
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Todos'],
            ]
        });
        var tablaServicios = $('#tablaServicios').DataTable();
        // var tr = tablaServicios.row.add(["Frenos", "$10.000,00", "20/12/2022", "BOTONES"]).draw().node();
        // console.log(tr);
        // var tr = tablaServicios.row.add(["Filtros", "$15.000,00", "01/12/2022", "BOTONES"]).draw().node();
        // console.log(tr);
        // var tr = tablaServicios.row.add(["Motor", "$50.000,00", "21/11/2022", "BOTONES"]).draw().node();
        // console.log(tr);
        var serviciosSeleccionados = seleccionarServicios();
        serviciosSeleccionados.done(function (response) {
            if(response != "error"){
                const servicios = JSON.parse(response);
                for (var i = 0; i < servicios.length; i++) {
                    var accion = "<div class='text-center mx-auto'>";
                        accion += '<a href="#" class="text-primary mx-2" onclick="editServicio(\'' + servicios[i].id + '\', \'recibo\')">';
                            accion += '<i class="fa-solid fa-pen-to-square"></i>';
                        accion += '</a>';
                        accion += '<a href="#" class="text-danger mx-2" onclick="eliminarServicio(\''+ servicios[i].id + '\')">';
                            accion += '<i class="fa-solid fa-trash-can"></i>';
                        accion += '</a>';
                    accion += '</div>';

                    var tr = tablaServicios.row.add([servicios[i].descripcion, parseFloat(servicios[i].precio).toFixed(2), servicios[i].fecha, servicios[i].fecha_input, accion]).draw().node();
                    tr.id = "servicio-" + servicios[i].id;
                }
            }
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

function seleccionarOrdenesHistoricas(){
    var action = 'seleccionarOrdenesHistoricas';

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
        iconoBtn = '<i class="fa-solid fa-screwdriver-wrench fa-flip-horizontal"></i> <i class="fa-solid"> PEN </i>';
    }
    else if(estado == 2){
        clase_btn_estado = "text-bg-secondary";
        estado_str = "Cancelado";
        iconoBtn = '<i class="fa-solid fa-rectangle-xmark"> CAN </i>';
    }
    else if(estado == 3){
        clase_btn_estado = "text-bg-warning";
        estado_str = "Finalizado";
        iconoBtn = '<i class="fa-solid fa-car-on"> FIN </i>';
    }
    else if(estado == 4){
        clase_btn_estado = "text-bg-success";
        estado_str = "Entregado";
        iconoBtn = '<i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> ENT </i>';
    }
    else if(estado == 5){
        clase_btn_estado = "text-bg-danger text-dark";
        estado_str = "Falta pagar";  
        iconoBtn = '<i class="fa-solid fa-hand-holding-dollar fa-flip-horizontal"> </i> <i class="fa-solid"> F.P. </i>';
    }
    var boton = "<button id='"+id+"' tipoModal='orden' class='btn btn-sm btn-outline-dark btnOrden "+clase_btn_estado+"' data-toggle='tooltip' title='"+estado_str+"'>";
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
function obtenerPendientes(ordenes){
    var ingresos = {};
    for(var i=0; i<ordenes.length; i++){
        if(ordenes[i].pago < ordenes[i].cobro) {
            if(ordenes[i].fecha){
                const fecha = new Date(ordenes[i].fecha);
                const anio = fecha.getFullYear();
                const mes_sort = fecha.getMonth();
                const pendiente = ordenes[i].cobro;
                const pago = ordenes[i].pago;
                if(!ingresos[anio]){
                    ingresos[anio] = {};
                }
                if(ingresos[anio][mes_sort]){
                    ingresos[anio][mes_sort]["pendiente"] += pendiente;
                    ingresos[anio][mes_sort]["pago"] += pago;
                }
                else{
                    ingresos[anio][mes_sort] = {};
                    ingresos[anio][mes_sort]["pendiente"] = pendiente;
                    ingresos[anio][mes_sort]["pago"] = pago;
                }
            }
        }
    }
    return ingresos;
}

function seleccionarOrdenesPendiente(){
    var action = 'seleccionarOrdenesPendiente';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action:action}
    });
}


async function verificarPatente(patenteInput){
    $(autoPatente).removeClass('is-invalid').removeClass('is-valid');

    if(!patenteInput){
        return;
    }

    var patente = checkPatente(patenteInput);

    if(!patente) {
        $(autoPatente).addClass('is-invalid');
        document.getElementById("errorPatente").innerHTML = "Patente invalida";
        return;
    }
    
    if (btn_auto_modal.getAttribute('accion') == "agregarAuto") {
        if (await verificarPatenteDuplicada(patenteInput)) {
            // PATENTE DUPLICADA
            $(autoPatente).addClass('is-invalid');
            document.getElementById("errorPatente").innerHTML = "Patente duplicada";
            return;
        }
    }

    $(autoPatente).addClass('is-valid');
    // var action = 'verificarMarca';

    // $.ajax({
    //     type: "POST",
    //     url: "ajax.php",
    //     async: false,
    //     data: { action:action, marcaAuto:marcaAuto},
    //     success: function(response) {
    //         if (response != "error") {
    //             var marca = JSON.parse(response);
    //             autoPatente.addClass('is-valid');
    //         }
    //         else{
    //             autoPatente.addClass('is-invalid');
    //         }
    //     },
    //     error: function(error) {
    //         autoPatente.addClass('is-invalid');
    //     }
    // });
}

async function verificarPatenteDuplicada(patente) {
    try {
        if (patente && patente.length) {
            return await PromiseVerificarPatenteDuplicada(patente);
        }
        else {
            return false;
        }
    } catch (error) {
        console.error("Error fetching remote HTML: ", error);
        alertError.fire("Error fetching remote HTML: " + error);
        return false;
    }  
}

function PromiseVerificarPatenteDuplicada(patente){
    return new Promise(function (resolve, reject) {
        var formData = new FormData();
        formData.append("action", "verificarPatenteDuplicada");
        formData.append("patente", patente);

        var xhttp = new XMLHttpRequest();

        // Set POST method and ajax file path
        xhttp.open("POST", "ajax.php", true);

        xhttp.onload  = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText) {
                    var response = JSON.parse(this.responseText);
                    if (!response["error"]) {
                        resolve(response["success"]);
                    }
                    else{
                        reject(response["error"]);
                    }
                }
                else {
                    reject(this.responseText);
                }
            }
            else {
                reject(this.status);
            }
        };
        
        // Send request with data
        xhttp.send(formData);
    });
}

function checkPatente(patente){
    patente = patente.toUpperCase();
    var patentePlana;
    const regex_vieja = /^[a-zA-Z]{3}([-]|\s)?[0-9]{3}$/g;
    const regex_nueva = /^[a-zA-Z]{2}([-]|\s)?[0-9]{3}([-]|\s)?[a-zA-Z]{2}$/g;
    if(regex_vieja.test(patente)){
        if(patente.length == 6){
            patentePlana = patente;
        }
        else{ 
            patentePlana = patente.substring(0,3) + patente.substring(4,7);
        }
    }
    else if(regex_nueva.test(patente)){
        if(patente.length == 7){
            patentePlana = patente;
        }
        else{
            const letras = /[a-zA-Z]{2}/;
            const numeros = /[0-9]{3}/;
            var resultado;
            resultado = letras.exec(patente);
            patentePlana = resultado[0];
            resultado = numeros.exec(patente.slice(resultado.index));
            patentePlana += resultado[0];
            resultado = letras.exec(patente.slice(resultado.index));
            patentePlana += resultado[0];
        }
    }
    else {
        return;
    }
    return patentePlana;
}

function seleccionarServicios() {
    var action = 'seleccionarServicios';

    return $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: { action: action }
    });
}