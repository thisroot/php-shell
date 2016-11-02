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

    name: 'equation',
    buttons: { // buttons
      equation: function (lang, options) {

        return tmpl.iconButton(options.iconPrefix + 'equation', {
          event : 'equation',
          title: 'input equation',
          hide: true
        });
      }
    },

    events: { // events
      equation: function (event, editor, layoutInfo) {
                
        // Get current editable node
        var $editable = layoutInfo.editable();
        $('#modal-equation').modal();
        $('#equation-append').unbind();
        $('#equation').unbind();
        $('#equation-close').unbind();
              
           function setEquationList() {                   
                    $.ajax({
                        dataType: "html",
                        url: 'https://nebesa.me/public/modules/students/summernote-plugin/equation-tmpl.html',
                        success: function (result) {  
                            /*
                            var i = 0;
                            $.each(result, function (item, value) {

                                var el = $(
                                        '<div class="panel panel-collapse"><div class="panel-heading" role="tab">' +
                                        '<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#accordion-' + item + '" aria-expanded="false" class="collapsed">' +
                                        value.name +
                                        '</a></h4></div><div id="accordion-' + item + '" class="collapse" role="tabpanel" aria-expanded="false" style="height: 0px;">' +
                                        '</div></div>');

                                $.each(value.symbols, function (i, v) {
                                    var ft = $('<span class="badge" id="'+item +'-'+i+'" >$' + v.code + '$</span>');
                                 //   MathJax.Hub.Queue(["Typeset",MathJax.Hub,item+'-'+i]);
                                    
                                    $(el).find('#accordion-' + item).append(ft);
                                 
                            
                                    $(ft).on('click', function () {
                                        var string_range = $('#equation').range();
                                        var string = $('#equation').val();

                                        if (string.length == 0) {
                                            $('#equation').val(v.code);
                                            $('#equation').trigger('input');
                                        } else {
                                            $('#equation').range(v.code);
                                            $('#equation').trigger('input');
                                        }
                                    }); 
                                    
                                });
                                
                                $('#accordion').append(el);
                            }); */
                               
                          // MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                        
                          $('#accordion').html(result);
                          $('#accordion').find('.badge').on('click', function () {
                                        var string_range = $('#equation').range();
                                        var string = $('#equation').val();

                                        if (string.length == 0) {
                                            $('#equation').val($(this).find('script').text());
                                            $('#equation').trigger('input');
                                        } else {
                                            $('#equation').range($(this).find('script').text());
                                            $('#equation').trigger('input');
                                        }
                            }); 
                          
                        }
                    });
                };
                
           setEquationList();

                $('#equation').on('input', function () {
                    var value = $(this).val();
                    $('#equation-tex').text('$' + value + '$');
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-tex']);
                });
        
        $('#equation-append').on('click', function() {
            
            function getUniqRandomInt(min, max, items) {
                var id = Math.floor(Math.random() * (max - min + 1)) + min;

                if (!$.inArray(id, items?items:0)) {
                    getUniqRandomInt(min, max, items);
                } else {
                    return id;
                }
            };
           
            var uniqint = getUniqRandomInt(0, 100000,$('.equation-container'));                  
            var val = $('#equation').val();
            var node = $('<div id="equation-'+uniqint+'" contenteditable="false" class="badge equation-container">$'+val+'$</div>');
            
          
           editor.insertNode($editable,node[0],false);
           MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-'+ uniqint]);
                         
            $('#modal-equation').modal('hide');
            $('#equation-tex').text('');
            $('#equation').val('');
                                
        });
        
        $('#equation-close').on('click', function() {
            $('#equation').val('');       
        });
      }
    }
  });
}));
