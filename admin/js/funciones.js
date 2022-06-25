$(function(){

    

$('.up-img').on('change', function(e){
    e.preventDefault();
    var destino = $(this).closest('.cnt-upload').find('.item-upload-img');
    SubirFotos($(this).attr('id'), destino);


});

/*
    if (localStorage.getItem("dark") == 1) {
        $('body').addClass('dark-body');
        $('#dark-mode').prop('checked', true);
        $('#logo-topbar').attr('src', 'img/logo-blanco.png');

    } else {
        
        $('body').removeClass('dark-body');
        localStorage.setItem("dark", "0");
        $('#logo-topbar').attr('src', 'img/logo-color.png');
    }

$('#dark-mode').on('change', function(){
    if($(this).is(':checked')){
        localStorage.dark = 1;  
        $('body').addClass('dark-body');
        $('#logo-topbar').attr('src', 'img/logo-blanco.png');
        
        console.log("Modo oscuro activado");
      }else{
        localStorage.dark = 0;
        $('body').removeClass('dark-body');
        $('#logo-topbar').attr('src', 'img/logo-color.png');
      };
});
    */

    //MENU STICKY =====================================================================================================
    //sticky_relocate();

    function sticky_relocate() {

        var altura = $('.header-sticky').offset().top;

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > altura) {
                $('.header-sticky').addClass('sticky');
            } else {
                $('.header-sticky').removeClass('sticky');
            }
        });
    }
     
$(".nav-toggler").on('click', function() {
        $("body").toggleClass("show-sidebar");

        $(".nav-toggler i").toggleClass("ti-menu");
    });
$(".nav-lock").on('click', function() {
        $("body").toggleClass("lock-nav");
        $(".nav-lock i").toggleClass("mdi-toggle-switch-off");
        $("body, .page-wrapper").trigger("resize");
    });
    
$('.t-tab').on('click', function(e){
e.preventDefault();
var view_tab = $(this).attr('href');
var view = $(this).data('view');

$(view).each(function(){
$(this).css({'display' : 'none'});
});

$('.t-tab').each(function(){
$(this).removeClass('active');
});

$(this).addClass('active');

$(view_tab).css({'display' : 'block'});
});
    


$('#panel-opc').on('click', function(){
    $('#panel-opciones').fadeToggle();
});
    
    

codigo_tienda = $('#code_tienda').text();

var didScroll;
var lastScrollTop = 0;
var delta = 5;

var navbarHeight = $('#barra-superior').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta) 
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('#barra-superior').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('#barra-superior').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

/* FUNCIONES INICIADAS */

//CargarPerfiles();
//CargarClientes('.lista_clientes'); 

AbrirModal();


/* FUNCIONES DEL SISTEMA */

$('#salir_sistema').on('click', function(e){
    
    e.preventDefault();
    
    
$.ajax({
             type: "POST",
             url: "controlador/acciones.php",
             data: {accion: 'salir'},
             success:function(data){
             //alert(data);
             window.location='index.php';
             return false;
             }
});

});

