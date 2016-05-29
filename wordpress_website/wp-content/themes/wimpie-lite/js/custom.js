jQuery(document).ready(function($) {

  if ( $('.site-description').css('clip') != "rect(1px 1px 1px 1px)" ){
    $('.search-icon .wl-search').css('margin-top','3px'); 
  }

  $('.wl_footer_social .social-icons > a').each(function(){
    $(this).wrap('<span></span>');
  });

    //Search Box Toogle
    $('.search-icon .fa-search').click(function(){
      $('.wl-search').slideToggle('slow');
    });

    $(window).scroll(function(){
      if($(this).scrollTop() > 150){
        $('.wl-search').hide('slow');
      }
    });

    //$('.error404 .number404').addClass('animated bounce');

    var widt = $( '.clients-logo' ).width();
    if(widt<=410){
      var minmm = 1;
      var maxmm = 1;
    }else if(widt<=720){
      var minmm = 2;
      var maxmm = 2;
    }else if(widt<=950){
      var minmm = 2;
      var maxmm = 3;
    }else if(widt<=1145){
      var minmm = 2;
      var maxmm = 4;
    }else{
      var minmm = 2;
      var maxmm = 5;
    }

    $('.scroll').bxSlider({
      pager:false,
      controls: true,
      auto : 'true',
      minSlides: minmm,
      maxSlides: maxmm,
      slideWidth: 220,
      moveSlides:1
    });


    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });


    $('.menu-toggle').click(function() {
      $('.menu-main-menu-container').toggle('slow');
    });
    $('#wltop').css('right',-65);
    $(window).scroll(function(){
      if($(this).scrollTop() > 300){
        $('#wltop').css('right',20);
      }else{
        $('#wltop').css('right',-65);
      }
    });

    $("#wltop").click(function(){
      $('html,body').animate({scrollTop:0},600);
    });
  });

new WOW().init();
