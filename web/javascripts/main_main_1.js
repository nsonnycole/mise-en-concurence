// Generated by CoffeeScript PHP 1.3.1
(function() {

  $(function() {
    $("body").delegate('#js-scroll-top', 'click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      return $('html, body').animate({
        scrollTop: 0
      }, "slow");
    });
    $('.js_datepicker').datepicker($.extend($.datepicker.regional['fr'], {
      showOn: 'button',
      buttonImage: '/images/calendar.gif',
      buttonImageOnly: true
    }));
    $("body").delegate(".js_confirm", 'click', function(event) {
      return window.confirm($(event.currentTarget).data("confirm"));
    });
    $("body").delegate('.readMore', 'click', function(event) {
      $('.collapsable').toggleClass('open', 100);
      $('.readMore').replaceWith('<a href="#" class="readLess">masquer</a>');
      return false;
    });
    $("body").delegate('.readLess', 'click', function(event) {
      $('.collapsable').toggleClass('open', 100);
      $('.readLess').replaceWith('<a href="#" class="readMore">lire la suite</a>');
      return false;
    });
    $('[data-title]').tooltip({
      "content": function() {
        return $(this).attr('data-title');
      }
    });
    $('input, textarea').placeholder();
    $("#devis").hide();
    $("#devis_toggle").click(function(event) {
      event.preventDefault();
      event.stopPropagation();
      return $("#devis").toggle();
    });
    return $("#confirm_annulation").click(function(event) {
      event.preventDefault();
      event.stopPropagation();
      return $("#annulation-modal").dialog({
        dialogClass: "no-close",
        resizable: false,
        height: 250,
        width: 350,
        modal: true,
        buttons: {
          "non": function() {
            return $(this).dialog("close");
          },
          "oui, annuler la consultation": function() {
            $(this).dialog("close");
            return window.location.href = event.target.href;
          }
        }
      });
    });
  });

}).call(this);
