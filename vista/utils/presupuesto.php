<?php
    $total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    
    <!-- <link rel="stylesheet" href="../../css/style.css" /> -->
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a0e4ca76a9.js" crossorigin="anonymous"></script>
    
    <title>Presupuesto</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <img src="../../img/logo-min.png" class="mx-auto my-auto"  alt="Logo Nestor Rey Mecanica">
            </div>
            <div class="col-6 text-center">
            <small><small>
                <p><b>Nestor Rey Mecanica</b></p>
                <p>Juncal 4849, Monte Chingolo</p>
                <p>Telefono: +54 9 11 3179-7334</p>
            </small></small>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-bg-primary pt-0 pb-0 text-center">
                        Presupuesto
                    </div>
            <small><small>
                    <div class="card-body pt-0">
                        Nro. Presupuesto: <b><?php echo $presupuesto['id'] ?></b>
                        <div class="row">
                            <div class="col">
                                Fecha: <b><?php echo $presupuesto['fecha'] ?></b>
                            </div>
                            <div class="col">
                                Hora: <b><?php echo $presupuesto['hora'] ?></b>
                            </div>
                        </div>
                        Vto Presupuesto: <b><?php echo $fechaVto ?></b>
                    </div>
            </small></small>
                </div>
            </div>
        </div>
    </div>
    <!-- DATOS DEL CLIENTE -->
    <div class="card mb-3" style="height: 140px;">
        <div class="card-header text-bg-primary text-center">
            Cliente
        </div>
        <div class="card-body">
            <small><small>
            <form>
                <div class="mb-3 row">
                    <label class="col-2 col-form-label text-center"><b>Nombre:</b></label>
                    <div class="col-3">
                    <?php echo $presupuesto['nombre']; ?>
                    </div>
                    <label class="col-2 col-form-label text-center"><b>Mail:</b></label>
                    <div class="col-5">
                    <?php echo $presupuesto['mail']; ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-2 col-form-label text-center"><b>Telefono:</b></label>
                    <div class="col-3">
                    <?php echo $presupuesto['telefono']; ?>
                    </div>
                    <label class="col-2 col-form-label text-center"><b>Domicilio:</b></label>
                    <div class="col-5">
                    <?php echo $presupuesto['domicilio']; ?>
                    </div>
                </div>
            </form>
            </small></small>
        </div>
    </div>

    <div class="text-muted text-center mb-3">
        Presupuesto valido hasta <b><?php echo $fechaVto ?></b>
    </div>

    <table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablePresupuesto" width=100% >
        <thead>
            <tr class="text-bg-primary">
                <th scope="col">
                    Descripcion
                </th>
                <th scope="col">
                    Cantidad
                </th>
                <th scope="col">
                    Precio
                </th>
                <th scope="col">
                    Precio total
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($insumos as $key => $insumo){
            ?>
            <tr>
                <td> <!-- Descripcion -->
                    <?php echo $insumo["descripcion"]; ?>
                </td>
                <td> <!-- Cantidad -->
                    <?php echo $insumo["cantidad"]; ?>
                </td>
                <td> <!-- Precio -->
                    <?php echo $insumo["precio"]; ?>
                </td>
                <td> <!-- Precio total -->
                    <?php echo $insumo["precio_total"]; ?>
                </td>
            </tr>
            <?php
                    $total += $insumo["precio_total"];
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="table-active text-start">TOTAL</th>
                <th><?php echo $total; ?></th>
            </tr>

        </tfoot>

    </table>
    <div class="d-grid gap-2 mx-3 py-3 d-md-flex justify-content-md-end">
        <button type="button" class="btn btn-primary btn_print" onclick="this.style.display = 'none';window.print();this.style.display = 'initial';return false;">Imprimir</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
