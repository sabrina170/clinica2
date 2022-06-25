$(function(){


  $(window).load(function() { 
        $("#spinner").fadeOut("slow"); 
    });

sticky_relocate();

//MENU STICKY =====================================================================================================

function sticky_relocate() {
        
       var altura = $('.menu_stk').offset().top;
         
         $(window).on('scroll', function(){
             
             alert("ON");
             if ( $(window).scrollTop() > altura ){
                 $('.menu_stk').addClass('sticky');
             } else {
                 $('.menu_stk').removeClass('sticky');
             }
         });
        
      }
      
//FIN MENU STICKY ===================================================================================================== 


function close_accordion_section() {
    jQuery('.accordion .accordion-section-title').removeClass('active');
    jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
  }

  jQuery('.accordion-section-title').click(function(e) {
    // Grab current anchor value
    var currentAttrValue = jQuery(this).attr('href');

    if(jQuery(e.target).is('.active')) {
      close_accordion_section();
    }else {
      close_accordion_section();

      // Add active class to section title
      jQuery(this).addClass('active');
      // Open up the hidden content panel
      jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
    }

    e.preventDefault();
  });




function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    //var elemBottom = elemTop + $(elem).height();
     var elemBottom = elemTop + 100;

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

$(window).scroll(function () {
    $('[data-ef]').each(function () {
        $efecto = $(this).data('ef');
        if (isScrolledIntoView(this) === true) {
            $(this).addClass($efecto);
            
        }
    });

});


  
	
var cargador = $(".cargador");
$("#panel").on("click", function(){
    IniciarTransicion($("#contacto"), "slice-left", "close_slice_bottom" )
$(".cerrar").on("click", function(){
    CerrarTransicion($("#contacto"), "slice_bottom", "close_slice_bottom", 2000)
});

});

function IniciarTransicion (panel, transicion, transicion_cerrar){
    cargador.fadeIn(100);

    setTimeout(function(){
        panel.fadeIn(150);
        panel.removeClass(transicion_cerrar).addClass(transicion);
        cargador.fadeOut(100);
    }, 1000);
}

function CerrarTransicion(panel, transicion, transicion_cerrar, TiempoParaCerrar){
    panel.addClass(transicion_cerrar).removeClass(transicion);
    panel.fadeOut(TiempoParaCerrar);
}



//======MENU 

$(".menu-toggle").on('click', function() {
  $(this).toggleClass("on");
  $('.menu-section').toggleClass("on");
  $("nav ul").toggleClass('hidden');
});



//========CARGADOR WEB =======// 
$(".link").on("click", function(){
    var ruta = $(this).attr("href").substr(1);
    var load = $(this).data("load");
  
   $(".view-link").html("<div class='load'></div>");
setTimeout(function(){
    $(".view-link").load(ruta);
    $(load).fadeOut();
}, 2000);

    
}); 

//=======CARGADOR DE COLOR=======//


$(".cargar").on("click", function(){
    var color = $(this).data("color");
    var fondo = $(this).data("fondo");
    var ruta = $(this).attr("href").substr(1);
    $("body").html("<div class='object'></div>");
    $(".object").css({'backgroundColor':color});
    setTimeout(function(){
    $("body").css({'backgroundColor':fondo});
    $(".object").fadeOut();
    $("body").load(ruta);
    }, 800);
    
});

$window = $(window);
//=======PARALLAX=======//

$('.parallax').each(function() {
            var $scroll = $(this);
            var $speed  = $(this).data("speed");

            $(this).css("background-position", "50% 0");
            $(this).css("background-attachment","fixed");

            $(window).scroll(function() {
                var yPos = -($window.scrollTop() / $scroll.data('speed'));
                var coords = '50% ' + yPos + 'px';
                $scroll.css({ backgroundPosition: coords });
            });
        });

//=======ANCLAS=======//

 $('a.anchor').click(function(e){
 e.preventDefault();
     enlace  = $(this).attr('href');
     $('html, body').animate({
         scrollTop: $(enlace).offset().top
     }, 1000);
 });

//=======LIGHTBOX=======//

 $('.lightbox img').on("click", function(){
  var url = $(this).attr('src');
  var web = $('body');
  var image = "<div class='gallery'><span>CERRAR</span><br><img src='"+ url +"'></div>";

  $(image).appendTo(web);
  $('.gallery').fadeIn(300);
  $('.gallery span').on("click", function(){
    $('.gallery').fadeOut(300);
    $('.gallery').remove();
  });
 });
 
  $('.lightbox-d').on("dblclick", function(){
      
  var url = $(this).data('img');
  var web = $('body');
  var image = "<div class='gallery'><span>CERRAR</span><br><img src='"+ url +"'></div>";

  $(image).appendTo(web);
  $('.gallery').fadeIn(300);
  $('.gallery span').on("click", function(){
    $('.gallery').fadeOut(300);
    $('.gallery').remove();
  });
 });

//=======SLIDER=======//

 $('.data-slider div:gt(0)').fadeOut(500);
 setInterval(function(){
var tiempo = $('.slider').data("time");
var efecto = $('.slider').data("effect");
var bg = $('.slider div:first-child').css('background-image');
 $('.slider').css({'background-image':bg,'background-size':'cover'});
 $('.slider div:first-child').fadeOut(1000)
 .next('div').fadeIn(tiempo).addClass(efecto)
 .end().appendTo('.slider');}, 4000);

  $('.slider-img img:gt(0)').fadeOut(800);
 
setInterval(function(){
var tiempo = $('.slider-img').data("time");
var efecto = $('.slider-img').data("effect");
var bg = $('.slider-img img:first-child').attr('src');
var alto = $('.slider-img img:first-child').css('height');
 $('.slider-img').css({'height': alto,'background-image':'url('+bg+')','background-size':'cover'});

 $('.slider-img img:first-child').fadeOut(2000).next('img').fadeIn(tiempo).addClass(efecto).end().appendTo('.slider-img');
}, 10000);



//=======HOV=======//

var $bg  = $(".hov").data("bg");
$(".hov").css("background-image","url("+ $bg +")");
var movementStrength = 35;
var height = movementStrength / $(window).height();
var width = movementStrength / $(window).width();
$(".hov").mousemove(function(e){
          var $bg  = $(this).data("bg");
          var pageX = e.pageX - ($(window).width() / 2);
          var pageY = e.pageY - ($(window).height() / 2);
          var newvalueX = width * pageX * -1 - 25;
          var newvalueY = height * pageY * -1 - 50;

          $(this).css("background-image","url("+ $bg +")");

          $('.hov').css("background-position", newvalueX+"px     "+newvalueY+"px");
});


//=======MASK=======//
$('.mask').each(function(){
  var $bg  = $(this).data("bg");
  $(this).css("background-image","url("+ $bg +")");

});

$('.mask').hover(function(){
  $(this).find('span').css({'display':'block'});
}, function(){
  $(this).find('span').fadeOut(30);
});

//=======MENU 1=======//
  var touch   = $('#resp-menu');
  var menu  = $('.menu-1');
 
  $(touch).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle();
  });
  
  $(window).resize(function(){
    var w = $(window).width();
    if(w > 767 && menu.is(':hidden')) {
      menu.removeAttr('style');
    }
  });
  //=======FIN MENU 1=======//
  

