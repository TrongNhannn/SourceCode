/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

jQuery(function ($) {

  // go to top
  function ScrollBackTop() {
    $(window).scroll(function () {
      ($(this).scrollTop() > 300) ? $('.back__top').addClass('visible'): $('.back__top').removeClass('visible');
    });
  }
  ScrollBackTop();

  //mega menu
  $('.sp-megamenu-wrapper').parent().parent().css('position', 'static').parent().css('position', 'relative');
  $('.sp-menu-full').each(function () {
    $(this).parent().addClass('menu-justify');
  });

  //Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Article Ajax voting
  $('.article-ratings .rating-star').on('click', function (event) {
    event.preventDefault();
    var $parent = $(this).closest('.article-ratings');

    var request = {
      'option': 'com_ajax',
      'template': template,
      'action': 'rating',
      'rating': $(this).data('number'),
      'article_id': $parent.data('id'),
      'format': 'json'
    };

    $.ajax({
      type: 'POST',
      data: request,
      beforeSend: function () {
        $parent.find('.fa-spinner').show();
      },
      success: function (response) {
        var data = $.parseJSON(response);
        $parent.find('.ratings-count').text(data.message);
        $parent.find('.fa-spinner').hide();

        if (data.status) {
          $parent.find('.rating-symbol').html(data.ratings)
        }

        setTimeout(function () {
          $parent.find('.ratings-count').text('(' + data.rating_count + ')')
        }, 3000);
      }
    });
  });
  //  Cookie consent
  $('.js-accept').on('click', function (event) {
    event.preventDefault();

    var date = new Date();
    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
    document.cookie = "cookieAllowed=true" + expires + "; path=/";
  });

  $("#attrib-helix_ultimate_blog_options .btn-group label:not(.active)").click(function () {
    var label = $(this);
    var input = $('#' + label.attr('for'));

    if (!input.prop('checked')) {
      label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
      if (input.val() === '') {
        label.addClass('active btn-primary');
      } else if (input.val() == 0) {
        label.addClass('active btn-danger');
      } else {
        label.addClass('active btn-success');
      }
      input.prop('checked', true);
      input.trigger('change');
    }
    var parent = $(this).parents('#attrib-helix_ultimate_blog_options');
    if (parent) {
      showCategoryItems(parent, input.val())
    }
  });
  $("#attrib-helix_ultimate_blog_options .btn-group input[checked=checked]").each(function () {
    if ($(this).val() == '') {
      $("label[for=" + $(this).attr('id') + "]").addClass('active btn btn-primary');
    } else if ($(this).val() == 0) {
      $("label[for=" + $(this).attr('id') + "]").addClass('active btn btn-danger');
    } else {
      $("label[for=" + $(this).attr('id') + "]").addClass('active btn btn-success');
    }
    var parent = $(this).parents('#attrib-helix_ultimate_blog_options');
    if (parent) {
      parent.find('*[data-showon]').each(function () {
        $(this).hide();
      })
    }
  });


  function showCategoryItems(parent, value) {
    var controlGroup = parent.find('*[data-showon]');
    controlGroup.each(function () {
      var data = $(this).attr('data-showon')
      data = typeof data !== 'undefined' ? JSON.parse(data) : []
      if (data.length > 0) {
        if (typeof data[0].values !== 'undefined' && data[0].values.includes(value)) {
          $(this).slideDown();
        } else {
          $(this).hide();
        }
      }
    })
  }

  $(window).on('scroll', function () {
    var scrollBar = $(".sp-reading-progress-bar");
    if (scrollBar.length > 0) {
      var s = $(window).scrollTop(),
        d = $(document).height(),
        c = $(window).height();
      var scrollPercent = (s / (d - c)) * 100;
      const postition = scrollBar.data('position')
      if (postition === 'top') {}
      scrollBar.css({
        width: `${scrollPercent}%`
      })
    }

  })

});