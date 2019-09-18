$(document).ready(function(){
    $('.menu li:has(ul)').click(function(e){
        e.preventDefault();

        if($(this).hasClass('activado')){
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
        }else{
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });

    $('.btn-menu').click(function(){
        $('.contenedor-menu .menu').slideToggle();
        
        if($(this).hasClass('fa-bars')){
            $(this).removeClass('fa-bars');
            $(this).addClass('fa-times');
        }else if($(this).hasClass('fa-times')){
            $(this).removeClass('fa-times');
            $(this).addClass('fa-bars');
        }
    });

    $(window).resize(function(){
        if($(document).width() > 768){
            $('.contenedor-menu .menu').css({'display': 'block'});

            $('.maincarrito').removeClass('carrito');
            $('.maincarrito').addClass('escarrito');

            $('.maincontent').removeClass('contenido');
            $('.maincontent').addClass('contenidocarro');
        }

        if($(document).width() < 768){
            $('.contenedor-menu .menu').css({'display': 'none'});
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');

            $('.maincarrito').removeClass('escarrito');
            $('.maincarrito').addClass('carrito');
            $('.maincontent').removeClass('contenidocarro');
            $('.maincontent').addClass('contenido');
        }

    });

    $('.menu li ul a').click(function(){
        window.location.href = $(this).attr("href");
    });
});