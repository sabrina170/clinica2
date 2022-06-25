<?php
include("controlador/conexion.php");
$ide_historia = $_GET['His'];
$nombre_paciente = base64_decode($_GET['pac']);
$consulta_ventas = "SELECT * FROM pacientes WHERE cod_receta = '$ide_historia'";
$consulta_evolucion = "SELECT * FROM evolucion WHERE cod_receta = '$ide_historia'";
$resultado = mysqli_query($cn, $consulta_ventas);

if($resultado){
    
    while ($data = mysqli_fetch_assoc($resultado)) {
        $sintomas = json_decode($data['sintomas'], true);
        $fecha = $data['create_at'];
        $codigo_receta = $data['cod_receta'];
    }
    
    $resultado_evo = mysqli_query($cn, $consulta_evolucion);
    
}else{
    
}


?>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 p-sm-0 pt-0">
                    <div class="card-body pt-0">
                        <h1 class="text-white">Registro de Historia</h1>
                        <div id="panel-dashboard" class="mt-24">
                            <form id="regiration_form">
     
                                <fieldset>
                                    <h3 class="text-white">Evolución del paciente : <?php echo $nombre_paciente; ?></h3>
                                    <hr>
                                    <div class="row">
                                        
                                        <div class="col-lg-12 bg-white br-16 cnt-shw p-48 mb-20">
                                            <div class="row">
                                                <div class="col-lg-12 mb-24"><h3 style="color: #336a65;">Fecha de registro: <?php echo $fecha?></h3></div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Síntomas frecuentes</h3>
                                                <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group row">
                                                                <?php foreach($sintomas as $key => $value){
                                                                    
                                                                    if($key == 10){
                                                                        break;
                                                                    }else{ 
                                                                    if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                                    
                                                                    ?>

                                                                <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>            

                                                                <?php
                                                        }
                                                                    }
                                                                ?>
                                                                <?php }?>
                                                                
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_sin'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_sin']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Psiquis</h3>
                                                <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group row">
                                                                <?php foreach(array_slice($sintomas, 9, 11) as $key => $value){
                                                                    if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                                ?>

                                                                <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>            

                                                                <?php }
                                                                }?>
                                                                
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_psi'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_psi']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Neurología</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 20, 9) as $key => $value){
                                                        if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php                                                         
                                                            } 
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_neu'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_neu']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Osteomioarticular</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 29, 6) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php 
                                                        }
                                                        
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_ost'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_ost']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Digestivo</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 35, 8) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_dig'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_dig']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Cardiopulmonar/Circulatorio</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 43, 6) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_car'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_car']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Génito-urinario</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 49, 7) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_uri'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_uri']; }?></p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Piel/Tejido celular subcutáneo</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas, 56, 5) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php 
                                                        }
                                                        
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($observacion_sintomas['observaciones']['obser_tej'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $observacion_sintomas['observaciones']['obser_tej']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                        
                                        
                                        <?php while ($data_evo = mysqli_fetch_assoc($resultado_evo)) { 
                                            $sintomas_evo = json_decode($data_evo['detalle_evolucion'], true);
                                            $obs_sintomas_evo = json_decode($data_evo['observacion_sintomas'], true);
                                            $fecha_evo = $data_evo['create_at'];
                                            
                                        ?>
                                        
                                        <div class="col-lg-12 bg-white br-16 cnt-shw p-48 mb-20">
                                            <div class="row">
                                                <div class="col-lg-12 mb-24"><h3 style="color: #336a65;">Fecha de registro: <?php echo $fecha_evo?></h3></div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Síntomas frecuentes</h3>
                                                <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group row">
                                                                <?php foreach($sintomas_evo as $key => $value){
                                                                    
                                                                    if($key == 10){
                                                                        break;
                                                                    }else{ 
                                                                    if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                                    
                                                                    ?>

                                                                <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>            

                                                                <?php
                                                        }
                                                                    }
                                                                ?>
                                                                <?php }?>
                                                                
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_sin'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_sin']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Psiquis</h3>
                                                <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="form-group row">
                                                                <?php foreach(array_slice($sintomas_evo, 9, 11) as $key => $value){
                                                                    if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                                ?>

                                                                <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>            

                                                                <?php }
                                                                }?>
                                                                
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_psi'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_psi']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 border-right">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Neurología</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 20, 9) as $key => $value){
                                                        if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php                                                         
                                                            } 
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_neu'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_neu']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Osteomioarticular</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 29, 6) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php 
                                                        }
                                                        
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_ost'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_ost']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Digestivo</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 35, 8) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_dig'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_dig']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Cardiopulmonar/Circulatorio</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 43, 6) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_car'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_car']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 border-right mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Génito-urinario</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 49, 7) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php
                                                        }
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_uri'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_uri']; }?></p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 mt-20">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Piel/Tejido celular subcutáneo</h3>
                                                <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group row">
                                                        <?php foreach(array_slice($sintomas_evo, 56, 5) as $key => $value){
                                                            if($value['value'] == 0){
                                                            echo "";
                                                        }else{
                                                        ?>

                                                        <label type="text" class=" col-sm-7 col-form-label"><p><?php echo $value['nombre']; ?></p></label>

                                                        <div class="col-sm-5">
                                                            <p><?php echo $value['value']; ?></p>
                                                        </div>            

                                                        <?php 
                                                        }
                                                        
                                                        }?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <p><?php if($obs_sintomas_evo['observaciones']['obser_tej'] == ""){
                                                        echo "Sin observaciones";}
                                                        else{
                                                        echo $obs_sintomas_evo['observaciones']['obser_tej']; }?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                        
                                        <?php }?>
                                    </div>
                                    
                                    <div class="text-center mt-24 mb-24">
                                        <a href="#" id="nueva_evolucion" class="btn btn-primary">Agregar una nueva evolución</a>
                                    </div>
                                    
                                    <div style="display:none;" id="add_evolucion">
                                    <div class="row">
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Síntomas frecuentes</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'sintomas frecuentes'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label type="text" class=" col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>

                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_sin" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Psiquis</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'psiquis'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_psi" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Neurología</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'neurologia'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_neu" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Osteomioarticular</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'osteomioarticular'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_oste" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Digestivo</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'digestivo'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_dig" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Cardiopulmonar/Circulatorio</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'cardiopulmonar'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_car" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Génito-urinario</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'urinario'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_uri" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                            <div class="">
                                                <h3 class="" style="margin-bottom:30px;">Piel/Tejido celular subcutáneo</h3>
                                                <div class="row">
                                                    <?php
                                                    $consulta1 = "SELECT * FROM sistomas where categoria = 'tejido'";
                                                    $resultado1 = mysqli_query($cn, $consulta1);
                                                    while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                    ?>
                                                        <div class="col-lg-6">

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                <div class="col-sm-5">
                                                                    <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                        <option value="0">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4">Observaciones</h5>
                                                        <textarea rows="6" id="obser_tej" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center mt-24">
                                        <a href="#" id="agregar_evolucion" class="btn btn-success">Agregar Evolución</a>
                                    </div>
                                    </div>
                                    
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/script.js"></script>
<script>



    var Observaciones_sintomas = {}
    var Detalles_sintomas = {}
    
    $('#nueva_evolucion').on('click', function(e){
        e.preventDefault();
        $('#add_evolucion').toggle();
    });

    $('#agregar_evolucion').on('click', function() {

        // --------------SINTOMAS---------------------------
        orden_temp_sin_obs = {};
        var obser_sin = $('#obser_sin').val();
        var obser_psi = $('#obser_psi').val();
        var obser_neu = $('#obser_neu').val();
        var obser_ost = $('#obser_oste').val();
        var obser_dig = $('#obser_dig').val();
        var obser_car = $('#obser_car').val();
        var obser_uri = $('#obser_uri').val();
        var obser_tej = $('#obser_tej').val();
        
         orden_temp_sin_obs['obser_sin'] = obser_sin;
         orden_temp_sin_obs['obser_psi'] = obser_psi;
         orden_temp_sin_obs['obser_neu'] = obser_neu;
         orden_temp_sin_obs['obser_ost'] = obser_ost;
         orden_temp_sin_obs['obser_dig'] = obser_dig;
         orden_temp_sin_obs['obser_car'] = obser_car;
         orden_temp_sin_obs['obser_uri'] = obser_uri;
         orden_temp_sin_obs['obser_tej'] = obser_tej;

         Observaciones_sintomas['observaciones'] = orden_temp_sin_obs;
         
         var observaciones_sintomas = JSON.stringify(Observaciones_sintomas);

        $('.sinto').each(function() {
            orden_temp_sin = {};
            var val_sin = $(this).val();
            var nombre_sin = $(this).data('name');
            var id_sin = $(this).data('id');
            // console.log(val_sin);
            console.log(nombre_sin);
            orden_temp_sin['nombre'] = nombre_sin;
            orden_temp_sin['value'] = val_sin;
            Detalles_sintomas[id_sin] = orden_temp_sin;
        });
        var detalles_datos_sin = JSON.stringify(Detalles_sintomas);
        
        // --------------SINTOMAS------------------------

        $.ajax({
            type: "POST",
            url: "controlador/acciones.php",
            data: {

                accion: "AgregarEvolucion",
                cod_receta: '<?php echo $ide_historia; ?>',
                observaciones_sin: observaciones_sintomas,
                detalle_sin: detalles_datos_sin
            },
            success: function(data) {
                //alert(data);
                console.log(data);

                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Evolucion registrada',
                        text: 'Se inserto correctamente'
                    }).then(function() {

                        window.location.href = "page-agregar-receta.php?pac=<?php echo $codigo_receta;?>";
                         //location.reload();

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo registrar la evolución',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }

                return false;
            }
        });
        return false;
    });
</script>