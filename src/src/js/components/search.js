(function ($) {


    $('.c-search__toggle').on('click', function () {
  
      $('body').addClass('c-search--opened');
      $('body').removeClass('c-header--solid c-nav-mobile--opened');
      $('.c-menu-toggle').removeClass('active');
      return false;
  
    });
  
    $('.js-search-close').on('click', function () {
  
      $('body').removeClass('c-search--opened');
  
      return false;
  
    });
  
  
    $('#js-filter-button').on('click', function () {

        $('.c-dropdown.multiple').each(function () {
          var $cur = $(this).find('.c-dropdown__label');
          if ($(window).width() <= 767) {
            $cur.find('.c-dropdown__label').text($cur.data('label'));
          }
        });
    
        $('body').addClass('c-search-filter--opened');
    
        return false;
    
      });
    
      $('#js-filter-close').on('click', function () {
    
        $('body').removeClass('c-search-filter--opened');
    
        return false;
    
      });
    
      $('#js-filter-save').on('click', function () {
        $('body').removeClass('c-search-filter--opened');
        submitForm($('.search-results .c-search-form form'));
        return false;
      });
    
      $('.search-results form.result-form').on('submit', function () {
    
        var $form = $(this);
    
        submitForm($form);
    
        return false;
    
      });
    
      function submitForm($form) {
    
        $('#js-field-sort').val($('#js-search-sorting .selected').data('value'));
    
        if ($('#js-search-type .selected').length > 0) {
          var value = [];
          $('#js-search-type .selected').each(function () {
            value[value.length] = $(this).data('value');
          });
          $('#js-field-type').val(value.join(','));
        } else {
          $('#js-field-type').val('');
        }
    
        var $resultContent = $('#js-search-result');
        var $resultTotal = $('#js-result-total');
    
        $.ajax({
          type: "post",
          url: "/wp-admin/admin-ajax.php",
          data: $form.serialize(),
          beforeSend: function () {
            $resultContent.addClass('loading');
            $resultContent.empty();
            $resultTotal.empty().html('<i class="icon-circle-notch animate-spin"></i> Searching...');
          },
          success: function (response) {
            var result = $.parseJSON(response);
    
            $('.c-dropdown.c-dropdown--active').removeClass('c-dropdown--active');
    
            if (result.total > 0) {
              $resultContent.append(result.data);
            } 
    
            $resultTotal.empty().text(result.total + ' result' + (result.total !== 1 ? 's' : '') + ' found');
            $resultContent.removeClass('loading');
    
          }
        });
    
        return false;
      }

      $('.c-dropdown__label').on('click', function () {
        var $parent = $(this).parent();
    
        if ($parent.hasClass('c-dropdown--active')) {
          $parent.removeClass('c-dropdown--active');
        } else {
          $parent.addClass('c-dropdown--active');
        }
        
      });
    
      $('.search-results .c-dropdown__item').on('click', function () {
    
        var $item = $(this);
        var $parent = $item.closest('.c-dropdown');
        var $label = $parent.find('.c-dropdown__label');
    
        if ($parent.hasClass('single')) {
          if (!$item.hasClass('selected')) {
            $parent.find('.c-dropdown__item').removeClass('selected');
            $item.addClass('selected');
            $label.text($item.text());
    
            if ($(window).width() > 767) {
              submitForm($('.search-results .c-search-form form'));
            }
          }
        }
    
        if ($parent.hasClass('multiple')) {
          if (!$item.hasClass('selected')) {
            $item.addClass('selected');
          } else {
            $item.removeClass('selected');
          }
          var label = [];
          var $selected = $parent.find('.selected');
          if ($selected.length === 0) {
            label[0] = $label.data('label');
          } else {
            $selected.each(function () {
              label[label.length] = $(this).text();
            });
          }
    
          if ($(window).width() > 767) {
            submitForm($('.search-results .c-search-form form'));
          }
    
          if ($(window).width() <= 767) {
            $label.text($label.data('label'));
          } else {
            $label.text(label.join(', '));
          }
        }
    
      });

  })(jQuery);