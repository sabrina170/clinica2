
<?php 


if (isset($_GET['estado']) ){
    $estado_producto = $_GET['estado'];
}else {
    $estado_producto = 1;
}


include("controlador/conexion.php");

$consulta = "SELECT prod.id_producto, 
        prod.sku_producto, 
        prod.nombre_producto, 
        prod.descripcion_corta, 
        prod.descripcion_producto, 
        prod.adicional_producto, 
        prod.precio_unitario_producto, 
        prod.precio_oferta_producto, 
        prod.stock_producto, 
        prod.ventas_producto,  
        prod.destacado, 
        prod.estado_producto, 
        prod.id_categoria, 
        prod.id_subcategoria, 
        prod.id_subcategoria_int, 
        prod.promocion_producto,
        prod.fecha_registro, 
        prod.hora_registro,
        img.ruta imagenes_producto
        FROM 
        productos prod
        INNER JOIN prod_imagenes img ON img.id_producto = prod.id_producto
        WHERE estado_producto = '$estado_producto' and img.principal = 1";
$resultado = mysqli_query($cn, $consulta);

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent">
                    <div class="card-body p-44">
                    <div id="panel-dashboard">
                        <div id="view-productos" class="view-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2>Administrar Productos
                                    <a href="page-agregar-producto.php" class="btn t-active ml-20"><i class="fas fa-plus"></i> Agregar producto</a>
                                    <!--<a href="page-excel-prod.php" class="btn btn-success ml-20"><i class="far fa-file-excel"></i> Agregar Planilla Excel</a>-->
                                    <a href="#" class="btn btn-success ml-8 mt-sm-16" data-toggle="modal" data-target="#modal_planilla" ><i class="far fa-file-excel"></i> Agregar Planilla Excel</a>
                                    </h2>
                                    
                                </div> 
                                
                                <div class="col-lg-6 text-right">
                                    <h3><a href="page-productos-neg.php?estado=1">Productos Activos</a> / <a href="page-productos-neg.php?estado=0">Productos Inactivos</a></h3>  
                                </div> 
                            </div> 
                            
                            <div class="cnt-t-table mt-20">
                            <table id="td_productos" class="t-table" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form control sel_all_producto"></th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio Unitario</th>
                                        <th>Precio de Oferta</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
                                        <th>Destacado</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                        if (!$resultado) {
                                            echo "Fallo al realizar la consulta";
                                        } else {                                                
                                                
                                            while ($data = mysqli_fetch_assoc($resultado)) {
                                                if ($data['destacado'] == 1) {
                                                    $destacado =  "<span class='p-4 br-4 slug-warning pl-12 pr-12 font-12'>Destacado</span>";
                                                } else {
                                                    $destacado =  "No";
                                                }

                                                if ($data['promocion_producto'] == "oferta") {
                                                    $promocion =  "<span class='p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12'>Oferta</span>";
                                                    $color_promocion = "#00BCD4";
                                                } else {
                                                    $promocion =  "";
                                                    $color_promocion = "";
                                                };

                                                echo '
                                                <tr class="prod_item" data-ide="' . $data['id_producto'] . '">
                                                <td><input type="checkbox" value="' . $data['id_producto'] . '" class="form control sel_producto"></td>
                                                <td><img src="' . $data['imagenes_producto'] . '" height="50"></td>
                                                <td>
                                                <a href="page-agregar-producto.php?id=', $data['id_producto'] . '" class="text-black">' . $data['nombre_producto'] . '</a>
                                                <p class="font-12 text_price">SKU: ' . $data['sku_producto'] . '</p>
                                                </td>
                                                <td>
                                                <p style="font-weight:700">S/.' . $data['precio_unitario_producto'] . '</p>
                                                
                                                </td>
                                                <td>' . $promocion . '<span  class="text_price">S/.' . $data['precio_oferta_producto'] . '</span></td>
                                                <td>' . $data['id_categoria'] . '</td>
                                                <td>' . $data['id_subcategoria'] . '</td>
                                                <td>' . $destacado . '</td>
                                                <td>' . $data['stock_producto'] . '</td>
                                                <td>
                                                <a href="page-agregar-producto.php?id=', $data['id_producto'] . '" class="btn t-active btn-sm"><i class="far fa-edit"></i></a>
                                                ';
                                                if ($estado_producto == 1){
                                                    echo '<a href="#" class="btn  bg-transparent btn-sm" onclick="DesactivarProd(this);"><i class="far fa-eye-slash"></i></a>';
                                                }
                                                else if ($estado_producto == 0){
                                                
                                                    echo '<a href="#" class="btn bg-transparent btn-sm" onclick="ActivarProd(this);"><i class="far fa-eye"></i></a>';
                                                }
                                                
                                                echo' <a href="#" class="btn bg-transparent btn-sm" onclick="EliminarProd(this);" data-ide='.$data['id_producto'].'><i class="far fa-trash-alt"></i></a>
                                                </td>
                                                </tr>';

                                                    
                                                }
                                            }
                                            ?>
                                </tbody>
                            </table>
                            
                            <?php 
                                    if ($estado_producto == 1){
                                        $accion = "EliminarSeleccionados";
                                        echo '<button class="btn btn-primary" id="action_selected_products">Desactivar elementos seleccionados</button>';
                                    }else if ($estado_producto == 0){
                                        $accion = "ActivarSeleccionados";
                                        echo '<button class="btn btn-primary" id="action_selected_products">Activar elementos seleccionados</button>';
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

<div class="modal fade" id="modal_planilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body pt-36">
        <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <img src="img/icono-excel.webp" width="70">
                                        <p class="mt-24 mb-24">Con esta función se puede realizar cargas masiva de productos mediante un archivo Excel(.csv), puedes descargar un <a class="font-weight-bold" href="../assets/excelprod/FORMATOCARGAPRODUCTOS.csv">modelo aquí</a></p>
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                                            <input class="input-file" id="idExcelProd" type="file" multiple="false" accept=".csv">
                                            <label tabindex="0" id="idtxtExcelProd" for="idExcelProd" 
                                            class="input-file-trigger" id="title-file-input"><i class="far fa-upload"></i> Subir Excel</label>                                        
                                        </div>                                    
                                    </div>
                                    <!--<div class="col-lg-3">
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">                                        
                                            <button type="button" id="add-excelProd" class="btn btn-success btn-guardar float-left btn-confirm-2">
                                            <i class="fal fa-save"></i> Guardar</button>
                                        </div>                                    
                                    </div> -->
                                    <!--<div class="col-lg-3">
                                    <?php $rutaModelo = str_replace('/admin/page-excel-prod.php', '',$_SERVER['SCRIPT_NAME'])
                                            .'/assets/excelprod/FORMATOCARGAPRODUCTOS.csv'; ?> 
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">                                        
                                            <a href="../assets/excelprod/FORMATOCARGAPRODUCTOS.csv" id="download-excelProd" target="_blank"
                                                class="btn btn-info btn-guardar float-left btn-confirm-2">
                                            <i class="fal fa-download"></i> Descargar Modelo</a>
                                        </div>                                    
                                    </div>-->
                                </div>
                                <div class="row">
                                <div id="resp-excel-prod" class="col-lg-12 mt-16"> 

                                </div>
                            </div>
      </div>
      <div class="modal-footer">
            <a type="button" id="add-excelProd" class="btn btn-success btn-guardar btn-confirm-2"><i class="fal fa-save"></i> Subir productos</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
codigo_tienda = $('#code_tienda').text();


listarProducto();


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
    
    
    
let productos_seleccionados = [];

    $('#action_selected_products').on('click', function() {
        productos_seleccionados = [];
        $('.sel_producto:checked').each(function() {
            let ide_prod = $(this).val();
            productos_seleccionados.push(ide_prod);
        });

        ser_productos_seleccionados = JSON.stringify(productos_seleccionados);

        $.ajax({
            type: "POST",
            url: "controlador/crud/productos.php",
            async: "false",
            data: {
                cod_productos: ser_productos_seleccionados,
                accion: '<?php echo $accion; ?>'
            },
            success: function(data) {

                $('.sel_producto:checked').each(function() {
                    let ide_produ = $(this).val();
                    $('.item_prod[data-ide=' + ide_produ + ']').fadeOut();
                    setTimeout(function() {
                        table.row($(this).parents('tr')).remove();
                    }, 200);

                });

                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Cambios realizados',
                        text: 'Se realizaron los cambios correctamente'
                    }).then(function() {
                        location.reload();

                    });


                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'No se pudo eliminar los elementos',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }

                console.log(data);
                return false;
            }
        });
        console.log(productos_seleccionados);
    });


