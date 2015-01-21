Admin = {};

Admin.leftMenuHover = function() {
  
  $('.leftContainer .leftMenu .navbar-nav li').hover(function() {
      
      $('.nav navbar-nav li').each(function(k,v) {
          $(this).find('span').css({'color':'#FFFFFF'});
          var img = $(this).find('img');
          var src = img.attr('data-inactive');
          img.attr('src',src);
      });
      
      $(this).find('span').css({'color':'#32b4ff'});
      var img = $(this).find('img');
      var src = img.attr('data-active');
      img.attr('src',src);
      
  }, function() {
      
      
      $(this).find('span').css({'color':'#FFFFFF'});
      var img = $(this).find('img');
      var src = img.attr('data-inactive');
      img.attr('src',src);
      
  });
  
  $('.userSettings , .turnOff').hover(function() {
        var img = $(this).find('img');
        var src = img.attr('data-active');
        img.attr('src',src);
  }, function() {
        var img = $(this).find('img');
        var src = img.attr('data-inactive');
        img.attr('src',src);
  });
  
  $('.leftMenuButton').click(function() {
        $('.leftContainer').toggle();
        
        if ($('.leftContainer').is(':visible')) {
           // var width = $(window).width() - $('.leftContainer').width()-20;
            //$('.centerContainer').width(width+'px');
            $('.centerContainer').addClass('centerMenuOpen');
        } else {
            $('.centerContainer').width('100%');
            $('.centerContainer').removeClass('centerMenuOpen');
        }
  });
  
  
  
    
};



$(document).ready(function() {
    
    Admin.leftMenuHover();
    
});