$(function(){

function ValidarCampos(campo){
    

    var isValid = true;

    $(campo + ":visible").each(function() {
        
        var camp = $(this);
        
            if ($.trim($(this).val()) == '') {

                isValid = false;

                camp.css({

                    "outline": "2px solid indianred",
                    "background": ""
                });
                
                camp.focus();
                
                return false;

            }

            else {

                camp.css({

                    "outline": "2px solid seagreen",
                    "background": ""

                });
            }

        });

        if (isValid == false){

            $('.error_info').css({'background-color': 'indianred'});
            $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
            $('.error_info').fadeIn(1000);
            setTimeout(function(){
                $('.error_info').fadeOut();
            },2500);
            return false;
            

        }else{
        
            $('.error_info').css({'background-color': 'seagreen'});
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn(500);
            
            setTimeout(function(){
                $('.error_info').fadeOut();
            },600);
            
            var DataString = $('#frm_add_producto').serialize();
            //alert(DataString);
$.ajax({
             type: "POST",
             url: "controlador/agregar_producto.php",
             data: DataString,
             success:function(data){
                 //alert(data);
            if(data == "positivo"){
              //alert("Se registro el producto Correctamente.")
              
              $('.txt-frm').val("");
              $('.ob').css({

                    "outline": "0px solid indianred"
                });
                
                $('.cnt-modal').fadeOut();
              ListarProductos();
              
              return false;
            }else{
              alert("No se pudo registrar el producto.")
              return false;
            }
            
             
             }
});
        
        }            
}

// <-- LISTAR PRODUCTOS -->

function ListarProductos(){
    
$('#lista_productos').html("<img src='img/loader.gif' style='margin:25px 0px; margin: auto;'>");
    
$.ajax({
             type: "POST",
             url: "controlador/productos.php",
             async: "false",
             data: {accion: 'ListarProductos'},
             success:function(data){
            $('#lista_productos').html("");
            $('#lista_productos').append(data);

            EliminarProducto();
            ModificarProducto();
             return false;
             
        }
});
}


$('#list-productos').on('click', function(){
  ListarProductos();
});

$('#add-producto').on('click', function(e){
  e.preventDefault();

  ValidarCampos('.ob');
  

  
  
});

// <-- AGREGAR PRODUCTOS -->
/*
$('#add-producto').on('click', function(e){
  e.preventDefault();
$('#img_producto').val($('.img_default').attr('src'));

  var error = $('.error');
  
      if ($('#nom-prod').val() == "") {
          
            error.html("Ingrese un Nombre para el producto");
            error.fadeIn(200);

            $('#nom-prod').focus();
            return false;

        }else if($('#stock-prod').val() == ""){
          error.html("Ingrese una cantidad");
          error.fadeIn(200);
            $('#stock-prod').focus();
            return false;
        }else if($('#precio-prod').val() == ""){
          error.html("Ingrese un precio");
            error.fadeIn(200);
            $('#precio-prod').focus();
            return false;
        }else if($('#list_categorias').val() == ""){
          error.html("Seleccione una categoria");
            error.fadeIn(200);
            $('#list_categorias').focus();
            return false;
        }else if(!$.trim($("#descrip-prod").val())){
          error.html("Ingrese una descripción");
            error.fadeIn(200);
            $('#list_categorias').focus();
            return false;
        }else{

            
            var DataString = $('#frm_add_producto').serialize();

            //alert(DataString);

$.ajax({
             type: "POST",
             url: "modelo/agregar_producto.php",
             data: DataString,
             success:function(data){
            //alert(data);
            if(data == "positivo"){
              alert("Se registro el producto Correctamente.")
              $('.txt-frm').val("");
              return false;
            }else{
              alert("No se pudo registrar el producto.")
              return false;
            }
            
             
             }
});
          
        }
});*/

function ModificarProducto(){

$('.edit_sucursal').on('click', function(){

$('#ctn-modal-edit-product').fadeIn();
$('#code_mod').val($(this).data('code'));
$('.nombre_sucursal').val($subdominio);

var item_prod = $(this).closest('.item-prod');
var id_prod_mod = item_prod.find('.edit_sucursal').data('code');
var img_prod_mod = item_prod.find('.img-prd').attr('src');
var cod_prod_mod = item_prod.find('.cod-prd').text(); //CODIGO DE PRODUCTO
var desc_prod_mod = item_prod.find('.dsc-prd').text();//DESCRIPCION DE PRODUCTO
var stock_prod_mod = item_prod.find('.stk-prd').text();//STOCK DE PRODUCTO
var prec_prod_mod = item_prod.find('.prec-prd').text();//PRECIO DE COMPRA
var prev_prod_mod = item_prod.find('.prev-prd').text();//PRECIO DE VENTA
var cate_prod_mod = item_prod.find('.cat-prd').text();//CATEGORIA DE PRODUCTO


$('#code_mod').val(id_prod_mod);
$('.img_default_mod').attr('src', img_prod_mod);
$('#-cate-prod').val(cate_prod_mod).change();
$('#-cod-prod').val(cod_prod_mod);
$('#-stock-prod').val(stock_prod_mod);
$('#-descrip-prod').val(desc_prod_mod);
$('#-precioc-prod').val(prec_prod_mod);
$('#-preciov-prod').val(prev_prod_mod);


$('#mod-producto').on('click', function(e){

  e.preventDefault();
  $('#-img_producto').val($('.img_default_mod').attr('src'));

    var error = $('.-error');
      if ($('#-cate-prod').val() == "") {
          
            error.html("Seleccione una categoria");
            error.fadeIn(200);

            $('#-cate-prod').focus();
            return false;

        }else if($('#-cod-prod').val() == ""){
          error.html("Ingrese un codigo");
          error.fadeIn(200);
            $('#-cod-prod').focus();
            return false;
        }else if($('#-descrip-prod').val() == ""){
          error.html("Ingrese una descripción");
            error.fadeIn(200);
            $('#-descrip-prod').focus();
            return false;
        }else if($('#-proov-prod').val() == ""){
          error.html("Ingrese un codigo de proveedor");
            error.fadeIn(200);
            return false;
        }
        else if($('#-stock-prod').val() == ""){
          error.html("Ingrese un valor");
            error.fadeIn(200);
             $('#-stock-prod').focus();
            return false;
        }
        else if($('#-precioc-prod').val() == ""){
          error.html("Ingrese un precio");
            error.fadeIn(200);
            $('#-stock-prod').focus();
            return false;
        }
        else if($('#-preciov-prod').val() == ""){
          error.html("Ingrese un codigo de proveedor");
            error.fadeIn(200);
            $('#-preciov-prod').focus();
            return false;
        }else{

            var DataString = $('#frm_edit_producto').serialize();

            //alert(DataString);

$.ajax({
             type: "POST",
             url: "controlador/modificar_producto.php",
             data: DataString,
             success:function(data){
            alert(data);
            ListarProductos();
            $('#ctn-modal-edit-product').fadeOut();

             return false;
             }
});
        }


  return false;
});

$('#upload_img_mod').on('change', function(e){
    e.preventDefault();
    SubirFotos($(this).attr('id'), $('.img_default_mod'));
});


$('#cancel-producto').on('click', function(e){

  e.preventDefault();
  $('#ctn-modal-edit-product').fadeOut();

  return false;
});


});


}

function EliminarProducto(){


$('.delete_prod').on('click', function(){

//alert("Se eliminara el producto");

var code_prod = $(this).data('code');
var item_prod = $(this).closest('.item-prod');
item_prod.css({'background': 'red'});
//alert("Codigo de producto " + code_prod);

$.ajax({
             type: "POST",
             url: "controlador/productos.php",
             async: "false",
             data: {accion: 'EliminarProducto', Codigo_prod: code_prod},
             success:function(data){

              alert(data);

              item_prod.fadeOut();


             }
});
return false;

});


};



function SubirFotos(element, destino){


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
            var sbd_tws = $subdominio;
        archivos.append('sbd_tws', $subdominio);
 
            /*Ejecutamos la función ajax de jQuery*/        
            $.ajax({
                  url:'controlador/upload.php', //Url a donde la enviaremos
                  type:'POST', //Metodo que usaremos
                  contentType:false, //Debe estar en false para que pase el objeto sin procesar
                  data:archivos, //Le pasamos el objeto que creamos con los archivos
                  processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
                  cache:false,
                  beforeSend: function(){
                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                
                MensajeFinal(message);
            },
                  success: function(data){
                      //alert("Imagenes subidas corretcamente");
                      //alert(data);
                      if(data == "")
                        {alert("No se ah seleccionado ninguna imagen");
                      return false;
                        }else{
                         $(destino).attr('src', data);
  
                        }
                      //$(".panel-show-img").append(data);
                      
                  }//Para que el formulario no guarde cache
            }).done(function(data){//Escuchamos la respuesta y capturamos el mensaje 
                  MensajeFinal("");
            });
      }

      function MensajeFinal(msg){
      $('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
      $('.mensage').show('slow');//Mostramos el div.
}

$('#upload_img').on('change', function(e){
    e.preventDefault();
    SubirFotos($(this).attr('id'), $('.img_default'));
});



});