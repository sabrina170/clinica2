
<?php 
$tipoenvio = "";
if(isset($_GET['tipoenvio'])){
    $tipoenvio = $_GET['tipoenvio'];
}


if ($tipoenvio == ""){
    $tipoenvio = 1;
}
$descTipoEnvio = "";
if($tipoenvio == 1){
    $descTipoEnvio = "Distritales";
} else {
    $descTipoEnvio = "Nacionales";
}

include("controlador/conexion.php");

$consulta = "SELECT id_enviocosto, nombre_lugar, costo FROM envio_costo WHERE tipo_envio = $tipoenvio and eliminado != 1";
$consulta_envios = "SELECT envios FROM tienda";
$resultado = mysqli_query($cn, $consulta);

$resultado_envios = mysqli_query($cn, $consulta_envios);

while( $row_envio = mysqli_fetch_assoc($resultado_envios)){
    
    $estado_envios = json_encode($row_envio['envios']);
    $envios = json_decode($row_envio['envios'], true);
    


}

$envioscostos = array();
while( $row = mysqli_fetch_assoc($resultado)){
    $id=$row['id_enviocosto'];
    $nombre=$row['nombre_lugar'];			
    $costo=$row['costo'];

    $envioscostos[] = array('id_enviocosto'=> $id, 'nombre_lugar'=> $nombre, 'costo' => $costo);
}			