/*---------------------
LISTAR PRODUCTOS
---------------------*/

    function listarProducto() {
        var table = $('#td_productos').DataTable({
            responsive: true
        });
        SeleccionarTodos();
    }
    
      /*---------------------
    ELIMINAR PRODUCTO
    ---------------------*/  
    function EliminarProd(element) {
        var prod_ide = $(element).data('ide');
            
            //alert("eliminar producto");
            ModalEliminar('fmr_delete', 'delete_producto', 'EliminarProducto', 'codigo_producto', 'code_prod');
            var fila_producto = $(element).closest('.prod_item');
            var data = $(element).closest('.prod_item').data("ide");
            var del_code_producto = $('#code_prod').val(data);

            $('#delete_producto').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    data: DataString,
                    success: function(data) {
                        
                        console.log(data);

                        $(fila_producto).fadeOut();
                        setTimeout(function() {
                            $(fila_producto).remove();
                        }, 200);
                        $('#modal-eliminar').modal('hide');

                    }
                });
            });
    }

    function DesactivarProd(element) {
        ModalEliminar('fmr_delete', 'delete_producto', 'DesactivarProducto', 'codigo_producto', 'code_prod');
        var fila_producto = $(element).closest('.prod_item');
        var data = $(element).closest('.prod_item').data("ide");
        var del_code_producto = $('#code_prod').val(data);

        $('#delete_producto').on('click', function(e) {

            e.preventDefault();
            var DataString = $('#fmr_delete').serialize();

            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                async: "false",
                data: DataString,
                success: function(data) {
                    $(fila_producto).fadeOut();
                    setTimeout(function() {
                        $(fila_producto).remove();
                    }, 200);
                    $('#modal-eliminar').modal('hide');

                }
            });
        });
    }

    function ActivarProd(element) {
        ModalEliminar('fmr_delete', 'delete_producto', 'ActivarProducto', 'codigo_producto', 'code_prod');
        var fila_producto = $(element).closest('.prod_item');
        var data = $(element).closest('.prod_item').data("ide");
        var del_code_producto = $('#code_prod').val(data);

        $('#delete_producto').on('click', function(e) {

            e.preventDefault();
            var DataString = $('#fmr_delete').serialize();

            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                async: "false",
                data: DataString,
                success: function(data) {

                    $(fila_producto).fadeOut();
                    setTimeout(function() {
                        $(fila_producto).remove();
                    }, 200);
                    $('#modal-eliminar').modal('hide');

                }
            });
        });    
    }

    function editar_producto(element){
        var data = table.row($(element).parents("tr")).data();
        var ide_producto = data.id_producto;
        window.location = 'page-agregar-producto.php?id=' + ide_producto ;
    }

    /*=============================================
CARGAR CATEGORIA
=============================================*/
function CargarCategorias(combo){

    $.ajax({
                type: "POST",
                url: "controlador/crud/categoria.php",
                async: "false",
                data: {accion: 'ComboCategorias'},
                success:function(data){

                $(combo).append(data);
                return false;
                }
    });

}

