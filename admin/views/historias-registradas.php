<?php

include("controlador/conexion.php");


if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];
    $consulta_ventas = "SELECT * FROM pacientes WHERE cod_receta LIKE '%$busqueda%'";
    $resultado = mysqli_query($cn, $consulta_ventas);
} else {
    $consulta_ventas = "SELECT * FROM pacientes";
    $resultado = mysqli_query($cn, $consulta_ventas);
}
?>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 p-sm-8 pt-0">
                    <div class="card-body p-0">
                        <div id="panel-dashboard">
                            <div id="view-categorias" class="view-tab">
                                <h2 class="text-white">Historias Clínicas registradas</h2>
                                <br>
                                <form action="" method="get">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <input type="text" name="busqueda" class="form-control" id="inputPassword" placeholder="Buscar paciente">
                                        </div>
                                        <button type="submit" name="enviar" class="btn btn-primary mb-2 col-sm-1">Buscar</button>
                                        <button type="submit" name="" class="btn btn-success mb-2 col-sm-1 ml-12">Mostrar Todos</button>
                                    </div>
                                </form>

                                <div class="row">

                                    <?php
                                    if (!$resultado) {
                                        echo "Fallo al realizar la consulta";
                                    } else {

                                        while ($data = mysqli_fetch_assoc($resultado)) {
                                            $datos_per = json_decode($data['datos_personales'], true);

                                            foreach ($datos_per as $dat) {
                                                $edad = $dat['edad_pa'];
                                            }
                                    ?>
                                            <div class="col-sm-2">
                                                <div class="card">
                                                    <img class="card-img-top mt-20" src="<?php echo $data['galeria'] ?>" width="50" height="170" style="object-fit: cover; max-width: 125px; max-height: 125px; border-radius: 50%; margin: auto;" alt="...">
                                                    <!-- <img class="card-img-top" height="30%" style="border-radius:50%; object-fit:cover;"> -->
                                                    <div class="card-body text-center">
                                                        <h4 class="card-title text-primary"><strong> <?php echo $data['cod_receta'] ?></strong></h4>

                                                        <h3 class="card-title"><?php echo $data['pac_nombre'] . ' ' . $data['pac_apellido'] ?></h3>
                                                        <p class="card-text"><?php echo $edad; ?> AÑOS</p>
                                                        <h4 class="card-title">Última evaluación: </h4>

                                                        <!-- <strong><?php echo $data['create_at'] ?></strong> -->
                                                        <?php
                                                        $cod = $data['cod_receta'];
                                                        $consulta_evo = "SELECT * FROM evolucion where cod_receta='$cod' ORDER BY id_evolucion desc limit 1";
                                                        $resultado_evo = mysqli_query($cn, $consulta_evo);
                                                        if (mysqli_num_rows($resultado_evo) < 1) {
                                                            echo 'Aún no realizo evaluación';
                                                        } else {
                                                            while ($evo = mysqli_fetch_assoc($resultado_evo)) {
                                                                echo '<h3><span class="badge badge-pill badge-primary">' . $evo['create_at'] . '</span> </h3>';
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    codigo_tienda = $('#code_tienda').text();

    listarcategoria();
</script>