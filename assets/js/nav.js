var $ = jQuery;

$( document ).ready(function() {

  $('#hamburger-open').click(function(){
    $('body').css('position','fixed');
    $('#mobile-menu').fadeIn(200);
    $('#hamburger-open').fadeOut(200,function(){
      $('#hamburger-close').fadeIn(200);
    });
  });

  $('#hamburger-close').click(function(){
    $('body').css('position','relative');
    $('#mobile-menu').fadeOut(200);
    $('#hamburger-close').fadeOut(200,function(){
      $('#hamburger-open').fadeIn(200);
    });
  });

});