$('#gal_pro').on('change', function(e){
        e.preventDefault();
        SubirGaleria($(this).attr('id'));
        });
        
        
        	function SubirGaleria(element){	
	    
	     $("#galeria-propiedades").append("<img id='load-pic' src='img/cargador.gif'>");

		var archivos = document.getElementById(element);//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
		var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
		//Creamos una instancia del Objeto FormDara.
		var archivos = new FormData();
		/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
		Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
		indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
		for(i=0; i<archivo.length; i++){
		archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
		}
 
		/*Ejecutamos la función ajax de jQuery*/		
		$.ajax({
			url:'controlador/galeria.php', //Url a donde la enviaremos
			type:'POST', //Metodo que usaremos
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:archivos, //Le pasamos el objeto que creamos con los archivos
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false,
			beforeSend: function(){
                
            },
			success: function(data){
                $('#load-pic').remove();
			    $("#galeria-propiedades").append(data);
			    
			    EliminarPic();
			}//Para que el formulario no guarde cache
		}).done(function(data){//Escuchamos la respuesta y capturamos el mensaje 
			
		});
	}
	
	function EliminarPic(){
	    $('.delete-pic').on('click', function(){
	        $(this).parent().remove();
	        
	        return false;
	    });
	}
	
	    function SeleccionarTodos(){
        $('.sel_all_producto').on('click',function(e){
            e.stopPropagation();
        $('.sel_producto:visible').not(this).prop('checked', this.checked);
    });
    }
	
	/* AGREGAR PRODUCTO POR PLANILLA */

$('#add-excelProd').on('click', function(e){
        e.preventDefault();
        SubirExcelProd();
    });
    $('#idExcelProd').on('change', function(e) {
        e.preventDefault();
        var archivos = document.getElementById("idExcelProd"); 
        if(archivos.files.length > 0){            
            var nombre = archivos.files[0].name;
            var nombreExt = nombre.substring(nombre.length-3, nombre.length);
            if (nombreExt.toLowerCase() == "csv".toLowerCase()){
                $("#resp-excel-prod").html('');
                $("#idtxtExcelProd").text(nombre);    
            } else {
                archivos.value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Solo debe subir archivos CSV .',
                    button: "Aceptar"
                });
                return false;
            }
        }        
    });

    function SubirExcelProd() {
        $("#resp-excel-prod").html("<img id='load-pdf' src='img/cargador.gif'>");

        var archivosLeer = document.getElementById("idExcelProd");
        var archivo = archivosLeer.files;
        if(archivo == null || archivo.length == 0){
            $("#resp-excel-prod").html("");
            Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Debe cargar un archivo.',
                    button: "Aceptar"
                });
            return false;
        }

        var nombre = archivo[0].name;
        var nombreExt = nombre.substring(nombre.length-3, nombre.length);
            if (nombreExt.toLowerCase() != "csv".toLowerCase()){      
                $("#resp-excel-prod").html("");          
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Solo debe subir archivos CSV .',
                    button: "Aceptar"
                });
                return false;
            }
        
        var archivos = new FormData();
        
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); 
        }
        $.ajax({
            url: 'controlador/uploadexcelprod.php', 
            type: 'POST', 
            data: archivos,
            contentType: false,
            cache: false, 
            processData:false, 
            beforeSend: function() {

            },
            success: function(data) {
                document.getElementById("idExcelProd").value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                $("#resp-excel-prod").html(data);
            },
            error: function(){
                document.getElementById("idExcelProd").value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Error al cargar el archivo.',
                    button: "Aceptar"
                });
            }
        });
    }
	
        
        
</script>

