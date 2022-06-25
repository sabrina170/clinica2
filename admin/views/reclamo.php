<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-8 col-xl-10 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
        <div id="panel-dashboard">
            <div id="view-categorias" class="view-tab">
                <h2>Libro de reclamaciones</h2>
                
<div class="cnt-t-table">
                    <table id="td_reclamos" class="t-table" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
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
        


<script>

listarReclamo();

var idioma_español = 

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
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
    
    


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

/*---------------------
LISTAR CATEGORIA
---------------------*/

function listarReclamo(){

  var table = $('#td_reclamos').DataTable({
      "destroy" : true,
      "ajax": {
      "method" : "POST",
      "url" : "controlador/listado/listarReclamo.php"
    },
    "columns":[

        {"data":"id_reclamo"},
        {"data":"nombre_reclamo"},
        {"data":"dni_reclamo"},
        {"defaultContent": "<button class='ver btn btn-success btn-sm bt-modal btn-edit btn-detail'>Ver detalle</button>"}
    ],
    "language": idioma_español

  });
  
  ver_reclamo('#td_reclamos tbody', table);

 
  return false;
  
}


function ver_reclamo(tbody, table){

$(tbody).on('click', "button.ver", function(){

var data = table.row($(this).parents("tr")).data();
var ide_evento = data.id_reclamo;
window.location = 'page-ver-reclamo.php?rec=' + ide_evento ;

  });
}

    
</script>

