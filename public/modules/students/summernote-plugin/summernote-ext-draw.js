(function (factory) {
  /* global define */
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else {
    // Browser globals: jQuery
    factory(window.jQuery);
  }
}(function ($) {
  // template
  var tmpl = $.summernote.renderer.getTemplate();

 
  $.summernote.addPlugin({
    name: 'draw',
    buttons: { // buttons
      draw: function (lang, options) {

        return tmpl.iconButton(options.iconPrefix + 'draw', {
          event : 'draw',
          title: 'fast draw',
          hide: true
        });
      }
    },

    events: { // events
      draw: function (event, editor, layoutInfo) {      
        // Get current editable node
        var $editable = layoutInfo.editable();
        
        $.when($('#modal-draw').modal()).then(function() { 
        $('#modal-draw').css('padding-right','0px');
    });
      }
    }
  });
}));