function createCKEditor() { 
        
$('.editable').on("click", function(){
    
    CKEDITOR.disableAutoInline = true;
    
    CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'ru';
	// config.uiColor = '#AADC6E';
	config.filebrowserWindowWidth = '800';
	config.filebrowserWindowHeight = '250';
	config.resize_enabled = true;
	config.htmlEncodeOutput = false;
	config.entities = false;
	config.extraPlugins = 'codemirror';
    config.extraPlugins = 'font';
     
	config.codemirror_theme = 'rubyblue';

	config.toolbar = 'MyToolbar';
    config.toolbar_MyToolbar = [
    { name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'SaveTemplate', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
    { name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
    { name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
    '/',
    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
    { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
    { name: 'links', items: ['Link', 'Unlink'] },
    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
    '/',
    { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
    { name: 'colors', items: ['TextColor', 'BGColor'] },
    { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
    { name: 'others', items: ['-', 'SelectTemplate'] }
    ];
    
    };
    
    var editor = CKEDITOR.inline(this, { 
        toolbar: [ { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                   { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                   { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                   { name: 'insert', items: [ 'Image','HorizontalRule', 'SpecialChar'] },'/',
                   { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike'] },
                   { name: 'styles', items: ['Format', 'Font', 'FontSize' ] },
                   { name: 'justifyClasses', items: [ 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify' ]},
                   { name: 'colors', items: [ 'TextColor'] },]});
                   
        editor.on('blur', function(evt) {
        $(this).attr("contenteditable","false");
        var data = evt.editor.getData(); //getData() returns CKEditor's HTML content
        editor.destroy();
        
        $('.obj-mtv .OpcionIndependiente').fadeOut();
       
    });
}); 

  return false; 
}
createCKEditor();

var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code){

$('.cnt-mod').remove();
$('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="'+frm+'"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm" id="'+ id_confirmacion +'">Confirmar</button><button class="close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="'+accion+'"><input type="hidden" name="'+codigo+'" id="'+id_code+'"></form></div></div>');
$('.close-mod').click(function(e){
  e.preventDefault();
  $('.cnt-mod').fadeOut();
});

return false;
}

function AbrirModal(){
$('.bt-modal').on('click', function(e){
    
    e.preventDefault();
    var target = $(this).data('modal');
    
      $('.cnt-modal').css({'display':'none'});
      $('#' + target).fadeIn();

      $('.close-tab').on('click', function(e){    
        e.preventDefault();
        $('.cnt-modal').fadeOut();
    });   
    return false;
});
return false;
} 

function CerrarModal(){
$('.close-tab').on('click', function(e){    
        e.preventDefault();
        $('.cnt-modal').fadeOut();
    }); 
return false;
} 

$('#add-usu').on('click', function(e){
  e.preventDefault();
  agregar_Usuario('.ou');
});

$('#add-color').on('click', function(e){
  e.preventDefault();
  agregar_color('.oc');
});

$('#add-talla').on('click', function(e){
  e.preventDefault();
  agregar_talla('.ot');
});

$('#add-tag').on('click', function(e){
  e.preventDefault();
  agregar_tag('.otg');
});

function ValidarCampos(campo){
    

    var isValid = true;

    $(campo + ":visible").each(function() {
        
            if ($.trim($(this).val()) == '') {

                isValid = false;

                $(this).css({

                    "outline": "2px solid red",
                    "background": ""
                });
                
                $(this).focus();
                
                return false;

            }

            else {

                $(this).css({

                    "outline": "2px solid seagreen",
                    "background": ""

                });
            }

        });

        if (isValid == false){

            $('.error_info').css({'background-color': 'indianred'});
            $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
            $('.error_info').fadeIn();
            return false;
            

        }else{
        
            $('.error_info').css({'background-color': 'seagreen'});
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn();
        
        }            
}

function validarletras(e)
{

       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }



/* FUNCIONES INICIADAS */

$subdominio = $('#name_sucursal').text();

$('#nombre_sucursal').val($subdominio);

$('.t-tab').on('click', function(e){
e.preventDefault();
var view_tab = $(this).data('href');
$('.view-tab').each(function(){
$(this).css({'display' : 'none'});
});
$(view_tab).css({'display' : 'block'});
});
      function MensajeFinal(msg){
      $('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
      $('.mensage').show('slow');//Mostramos el div.
}









$('#list-categorias').on('click', function(){
$('#lista_categorias').html("<img src='img/loader.gif' style='margin:25px 0px; margin: auto;'>");

});









/*=============================================
CARGAR PERFILES
=============================================*/
function CargarPerfiles(){

$.ajax({
             type: "POST",
             url: "controlador/acciones.php",
             async: "false",
             data: {accion: 'ListarPerfiles'},
             success:function(data){
            $('.perfiles').append(data);
             return false;
             }
});

}

/*=============================================
CARGAR CLIENTES
=============================================*/
function CargarClientes(combo){

$.ajax({
             type: "POST",
             url: "controlador/acciones.php",
             async: "false",
             data: {accion: 'ComboClientes'},
             success:function(data){
            //alert(data);
            $(combo).append(data);
             return false;
             }
});

}








/*---------------------
LISTAR USUARIOS
---------------------*/
/*
function listarusuarios(){

  var table = $('#td_usuarios').DataTable({
      "destroy" : true,
      "ajax": {
      "method" : "POST",
      "url" : "controlador/listado/listarUsuario.php"
    },
    "columns":[

        {"data":"id_usuario"},
        {"data":"mail_usuario"},
        {"data":"nombre_perfil"},
        {"data":"estado_usuario"},
        
       
        {"defaultContent": "<button class='editar btn-edit' data-modal='ctn-modal-edit-usuario'><i class='far fa-edit'></i></button> <button class='eliminar btn-delete'><i class='far fa-trash-alt'></i></button>"}
    ],
    "language": idioma_español

  });

  Obtener_data_editar_usuario('#td_usuarios tbody', table);
  Obtener_data_eliminar_usuario('#td_usuarios tbody', table);
  //Obtener_data_eliminar_categoria('#td_categorias tbody', table);
}*/







});