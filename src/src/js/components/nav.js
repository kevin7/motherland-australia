(function ($) {

    var $body = $('body');
    var $header = $('.c-header');
    var lastScrollTop = 0;
    
    
  fixedHeader($(window).scrollTop());
  $(document).on('scroll', function (e) {
    var scrollTop = $(window).scrollTop();
    fixedHeader(scrollTop);
  });

  

  function fixedHeader(scrollTop) {
   
    var headerHeight = $header.height();
    var $body = $('body');

    // scroll direction to show nav once user scrolled up
    var st = window.pageYOffset || document.documentElement.scrollTop;

    // sticky nav for desktop
    if (scrollTop > (headerHeight + 50)) {

      if (!$body.hasClass('c-header--sticky')) {
        $body.addClass('c-header--sticky');
      }
      
      if (st > lastScrollTop){
        if (scrollTop < 100) {
          if (!$body.hasClass('c-header--force-hide')) {
            $body.addClass('c-header--force-hide');		
          }
        } else {
          if (!$body.hasClass('c-header--hide')) {
            $body.removeClass('c-header--force-hide');	
            $body.addClass('c-header--hide');		
          }	
        }        
      } else {
	
        if ($body.hasClass('c-header--hide')) {
          $body.removeClass('c-header--hide');		
        }	
					 
      }
      
    } else {

      if ($body.hasClass('c-header--sticky')) {
        $body.removeClass('c-header--force-hide');	
        $body.removeClass('c-header--sticky');
      }				
      
    }

    if (scrollTop > 5) {
      $('body').addClass('c-header--solid');
    } else {
      $('body').removeClass('c-header--solid');
      $('body').removeClass('c-header--hide');	
    }

    lastScrollTop = st;   

  }


    $('.js-menu-toggle').on('click', function () {
        var $elm = $(this);
        
        if ($body.hasClass('c-nav-mobile--opened')) {
            $body.removeClass('c-nav-mobile--opened');
            $('.js-menu-toggle').removeClass('active');
        } else {
            $body.addClass('c-nav-mobile--opened');
            $('.js-menu-toggle').addClass('active');
        }

        return false;
        
    });

    $('.submenu-toggle').on('click', function () {
        var $elm = $(this);
        var $menu = $elm.parent();

        if ($menu.hasClass('active')) {
            $menu.removeClass('active');
        } else {
            $menu.addClass('active');
        }
        
        return false;

    });



    $('.js-program-menu').on('click', function () {

        $('.c-program__side').addClass('active');

        return false;
    });

    $('.js-program-close').on('click', function () {

        $('.c-program__side').removeClass('active');

        return false;
    });


})(jQuery);