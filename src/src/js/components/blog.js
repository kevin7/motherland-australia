(function ($) {

    /*
    ** Mobile toggle for category filter
    */
    $('.c-filter__mobile-toggle').on('click', function () {
        var $cur = $(this);
        var $parent = $(this).parent();

        if ($parent.hasClass('active')) {
            $parent.removeClass('active');    
            $cur.text($cur.data('show'));
        } else {
            $parent.addClass('active');
            $cur.text($cur.data('hide'));
        }

        
        return false;
    });

    /*
    ** Category toggle to show more if > 5
    */
    $('#js-cat-toggle').on('click', function () {
      var $cats = $('.c-filter__cats');
      var $cur = $(this);
      
      if ($cats.hasClass('active')) {
        $cats.removeClass('active');
        $cur.text('+');
      } else {
        $cats.addClass('active');
        $cur.text('-');
      }
  
      return false;
    });
  
    /*
    ** Filter buttons
    */
    $('.c-filter__cat').on('click', function () {
      var $cur = $(this);
      var selectedID = [];

      // User selects All
      if ($cur.data('tid') === 0) {
        $('.c-filter__cat').removeClass('c-badge--active');
        $cur.addClass('c-badge--active');
        $('#js-field-cats').val('');
        submitFilter(0);
        return;
      } else {
        $('.c-filter__cat--all').removeClass('c-badge--active');
      }

      if ($cur.hasClass('c-badge--active')) {
        $cur.removeClass('c-badge--active');
      } else {
        $cur.addClass('c-badge--active');
      }

      $('.c-filter__cat.c-badge--active').each(function () {
        var $cat = $(this);
        var catID = $cat.data('tid');
        selectedID[selectedID.length] = catID;
      });
  
      if (selectedID.length) {
        $('#js-field-cats').val(selectedID.join(','));
      } else {
        $('#js-field-cats').val('');
      }
      
      submitFilter(0);
  
      return false;
  
    });

    /*
    ** Pagination - ajax
    */  
    $('#js-post-results').on('click', '#js-filter-pagination a', function () {
  
      submitFilter($(this).text());  
  
      return false;
    });

    $('form#js-filter-form').on('submit', function () {
        submitFilter(0);
        return false;
    });
  
    /*
    ** Filter ajax submission
    */
    function submitFilter(paged) {
  
        var $preloader = $('#js-filter-loader');
        var $resultContainer = $('#js-post-results');
        $('#js-field-paged').val(paged);
        
        $.ajax({
            type: "post",
            url: "/wp-admin/admin-ajax.php",
            data: $('#js-filter-form').serialize(),
            beforeSend: function () {
                $preloader.addClass('active');
                $resultContainer.css('height', $resultContainer.outerHeight()).empty();
                $('.c-filter__show').empty();
                $('html, body').animate({
                    scrollTop: $('#js-filter-loader').offset().top - 30
                }, 500);     
            },
            success: function (response) {
                var result = $.parseJSON(response);
        
                if (result.total > 0) {
        
                    $resultContainer.css('height', 'auto').append(result.data);
                    $('.c-filter__show').append(result.text);
                    equalHeight('.c-post__content', 574, '.c-post__content');
                    $(window).on('resize', function () {
                        equalHeight('.c-post__content', 574, '.c-post__content');
                    });
                
                } else {
        
                    $('#js-post-results').append('<div class="alert alert-info">Sorry, we are unable to find any results matching your filter settings.</div>').removeClass('loading');
                }
                $preloader.removeClass('active');
    
            }
        });
  
    }
  
    function equalHeight(elm, mobileWidth, target) {
  
      var tallest = 0;
      var $block = $(elm);
      $(target).css('min-height', 0);
      
      if ($(window).width() > mobileWidth) {
    
        $block.each(function (x) {
          if ($(this).outerHeight() > tallest) {
            tallest = $(this).outerHeight(); 
          }
        });   
        $(target).css('min-height', tallest);
    
      }
    }
  
  })(jQuery);