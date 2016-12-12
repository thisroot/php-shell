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
        buttons: {// buttons
            equation: function (lang, options) {

                return tmpl.iconButton(options.iconPrefix + 'equation', {
                    event: 'equation',
                    title: 'input equation',
                    hide: true
                });
            }
        },

        events: {// events
            equation: function (event, editor, layoutInfo) {

                //  Get current editable node
                var $editable = layoutInfo.editable();
                var height = $($editable).height();

                if (!$($editable).parent().find('.eq-panel')[0]) {
                    //
                    var panel = $('<div class="eq-panel"></div>').css({height: height, float: 'left', width: '30%'});
                    $(panel).append('<div class="eq-insert-block"><i class="zmdi zmdi-plus-square zmdi-hc-fw">' +
                            '</i></div><div id="scrolling" class="media p-10">' +
                            '<div class="panel-group" data-collapse-color="amber" id="accordion" role="tablist" aria-multiselectable="true"></div></div>');
                    $($editable).parent().append(panel);
                    $($editable).css({
                        float: 'left',
                        width: '100%'
                    });
                    $($editable).animate({width: '70%'}, "slow");
                    setEquationList();

                } else {
                    $($editable).parent().find('.eq-panel').remove();
                    $($editable).animate({width: '100%'}, "slow");

                    $('.equation-container').each(function (i, v) {
                        var uniqint = $(v).data('id');
                        var text = $(this).find('script').text();
                        if (!text) {
                            var text = $(v).text();
                            $(v).text('$' + text + '$');
                            $(v).attr('contenteditable', false);
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-' + uniqint]);
                        }
                    });
                }

                $('.equation-container').unbind();

                function setEquationList() {
                    $.ajax({
                        dataType: "html",
                        url: 'https://nebesa.me/public/modules/students/summernote-plugin/equation-tmpl.html',
                        success: function (result) {
                            $(panel).find('#accordion').html(result);
                            $('#scrolling').mCustomScrollbar();
                            $(panel).find('.badge').on('click', function () {
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

                function getUniqRandomInt(min, max, items) {
                    var id = Math.floor(Math.random() * (max - min + 1)) + min;

                    if (!$.inArray(id, items ? items : 0)) {
                        getUniqRandomInt(min, max, items);
                    } else {
                        return id;
                    }
                }
                ;

                $('.eq-insert-block').on('click', function () {
                    console.log($(document.activeElement));
                    var uniqint = getUniqRandomInt(0, 100000, $('.equation-container'));
                    var val = 'insert formula here';
                    var node = $('<div  data-id="' + uniqint + '" id="equation-' + uniqint + '" contenteditable="false" class="badge equation-container">$' + val + '$</div>');
                    editor.insertNode($editable, node[0], false);
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-' + uniqint]);
                });

                $('.equation-container').on('dblclick', function () {
                    var uniqint = $(this).data('id');
                    var text = $(this).find('script').text();
                    if (text) {
                        $(this).empty().text(text);
                        $(this).attr('contenteditable', true);
                    } else {
                        text = $(this).text();
                        $(this).text('$' + text + '$');
                        $(this).attr('contenteditable', false);
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-' + uniqint]);
                    }
                });


                setEquationList();

//                $('#equation').on('input', function () {
//                    var value = $(this).val();
//                    $('#equation-tex').text('$' + value + '$');
//                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-tex']);
//                });

//        $('#equation-append').on('click', function() {
//
//            function getUniqRandomInt(min, max, items) {
//                var id = Math.floor(Math.random() * (max - min + 1)) + min;
//
//                if (!$.inArray(id, items?items:0)) {
//                    getUniqRandomInt(min, max, items);
//                } else {
//                    return id;
//                }
//            };
//
//            var uniqint = getUniqRandomInt(0, 100000,$('.equation-container'));
//            var val = $('#equation').val();
//            var node = $('<div id="equation-'+uniqint+'" contenteditable="false" class="badge equation-container">$'+val+'$</div>');
//
//
//           editor.insertNode($editable,node[0],false);
//           MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'equation-'+ uniqint]);
//
//            $('#modal-equation').modal('hide');
//            $('#equation-tex').text('');
//            $('#equation').val('');
//
//        });

//        $('#equation-close').on('click', function() {
//            $('#equation').val('');
//        });
            },
            'summernote.init': function (we, e) {
          console.log('summernote initialized', we, e);
        },
        // This will be called when user releases a key on editable.
        'summernote.keyup': function (we, e) {
          console.log('summernote keyup', we, e);
}
        }
    });
    
    
    
}));