$arrayLugares = array();
if($tipoenvio == 1){
    $arrayLugares[] = array('idlugar'=> 'Ancon', 'nombrelugar'=> 'Ancón');
    $arrayLugares[] = array('idlugar'=> 'Ate Vitarte', 'nombrelugar'=> 'Ate Vitarte');
    $arrayLugares[] = array('idlugar'=> 'Barranco', 'nombrelugar'=> 'Barranco');
    $arrayLugares[] = array('idlugar'=> 'Brena', 'nombrelugar'=> 'Breña');
    $arrayLugares[] = array('idlugar'=> 'Carabayllo', 'nombrelugar'=> 'Carabayllo');
    $arrayLugares[] = array('idlugar'=> 'Chaclacayo', 'nombrelugar'=> 'Chaclacayo');
    $arrayLugares[] = array('idlugar'=> 'Chorrillos', 'nombrelugar'=> 'Chorrillos');
    $arrayLugares[] = array('idlugar'=> 'Cieneguilla', 'nombrelugar'=> 'Cieneguilla');
    $arrayLugares[] = array('idlugar'=> 'Comas', 'nombrelugar'=> 'Comas');
    $arrayLugares[] = array('idlugar'=> 'El Agustino', 'nombrelugar'=> 'El Agustino');
    $arrayLugares[] = array('idlugar'=> 'Independencia', 'nombrelugar'=> 'Independencia');
    $arrayLugares[] = array('idlugar'=> 'Jesus Maria', 'nombrelugar'=> 'Jesús María');
    $arrayLugares[] = array('idlugar'=> 'La Molina', 'nombrelugar'=> 'La Molina');
    $arrayLugares[] = array('idlugar'=> 'La Victoria', 'nombrelugar'=> 'La Victoria');
    $arrayLugares[] = array('idlugar'=> 'Lima', 'nombrelugar'=> 'Lima');
    $arrayLugares[] = array('idlugar'=> 'Lince', 'nombrelugar'=> 'Lince');
    $arrayLugares[] = array('idlugar'=> 'Los Olivos', 'nombrelugar'=> 'Los Olivos');
    $arrayLugares[] = array('idlugar'=> 'Lurigancho', 'nombrelugar'=> 'Lurigancho');
    $arrayLugares[] = array('idlugar'=> 'Lurin', 'nombrelugar'=> 'Lurín');
    $arrayLugares[] = array('idlugar'=> 'Magdalena del Mar', 'nombrelugar'=> 'Magdalena del Mar');
    $arrayLugares[] = array('idlugar'=> 'Miraflores', 'nombrelugar'=> 'Miraflores');
    $arrayLugares[] = array('idlugar'=> 'Pachacamac', 'nombrelugar'=> 'Pachacamac');
    $arrayLugares[] = array('idlugar'=> 'Pucusana', 'nombrelugar'=> 'Pucusana');
    $arrayLugares[] = array('idlugar'=> 'Pueblo Libre', 'nombrelugar'=> 'Pueblo Libre');
    $arrayLugares[] = array('idlugar'=> 'Puente Piedra', 'nombrelugar'=> 'Puente Piedra');
    $arrayLugares[] = array('idlugar'=> 'Punta Hermosa', 'nombrelugar'=> 'Punta Hermosa');
    $arrayLugares[] = array('idlugar'=> 'Punta Negra', 'nombrelugar'=> 'Punta Negra');
    $arrayLugares[] = array('idlugar'=> 'Rimac', 'nombrelugar'=> 'Rímac');
    $arrayLugares[] = array('idlugar'=> 'San Bartolo', 'nombrelugar'=> 'San Bartolo');
    $arrayLugares[] = array('idlugar'=> 'San Borja', 'nombrelugar'=> 'San Borja');
    $arrayLugares[] = array('idlugar'=> 'San Isidro', 'nombrelugar'=> 'San Isidro');
    $arrayLugares[] = array('idlugar'=> 'San Juan de Lurigancho', 'nombrelugar'=> 'San Juan de Lurigancho');
    $arrayLugares[] = array('idlugar'=> 'San Juan de Miraflores', 'nombrelugar'=> 'San Juan de Miraflores');
    $arrayLugares[] = array('idlugar'=> 'San Luis', 'nombrelugar'=> 'San Luis');
    $arrayLugares[] = array('idlugar'=> 'San Martín de Porres', 'nombrelugar'=> 'San Martín de Porres');
    $arrayLugares[] = array('idlugar'=> 'San Miguel', 'nombrelugar'=> 'San Miguel');
    $arrayLugares[] = array('idlugar'=> 'Santa Anita', 'nombrelugar'=> 'Santa Anita');
    $arrayLugares[] = array('idlugar'=> 'Santa María del Mar', 'nombrelugar'=> 'Santa María del Mar');
    $arrayLugares[] = array('idlugar'=> 'Santa Rosa', 'nombrelugar'=> 'Santa Rosa');
    $arrayLugares[] = array('idlugar'=> 'Santiago de Surco', 'nombrelugar'=> 'Santiago de Surco');
    $arrayLugares[] = array('idlugar'=> 'Surquillo', 'nombrelugar'=> 'Surquillo');
    $arrayLugares[] = array('idlugar'=> 'Villa El Salvador', 'nombrelugar'=> 'Villa El Salvador');
    $arrayLugares[] = array('idlugar'=> 'Villa María del Triunfo', 'nombrelugar'=> 'Villa María del Triunfo');
    
}else{
    $arrayLugares[] = array('idlugar'=> 'Amazonas', 'nombrelugar'=> 'Amazonas');
    $arrayLugares[] = array('idlugar'=> 'Ancash', 'nombrelugar'=> 'Ancash');
    $arrayLugares[] = array('idlugar'=> 'Apurimac', 'nombrelugar'=> 'Apurimac');
    $arrayLugares[] = array('idlugar'=> 'Arequipa', 'nombrelugar'=> 'Arequipa');
    $arrayLugares[] = array('idlugar'=> 'Ayacucho', 'nombrelugar'=> 'Ayacucho');
    $arrayLugares[] = array('idlugar'=> 'Cajamarca', 'nombrelugar'=> 'Cajamarca');
    $arrayLugares[] = array('idlugar'=> 'Callao', 'nombrelugar'=> 'Callao');
    $arrayLugares[] = array('idlugar'=> 'Cusco', 'nombrelugar'=> 'Cusco');
    $arrayLugares[] = array('idlugar'=> 'Huancavelica', 'nombrelugar'=> 'Huancavelica');
    $arrayLugares[] = array('idlugar'=> 'Huanuco', 'nombrelugar'=> 'Huanuco');
    $arrayLugares[] = array('idlugar'=> 'Ica', 'nombrelugar'=> 'Ica');
    $arrayLugares[] = array('idlugar'=> 'Junin', 'nombrelugar'=> 'Junín');
    $arrayLugares[] = array('idlugar'=> 'La Libertad', 'nombrelugar'=> 'La Libertad');
    $arrayLugares[] = array('idlugar'=> 'Lambayeque', 'nombrelugar'=> 'Lambayeque');
    $arrayLugares[] = array('idlugar'=> 'Loreto', 'nombrelugar'=> 'Loreto');
    $arrayLugares[] = array('idlugar'=> 'Madre de Dios', 'nombrelugar'=> 'Madre de Dios');
    $arrayLugares[] = array('idlugar'=> 'Moquegua', 'nombrelugar'=> 'Moquegua');
    $arrayLugares[] = array('idlugar'=> 'Pasco', 'nombrelugar'=> 'Pasco');
    $arrayLugares[] = array('idlugar'=> 'Piura', 'nombrelugar'=> 'Piura');
    $arrayLugares[] = array('idlugar'=> 'Puno', 'nombrelugar'=> 'Puno');
    $arrayLugares[] = array('idlugar'=> 'San Martín', 'nombrelugar'=> 'San Martín');
    $arrayLugares[] = array('idlugar'=> 'Tacna', 'nombrelugar'=> 'Tacna');
    $arrayLugares[] = array('idlugar'=> 'Tumbes', 'nombrelugar'=> 'Tumbes');
    $arrayLugares[] = array('idlugar'=> 'Ucayali', 'nombrelugar'=> 'Ucayali');
}	

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent">
                    <div class="card-body p-44">
                    <div id="panel-dashboard">
                        <div id="view-enviocosto" class="view-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2>Administrar Envios <?php echo $descTipoEnvio ?></h2>
                                    
                                </div> 
                                
                                <div class="col-lg-6 text-right">
                                    <h3><a href="page-envios-costo.php?tipoenvio=1">Envios Distritales</a> / <a href="page-envios-costo.php?tipoenvio=2">Envios Nacionales</a></h3>  
                                </div> 
                            </div> 
                            <div class="row mt-16">
                                <div class="form-inline">
                                    <label class="sr-only" for="sel_lugar">Lugar</label>                                    
                                    <select name="sel_lugar" id="sel_lugar" class="form-control mb-2 mr-sm-2">
                                        <option value="">Seleccione el lugar</option>
                                        <?php 
                                            foreach ($arrayLugares as $data) {
                                                echo '<option value="'.$data['idlugar'].'">'.$data['nombrelugar'].'</option>';
                                            }
                                        ?>
                                    </select>      

                                    <label class="sr-only" for="txt_Costo">Costo</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">S/.</div>
                                        </div>
                                        <input type="number" class="form-control" id="txt_Costo" placeholder="10.00">
                                    </div>
                                    <a href="javascript:void(0);" class="btn t-active mb-2" id="btnAgregarEnvioCosto"><i class="fas fa-plus"></i> Agregar</a>                                    
                                </div>   
                                
                                <div class="col-lg-6">
                                    
                                    <label class="switchBtn">
                                                    <input type="checkbox" class="switch_envio" data-accion="activar_envio_<?php echo $descTipoEnvio; ?>" <?php if ($envios["activar_envio_$descTipoEnvio"] == 1) {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>
                                                
                                                
                                                <label class="switchBtn">
                                                    <input type="checkbox" class="switch_envio" data-accion="activar_gratis_<?php echo $descTipoEnvio; ?>" <?php if ($envios["activar_gratis_$descTipoEnvio"] == 1) {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>GRATIS</span></div>
                                                </label>
                                                
                                                
                                </div>
                            </div> 
                            <div class="cnt-t-table mt-20">
                            <table id="td_envioscosto" class="t-table" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Costo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ctn-modal-edit-enviocosto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-enviocosto" style="">
                <h2>Actualizar Envio-Costo</h2>                
                <form id="frm_edit_enviocosto">                    
                    <input type="hidden" name="code_enviocostoedit" id="code_enviocostoedit">
                    <label class="sr-only" for="sel_lugar_edit">lugar</label>                                    
                    <select name="sel_lugar_edit" id="sel_lugar_edit" class="form-control mb-2 mr-sm-2">
                        <option value="">Seleccione el lugar</option>
                        <?php 
                            foreach ($arrayLugares as $data) {
                                echo '<option value="'.$data['idlugar'].'">'.$data['nombrelugar'].'</option>';
                            }
                        ?>
                    </select>      

                    <label class="sr-only" for="txt_Costo_edit">Costo</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">S/.</div>
                        </div>
                        <input type="number" class="form-control" id="txt_Costo_edit" placeholder="10.00">
                    </div>                    
                </form>
                <button id="upd-enviocosto" class="btn btn-success btn-confirm m-t-15">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true" id="cancel-upd-enviocosto">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>

var estado_envios = JSON.parse(<?php echo $estado_envios; ?>);

console.log(estado_envios);

    codigo_tienda = $('#code_tienda').text();
    initEnviosCosto();
    var idioma_espanol = 
    {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

    var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

        jQuery.noConflict();
        $('#modal-eliminar').remove();
        $('body').append('<div class="modal fade t-modal" tabindex="-1" role="dialog" id="modal-eliminar"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"><div class="modal-content bg-transparent border-0"><div class="modal-body"><div class="modal-delete text-center"><form id="' + frm + '"><h2>DESEA CONFIRMAR ESTA ACCIÓN?</h2> <button class="btn btn-success confirm btn-confirm mr-12" id="' + id_confirmacion + '">Confirmar</button> <button data-dismiss="modal" class=" btn btn-danger close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"> <input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div></div></div></div>');

        $('#modal-eliminar').modal();
        return false;
    }

    function initEnviosCosto() {
        var table = $('#td_envioscosto').DataTable({
            "destroy": true,
            "data":<?php echo json_encode($envioscostos); ?>,
            "columns": [

                {
                    "data": "nombre_lugar"
                },
                {
                    "data": "costo"
                },

                {
                    "data":"id_enviocosto",
                    "render": function(data, type, full, meta){                        
                        return "<button class='editar btn-edit bg-white font-16 mr-12' data-toggle='modal' data-target='#ctn-modal-edit-enviocosto'><i class='far fa-edit'></i></button> "+
                                "<button class='bg-white font-16  eliminar btn-delete'><i class='far fa-trash-alt'></i></button>";
                    }                    
                }
            ],
            "language": idioma_espanol,
            responsive: true

        });
        Obtener_data_editar_enviocosto('#td_envioscosto tbody', table);
        Agregar();  
        Eliminar('#td_envioscosto tbody', table);
    }
    function Agregar() {
        $("#btnAgregarEnvioCosto").on('click', function(e) {            
            e.preventDefault();
           var lugar = $("#sel_lugar").val();
           var costo = $("#txt_Costo").val();

           var costoCorrecto = parseFloat(costo.replace(",", "."));
           if(lugar == null || lugar == "" || costo == ""){
                Swal.fire({
                    icon: "error",
                    title: "Ocurrio algun error",
                    text: "Debe agregar todos los datos.",
                    button: "Aceptar"
                });
               return false;
           }
           if (!(costoCorrecto >= 0)){
                Swal.fire({
                    icon: "error",
                    title: "Ocurrio algun error",
                    text: "Debe agregar un costo mayor a 0.",
                    button: "Aceptar"
                });
               return false;
           }
           $.ajax({
                type: "POST",
                url: "controlador/crud/envioscosto.php",
                async: "false",
                data: {
                    accion: "AgregarEnvioCosto",
                    tipo_envio: "<?php echo $tipoenvio ?>",
                    nombre_lugar: lugar,
                    costo: costo
                },
                success: function(data) {
                    if(typeof data == "undefined" || data == null){                        
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio algun error",
                            text: "No se obtuvo respuesta.",
                            button: "Aceptar"
                        });
                    }else{
                        var datos = JSON.parse(data);     
                        if (datos.codigo == 1) {                            
                            location.reload();
                        } else {                                   
                            var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                "No se pudo registrar el Envio-Costo.";                            
                            Swal.fire({
                                icon: "error",
                                title: "Ocurrio algun error",
                                text: mensaje,
                                button: "Aceptar"
                            });
                        }
                    }   
                    return false;
                }
            });
        });
    }    
    
    $('.switch_envio').on('change', function(){
        
        var accion = $(this).data("accion");
        //$('.switch_encarte').prop('checked', false);
        //$(this).prop('checked', true);
        
        if($(this).prop('checked')){
            
            estado_envios[accion] = 1;
   
        }else{
            
            estado_envios[accion] = 0;
        }
        
        var acciones_actualizadas = JSON.stringify(estado_envios);
        
        //console.log(acciones_actualizadas);
        
        $.ajax({
                type: "POST",
                url: "controlador/acciones_conf.php",
                data: {
                    accion: "Estado_envios",
                    estados: acciones_actualizadas
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Estado actualizado',
                            text: 'Se activo el encarte correctamente.'
                        }).then(function() {
                            //window.location('page-blog.php')
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo activar el encarte',
                            text: data
                        }).then(function() {
                            //location.reload();
                        });
                    }
                }
            }); 
    });
    

    function CerrarModal() {
        $('.close-tab').on('click', function(e) {
            e.preventDefault();
            $('.cnt-modal').fadeOut();
        });
        return false;
    }

    function Obtener_data_editar_enviocosto(tbody, table) {
        
        $(tbody).on('click', "button.editar", function() {
            var data = table.row($(this).parents("tr")).data();
            $('#sel_lugar_edit').val(data.nombre_lugar);
            $('#txt_Costo_edit').val(data.costo);
            $('#code_enviocostoedit').val(data.id_enviocosto);

            $('#ctn-modal-edit-enviocosto').fadeIn();
            CerrarModal();            

            $('#upd-enviocosto').on('click', function(e) {
                e.preventDefault();
                var lugar = $("#sel_lugar_edit").val();
                var costo = $("#txt_Costo_edit").val();
                var idenviocosto = $("#code_enviocostoedit").val();

                var costoCorrecto = parseFloat(costo.replace(",", "."));
                if(lugar == null || lugar == "" || costo == "" || idenviocosto == ""){
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio algun error",
                            text: "Debe agregar todos los datos.",
                            button: "Aceptar"
                        });
                    return false;
                }
                if (!(costoCorrecto >= 0)){
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio algun error",
                            text: "Debe agregar un costo mayor a 0.",
                            button: "Aceptar"
                        });
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/envioscosto.php",
                    async: "false",                    
                    data: {
                        accion: "EditarEnvioCosto",
                        code_enviocostoedit: idenviocosto,
                        tipo_envio: "<?php echo $tipoenvio ?>",
                        nombre_lugar: lugar,
                        costo: costo
                    },
                    success: function(data) {     
                        $('.cnt-modal').fadeOut();
                        if(typeof data == "undefined" || data == null){
                            Swal.fire({
                                icon: "error",
                                title: "Ocurrio algun error",
                                text: "No se obtuvo respuesta.",
                                button: "Aceptar"
                            });
                        }else{
                            var datos = JSON.parse(data);     
                            if (datos.codigo == 1) {                            
                                location.reload();
                            } else {                                   
                                var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                    "No se pudo actualizar el Envio-Costo.";                                
                                Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: mensaje,
                                        button: "Aceptar"
                            });
                            }
                        }                        
                    }
                });
                return false;
            });
        });
        }

    function Eliminar(tbody, table) {
        $(".eliminar").on('click', function(e) {            
            e.preventDefault();
            
            ModalEliminar('fmr_delete', 'delete_envio_costo', 'EliminarEnvioCosto', 'codigo_enviocosto', 'code_enviocosto');

            var data = table.row($(this).parents("tr")).data();
            $('#code_enviocosto').val(data.id_enviocosto );

            $('#delete_envio_costo').on('click', function(e) {
                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();
                $.ajax({
                    type: "POST",
                    url: "controlador/crud/envioscosto.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        $('.cnt-modal').fadeOut();
                        if(typeof data == "undefined" || data == null){
                            Swal.fire({
                                icon: "error",
                                title: "Ocurrio algun error",
                                text: "No se obtuvo respuesta.",
                                button: "Aceptar"
                            });
                        }else{
                            var datos = JSON.parse(data);     
                            if (datos.codigo == 1) {                            
                                location.reload();
                            } else {                                   
                                var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                    "No se pudo actualizar el Envio-Costo.";                                
                                Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: mensaje,
                                        button: "Aceptar"
                            });
                            }
                        }                       
                    }
                });
            });
        });
    }    
        
        
</script>

