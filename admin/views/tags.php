<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            <div id="view-tag" class="view-tab">
  <h2>Administrar Etiquetas</h2><br>

<button class="bt-modal" data-modal="ctn-modal-add-tag">
  <i class="fas fa-plus"></i> NUEVO TAG
</button>  

  <table id="td_tag" class="table-info" style="width: 100% !important;">
      <thead>
        <tr>
          <th>CODIGO</th>
          <th>NOMBRE</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
  </table>
            </div>
        </div>
    </div>

<!----------------------------
AGREGAR TAG
----------------------------->

<div class="cnt-modal" id="ctn-modal-add-tag">
<div class="body-modal" id="cnt-add-tag" style="">
<h2>Agregar Tag</h2>
<h4>Ingrese el nombre del Tag:</h4><br>
<input type="text" name="nombre-tag" id="name_new_tag" class="otg"> <br>

<button id="add-tag" class="btn-confirm">Agregar</button>

<button class="close-tab btn-cancel" data-href="#view-tag">Cancelar</button>
</div>
</div>


<!----------------------------
MODIFICAR SUBCATEGORIA 
----------------------------->
<div class="cnt-modal" id="ctn-modal-edit-tag">
<div class="body-modal" id="cnt-edit-tag" style="">
<h2>Actualizar Tag</h2>
<h4>Ingrese un nuevo nombre del tag:</h4><br>
<form id="frm_edit_tag">
<input type="text" name="nombre_tag" id="name_tag"> <br>
<input type="hidden" name="accion" value="EditarTag">
<input type="hidden" name="codigo_tag" id="code_tag">
</form>
<button id="upd-tag" class="btn-confirm">Actualizar</button>

<button class="close-tab btn-cancel" data-href="#view-tag" id="cancel-upd-tag">Cancelar</button>


</div>
</div>

<script>

listarTag();

function CerrarModal(){
$('.close-tab').on('click', function(e){    
        e.preventDefault();
        $('.cnt-modal').fadeOut();
    }); 
return false;
}

var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code){

$('.cnt-mod').remove();
$('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="'+frm+'"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm" id="'+ id_confirmacion +'">Confirmar</button><button class="close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="'+accion+'"><input type="hidden" name="'+codigo+'" id="'+id_code+'"></form></div></div>');
$('.close-mod').click(function(e){
  e.preventDefault();
  $('.cnt-mod').fadeOut();
});

return false;
}

var idioma_espanol = 

  {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningè´‚n dato disponible en esta tabla",
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
        "sLast":     "è™‚ltimo",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}


function agregar_tag(campo){
    

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
            
var n_tag = $('#name_new_tag').val();

//alert(n_tag);
$.ajax({
             type: "POST",
             url: "controlador/crud/tag.php",
             async: "false",
             data: {accion: "AgregarTag", 
                    nombre_tag : n_tag
             },
             success:function(data){
              //alert(data);
              $('.cnt-modal').fadeOut();
              location.reload();
              
             return false;
             


             }
});
        }            
}

/*---------------------
LISTAR TAG
---------------------*/

function listarTag(){

  var table = $('#td_tag').DataTable({
      "destroy" : true,
      "ajax": {
      "method" : "POST",
      "url" : "controlador/listado/listarTag.php"
    },
    "columns":[

        {"data":"id_etiqueta"},
        {"data":"nombre_etiqueta"},
        {"defaultContent": "<button class='editar bt-modal btn-edit' data-modal='ctn-modal-edit-product'><i class='far fa-edit'></i></button> <button class='eliminar btn-delete'><i class='far fa-trash-alt'></i></button> "}
    ],
    "language": idioma_espanol

  });
  
    Obtener_data_editar_tag('#td_tag tbody', table);
    Obtener_data_eliminar_tag('#td_tag tbody', table);
  //Agregar_producto('#td_venta_productos tbody', table);
  //Prov_Obtener_data_editar('#td_proveedores tbody', table);
}

/*---------------------
ELIMINAR TAG
---------------------*/

function Obtener_data_eliminar_tag(tbody, table){

  $(tbody).on('click', "button.eliminar", function(){

ModalEliminar('fmr_delete_tag','delete_tag','EliminarTag','Codigo_tag', 'codigo_tag');
var data = table.row($(this).parents("tr")).data();
var del_code_producto = $('#codigo_tag').val(data.id_etiqueta);

console.log(data);

$('#delete_tag').on('click', function(e){

  e.preventDefault();
  var DataString = $('#fmr_delete_tag').serialize();

  //alert(DataString);

$.ajax({
             type: "POST",
             url:
              "controlador/crud/tag.php",
             async: "false",
             data: DataString,
             success:function(data){
              //alert(data);
              $('.cnt-mod').fadeOut();
              listarTag();
             }
});
});
  });
}

/*---------------------
EDITAR TAG
---------------------*/

function Obtener_data_editar_tag(tbody, table){

  $(tbody).on('click', "button.editar", function(){

var data = table.row($(this).parents("tr")).data();
var edit_name_producto = $('#name_tag').val(data.nombre_etiqueta),
    edit_code_producto = $('#code_tag').val(data.id_etiqueta);

console.log(data);
$('#ctn-modal-edit-tag').fadeIn();
CerrarModal();

$('#upd-tag').on('click', function(e){

  e.preventDefault();
  var DataString = $('#frm_edit_tag').serialize();

  //alert(DataString);

$.ajax({
             type: "POST",
             url: "controlador/crud/tag.php",
             async: "false",
             data: DataString,
             success:function(data){
              //alert(data);
              $('.cnt-modal').fadeOut();
              //listarTag();
              location.reload();
             }
});
});
  });
}
</script>