$('.block').hide();
$('.accordion h2').on('click',function(){
  if($(this).next().is(':visible')){
  $(this).next().slideUp();
 }
 if($(this).next().is(':hidden')){
  $('.accordion h2').next().slideUp();
   $(this).next().slideDown();
}
});

$('ul.tabs li:first').addClass('active');
 $('.block article').hide();
 $('.block article:first').show();
 $('ul.tabs li').on('click',function(){
   $('ul.tabs li').removeClass('active');
  $(this).addClass('active')
  $('.block article').hide();
 var activeTab = $(this).find('a').attr('href');
  $(activeTab).show();
});




//SLIDER OFICIAL =====================================================================================================
var duration = $(".slider-tws").data("time");
var slides   = $(".slider-tws .sli").length;
var altura = $('.slider-tws').data("h");
var efecto = $('.slider-tws').data("effect");
var bg_sli = $(".slider-tws .sli").css("background-image");

$('.slider-tws .sli').css({'height': altura});
$('.slider-tws').css({'height': altura});





  var i = 1;


  $(".slider-tws .sli:nth-child(1)").addClass("active");
  $('.slider-tws').css({'background-image':bg_sli,'background-size':'cover'});

  // Slide the images

  function slide() {
    if(i <= slides) {

      var imagelocation = ".slider-tws .sli:nth-child(" + i + ")";
      var navlocation   = ".nav-tws a:nth-child(" + i + ")";
      var bg_imagelocation = $(imagelocation).css("background-image");

      $(imagelocation).siblings().removeClass("active");
      $(imagelocation).siblings().removeClass(efecto);

      $(imagelocation).fadeIn().addClass("active");
      $(imagelocation).addClass(efecto);
      $('.slider-tws').css({'background-image':bg_imagelocation,'background-size':'cover'});


      $(navlocation).siblings().removeClass("navActive");
      $(navlocation).addClass("navActive");

    }
    if(i == 0) { i = slides; }
    if(i < 0)  { i = 0; }
  }

  // Add navigation blips

  var blips = 0;

  for (var nav = 0; nav < slides; nav++) {
    $(".nav-tws").append('<a href="#">O</a>');
  }

  $(".nav-tws a:first-child").addClass("navActive");
  
  $(".nav-tws a").click(function(){
      clearInterval(timer);
      slide();
      AutoplaySlider();
  });
  

  // Configure the next/prev buttons

  $('.next').click(function() {

    clearInterval(timer);

    if (i == slides) { i = 1; }
    else { i++ }

    slide();
  AutoplaySlider();

    console.log(i);
  })

  $('.prev').click(function() {

    clearInterval(timer);

    if(i == 1) { i = slides; }
    else { i-- }

    slide();
    AutoplaySlider();


    console.log(i);
  })

  // Autoplay 

  timer = setInterval(function() {
    i++;

    if(i > slides) { 
      i = 1;
    }
    slide();
  }, duration);

  function AutoplaySlider(){
    timer = setInterval(function() {
    i++;

    if(i > slides) { 
      i = 1;
    }
    slide();
  }, duration);
  }  
  
//FIN SLIDER OFICIAL =====================================================================================================


});