<?
if (APP::Module('Users')->user['role'] == 'default') {
    header('Location:' . APP::Module('Routing')->root);
    exit();
}
if ((APP::Module('Users')->user['id'] !== $data['id_user']) && ($data['privacy_edit'] != 0 ) &&
        (!((APP::Module('Student')->Relations(APP::Module('Users')->user['id'], $data['id_user'], 'university')) && ($data['privacy_edit'] == 1))) &&
        (!((APP::Module('Student')->Relations(APP::Module('Users')->user['id'], $data['id_user'], 'classmates')) && ($data['privacy_edit'] == 2)))) {
    header('Location:' . APP::Module('Routing')->root);
    exit();
}
?>

<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Предмет: <?= $data['name'].
        ' / '.$data['university'] . ' / ' . $data['faculty'] ?>
          " />
    <link rel="image_src" href="<?= APP::Module('Routing')->root ?>public/modules/students/img/logo-students-tool-ful.png" />

    <title>Student's tool</title>

    <!-- Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/src/jquery.nouislider.css" rel="stylesheet">

    <!-- Module Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css"/>
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/sortable/st/app.css" rel="stylesheet" type="text/css"/>
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/summernote/dist/summernote.css" rel="stylesheet" type="text/css"/>

    <? APP::Render('core/widgets/css') ?>
    <link href="<?= APP::Module('Routing')->root ?>public/modules/students/main.css" rel="stylesheet" type="text/css"/>


</head>
<body  id="module-student">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-63396844-3', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter36066965 = new Ya.Metrika({
                    id:36066965,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/36066965" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <!-- Render Header -->
    <?
    if (APP::Module('Users')->user['role'] != 'default') {
        APP::Render('student/widgets/header', 'include', [
            'img' => APP::Module('Student')->user_data['user_settings']['img_crop']
        ]);
    } else {
        APP::Render('student/widgets/header');
    }
    ?>
    <!-- Stop Render Header -->

    <section id="main">
<? APP::Render('student/user/lectures/sidebar', 'include', ['page' => 'lecture_edit']) ?>

        <section id="content">
            <div class="hidden"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card p-b-30">

                        <div class="card-header">
                            <h2><a href="#" id="lecture" data-type="text" data-pk="<?= APP::Module('Crypt')->Encode($data['id']); ?>" data-title=""><?= $data['name']; ?></a>
                                <small><?= $data['university'] . ' / ' . $data['faculty'] ?>/  </small>
                            </h2>

                            <ul class="actions">
                                <li>
                                    <div class="input-group time-container p-r-5">
                                        <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i> <span class="time"> <?= $data['date_last_update'] ?></span>
                                    </div>
                                </li>
<? if (APP::Module('Users')->user['id'] == $data['id_user']) { ?>
                                    <li>
                                        <div class="input-group header-editable p-r-5">
                                            <i class="zmdi zmdi-image zmdi-hc-fw"></i>
                                            <a href="#" id="user-priv-view" data-type="select" data-pk="<?= APP::Module('Crypt')->Encode($data['id']); ?>" data-value="<?= $data['privacy_view'] ?>" data-title="privacy"></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group header-editable p-r-5">
                                            <i class="zmdi zmdi-scissors zmdi-hc-fw"></i>
                                            <a href="#" id="user-priv-edit" data-type="select" data-pk="<?= APP::Module('Crypt')->Encode($data['id']); ?>" data-value="<?= $data['privacy_edit'] ?>" data-title="privacy"></a>
                                        </div>
                                    </li>
<? } ?>
                               
                                <li>
                                    <div class="dropdown m-r-10">
                                        <a href="#" class="dropdown-toggle btn palette-Purple-400 bg waves-effect" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu pull-right dm-icon ">
                                            <li role="presentation"><a class="visible show-all" role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-unfold-more"></i>Show</a></li>
                                            <li role="presentation"><a class="accordeon expand-all" role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-unfold-more"></i>Expand</a></li>
                                            <li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-share"></i>Share</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-copy"></i>Copy</a></li>
                                            <li class="divider"></li>
                                            <li role="presentation"><a id="action-delete" role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-delete"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>

                        </div>


                        <div class="card-body card-padding card-lecture paper">

<!--                            <div id="modal-equation" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <div class="p-25">
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-sm-12 col-md-8 pg-item">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 pg-item p-10">
                                                            <div class="form-group">
                                                                <div class="fg-line">
                                                                    <textarea id="equation" class="form-control auto-size" placeholder="Input equation" type="text"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12 pg-item p-10">
                                                            <div id="equation-tex" style="font-size: 200%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-4 pg-item">
                                                        <div id="scrolling" class="media p-10">
                                                            <div class="panel-group" data-collapse-color="amber" id="accordion" role="tablist" aria-multiselectable="true"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="equation-append" type="button" class="btn btn-link">Append</button>
                                            <button id="equation-close" type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

                            <div id="modal-draw" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xlg">
                                    <div class="modal-content">
                                        <div class="modal-header palette-Grey-300 bg">

                                            <ul class="ah-actions actions a-alt">
                                                <li>
                                                    <div class="btn-demo">
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-edit"></i>Pencil</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-brush"></i>Brush</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-view-day"></i>Thin</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-palette"></i>Color</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-format-color-fill"></i>Fill</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-toll"></i>Erase</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-minus"></i>Line</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-circle-o"></i>Circle</button>
                                                        <button class="btn btn-default btn-icon-text waves-effect waves-effect waves-float"><i class="zmdi zmdi-square-o"></i>Square</button>
                                                    </div>

                                                </li>
                                                <li class="pull-right">
                                                    <div class="btn-group-lg">
                                                        <button class="btn palette-Deep-Purple-400 bg waves-effect"><i class="zmdi zmdi-undo"></i></button>
                                                        <button class="btn palette-Deep-Purple-400 bg waves-effect"><i class="zmdi zmdi-redo"></i></button>
                                                        <button class="btn palette-Deep-Purple-400 bg waves-effect"><i class="zmdi zmdi-save"></i></button>
                                                        <button class="btn palette-Deep-Purple-400 bg waves-effect"><i class="zmdi zmdi-delete"></i></button>
                                                        <button class="btn palette-Deep-Purple-400 bg waves-effect"><i class="zmdi zmdi-download"></i></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-body">
                                            <div class="p-25">
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 pg-item">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 pg-item p-10">

                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12 pg-item p-10">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="draw-append" type="button" class="btn btn-link">Append</button>
                                            <button id="draw-close" type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="items" class="dd">
                                <ol id="dd-list" class="dd-list"></ol>
                            </div>

                            <div class="panel-group" role="tablist" aria-multiselectable="true">
                                <ol id="items1"> </ol>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    <? APP::Render('student/widgets/footer') ?>
    </section>

    <? APP::Render('student/widgets/page_loader') ?>

<? APP::Render('student/widgets/ie_warning') ?>

    <!-- Javascript Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootstrap-growl/bootstrap-growl.min.js" type="text/javascript"></script>

    <!-- Module addition Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/summernote/dist/summernote-updated.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/shortcuts/shortcut.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/autosize/dist/autosize.min.js" type="text/javascript"></script>

    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        extensions: ["tex2jax.js","mml2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        tex2jax: {
        inlineMath: [
        ["$", "$"],
        ["\\(", "\\)"]
        ]
        },
        "HTML-CSS": {
        linebreaks: { automatic: true }
        }
        });
    </script>

    <script src="<?= APP::Module('Routing')->root ?>public/plugins/Nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/jquery.event.move/js/jquery.event.move.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/caret/dist/jquery.caret-1.5.2.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/modules/students/summernote-plugin/summernote-ext-equation.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/modules/students/summernote-plugin/summernote-ext-draw.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/socketio/socket.io-1.2.0.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/modules/students/main.js" type="text/javascript"></script>

<? APP::Render('core/widgets/js') ?>


    <script>
$(document).ready(function () {
    
    var app_data = {
        master: false,
        struct_update: true
        };

    var socket = io.connect('https://back.nebesa.me');

    var doc = {
        id_block: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
        id_user: '<?= APP::Module('Crypt')->Encode($data['id_user']) ?>',
        id_owner: '<?= APP::Module('Crypt')->Encode(APP::Module('Users')->user['id']) ?>'
    };

    // get document structure
    socket.emit('get-struct message', doc);

    socket.on('get-struct message', function (data) {
        // set structure
        console.log(data);
    });

    function getList() {
        var data = {
            name: 'get-list',
            pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>'
        };

        $.ajax({
            type: 'post',
            url: '<?= APP::Module('Routing')->root ?>students/user/api/get/list.json',
            data: data ? data : [0],
            success: function (result) {

                var list = result[0];
                var index = result[1];
                data_items = result;
                appendBlocks(list, index, $('#items'));
                $('.dd').nestable();
                $('.dd').nestable('collapseAll');
                refresh();
                apendState(list, index, $('#items'));
            }
        });
    }

    socket.emit('set-struct message', function () {
        var opened_items = '';

        var data = {
            id_block: <?= $data['id']; ?>,
            id_user: <?= $data['id_user'] ?>,
            id_owner: <?= APP::Module('Users')->user['id'] ?>,
            struct: $('.dd').nestable('serialize') ? $('.dd').nestable('serialize') : [""],
            opened_items: '',
            opened_list: ''
        };
        console.log(data);
        return data;
    });


    $(document).on('click moveend', function (e,params) {
        var data = {};
        //  console.log(e.currentTarget);
        var $this = e.target;
        // format state [open,expand,edited]

        if ((app_data.struct_update === true) &&($($this).is('.js-expand, .button-expand, .button-collapse, .zmdi-chevron-up, .zmdi-chevron-down, .zmdi-edit, .zmdi-save, .zmdi-close, .dd-handle')) || ($(params).is('.editable-click'))) {
            if($(params).is('.editable-click')) {
                var item_id = $(params).data('id');
            } else {
                 var item_id = $($this).closest('.dd-item').data('id');
            }

            if ($($this).hasClass('js-expand')) {
                data = {action: ($('#dd3-content-' + item_id).hasClass('open')) ? 'expand-item' : 'collape-item'};
                if(data.action == 'expand-item') {
                    data_items[0][item_id]['state'][0] = 1; }
                else {
                    data_items[0][item_id]['state'][0] = 0;
                }
            } else if ($($this).hasClass('button-expand')) {
                data = {action: 'expand-list'};
                data_items[0][item_id]['state'][1] = 1;
            } else if ($($this).hasClass('button-collapse')) {
                data = {action: 'collapse-list'};
                data_items[0][item_id]['state'][1] = 0;
            } else if ($($this).hasClass('zmdi-chevron-up')) {
                data = {action: 'collapse-item'};
                data_items[0][item_id]['state'][0] = 0;
            } else if ($($this).hasClass('zmdi-chevron-down')) {
                data = {action: 'expand-item'};
                data_items[0][item_id]['state'][0] = 1;
            } else if ($($this).hasClass('zmdi-edit')) {
                data = {action: 'edit-item'};
                data_items[0][item_id]['state'][2] = 1;
            } else if ($($this).hasClass('zmdi-save')) {
                data = {action: 'save-item'};
                data_items[0][item_id]['state'][2] = 0;
            } else if ($($this).hasClass('zmdi-close')) {
                data = {action: 'delete-item'};
            } else if ($($this).hasClass('dd-handle')) {
                data = {action: 'move-item'};
            } else if ($(params).hasClass('editable')) {
                data = {action: 'edit-name-item'};
            } else {
                data = {acrion: 'none'};
            }

            $.extend(data,
                    {
                        id_block: <?= $data['id']; ?>,
                        id_user: <?= $data['id_user'] ?>,
                        id_owner: <?= APP::Module('Users')->user['id'] ?>,
                        id_item: item_id,
                        state: (data_items[0][item_id]['state'] != 'undefined')?data_items[0][item_id]['state']:''
                    });
            socket.emit('struct message', data);
            return false;
        }
    });

    socket.on('struct message', function (data) {
        switch(data.action) {
            case 'collapse-list':
                console.log(data.id_item);
              //  $("#item-" + data.id_item ).find('.button-expand').trigger('click');
                break;
            case 'expand-list':
                console.log(data.id_item);
              //  $("#item-" + data.id_item ).find('.button-expand').trigger('click');
                break;
        }
    });

    

    var ago = moment($('.time').text()).fromNow();
    $('.time').text(ago);

    shortcut.add("Ctrl+s", function () {
        $.each($('.edit'), function () {
            $(this).find('.js-save').trigger('click');
        });
    });

    shortcut.add("Ctrl+e", function () {
        $('.active').find('.js-edit').trigger('click');
    });

    shortcut.add("Ctrl+Enter", function () {
        $('#add-block').trigger('click');
    });

    shortcut.add("Ctrl+Delete", function () {
        $('.active').find('.js-remove').trigger('click');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('.dd-item').length) {
            $.each($('.active'), function () {
                $(this).removeClass('active');
            });
        } else {
            $.each($('.active'), function () {
                $(this).removeClass('active');
            });
            var id = $(event.target).closest('.dd-item').data('id');
            $('#dd3-content-' + id).addClass('active');
            $('#dd3-content-' + id).prev().addClass('active');

        }
    });

    $('.visible').on('click', function () {

        if ($(this).hasClass('show-all')) {
            $('.dd').nestable('expandAll');
            $(this).removeClass('show-all');
            $(this).addClass('hide-all');
            $(this).find('.zmdi').removeClass('zmdi-unfold-more');
            $(this).find('.zmdi').addClass('zmdi-unfold-less');
            $(this).find('.zmdi')[0].nextSibling.nodeValue = 'Hide';
            $.each($('.js-expand'), function () {
                var id = $(this).data('id');
                if (!$(this).parent().hasClass('open')) {
                    $(this).trigger('click');
                }
            });
        } else {
            $('.dd').nestable('collapseAll');
            $(this).removeClass('hide-all');
            $(this).addClass('show-all');
            $(this).find('.zmdi').removeClass('zmdi-unfold-less');
            $(this).find('.zmdi').addClass('zmdi-unfold-more');
            $(this).find('.zmdi')[0].nextSibling.nodeValue = 'Show';
            $.each($('.js-expand'), function () {
                var id = $(this).data('id');
                if ($(this).parent().hasClass('open')) {
                    $(this).trigger('click');
                }
            });
        }
    });

    $('.accordeon').on('click', function () {
        if ($(this).hasClass('expand-all')) {
            $('.dd').nestable('expandAll');
            $(this).removeClass('expand-all');
            $(this).addClass('collapse-all');
            $(this).find('.zmdi').removeClass('zmdi-unfold-more');
            $(this).find('.zmdi').addClass('zmdi-unfold-less');
            $(this).find('.zmdi')[0].nextSibling.nodeValue = 'Collapse';

        } else {
            $('.dd').nestable('collapseAll');
            $(this).removeClass('collapse-all');
            $(this).addClass('expand-all');
            $(this).find('.zmdi').removeClass('zmdi-unfold-less');
            $(this).find('.zmdi').addClass('zmdi-unfold-more');
            $(this).find('.zmdi')[0].nextSibling.nodeValue = 'Expand';
        }
    });

    var data_items;

    function mathJaxReload(html) {
        // filter matjax;
        var $htmlData = $('<div data-wrapper>' + html + '</div>');

        $htmlData.find('script[type="math/tex"]').each(function () {
            var $this = $(this);
            var equation = $this.text();
            if ($this.parent().hasClass('equation-container')) {
                var $blockToReplace = $this.closest('.equation-container');
                $blockToReplace.empty().text('$' + equation + '$');
            } else {
                $this.prev().remove();
                $this.prev().remove();
                var id = $this.attr('id');
                $this.replaceWith('$' + equation + '$');
            }
        });
        return $htmlData.html();
    }



    function sendFile(file, editor, welEditable, id) {

        var dimg = new FormData();
        dimg.append("file", file);
        dimg.append("action", 'upload-block-image');
        dimg.append("id_block", id);
        dimg.append("id_lecture", '<?= APP::Module('Crypt')->Encode($data['id']); ?>');

        $.ajax({
            data: dimg,
            url: '<?= APP::Module('Routing')->root ?>students/user/api/upload/image.json',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                var image = $('<img>').attr('src', result.url);
                $('#html-editor-' + id).summernote("insertNode", image[0]);
            }
        });
    }




    function deleteBlock(item) {
        var data = {
            name: 'remove-block',
            item: item,
            id_hash: '<?= APP::Module('Crypt')->Encode($data['id']); ?>'
        }


        $.ajax({
            async: false,
            type: 'post',
            url: '<?= APP::Module('Routing')->root ?>students/user/api/delete/block.json',
            data: data ? data : [0],
            success: function (result) {
                //console.log(result);
            }
        });

        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this block',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true,
            showLoaderOnCancel: true

        }, function (isConfirm) {
            if (isConfirm) {
                $.post('<?= APP::Module('Routing')->root ?>students/user/api/delete/block.json', data, function () {
                    swal('Deleted!', 'Block has been deleted', 'success');
                });
            }
        });
    }


    $('.dd').on('change', function () {
        updateStruct();
    });

    function updateStruct() {
        var data = {
            name: 'update-index',
            pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
            index: $('.dd').nestable('serialize') ? $('.dd').nestable('serialize') : [""]
        };



       // собираем параметры блоков
     /*   var list_struct = {};
        $.each(data_items[2],function(i,v) {

            list_struct[v] = [];

            el = $('#item-'+v);

            if($(el).children().attr('style') === 'display: block;') {
                list_struct[v].push(1);
            } else {
                list_struct[v].push(0);
            }

            if($(el).find('.dd3-content').hasClass('open')) {
                list_struct[v].push(1);
            } else {
                list_struct[v].push(0);
            }
        }); */


        $.ajax({
            type: 'post',
            url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
            data: data ? data : [0],
            success: function (result) {
            }
        });
    }

    function refresh() {

        $('.expand').unbind();
        $('.js-expand').unbind();
        $('.js-save').unbind();
        $('.js-edit').unbind();
        $('.js-delete').unbind();
        $('.dd3-content').unbind();

        $('.block-name').on('save', function(e, params) {
            $(document).trigger('click',[this]);
        });

        $('.block-name').editable({
            highlight: ' #673ab7',
            url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
            mode: 'inline',
            params: function (params) {
                params.lecture = '<?= APP::Module('Crypt')->Encode($data['id']); ?>';
                return params;
            },
            success: function (response, newValue) {
                if (response.status == 'error') {
                    console.log('error update DB')
                }
            }
        });

        $('.expand').on('dblclick', function () {
            $(this).parent().find('.js-expand').trigger('click');
        });

        $('.js-expand').on('click', function () {
            var id = $(this).data('id');
            if ($('#dd3-content-' + id).hasClass('open')) {
                setTimeout(function () {
                    $('#block-content-' + id).remove();
                }, 150);
                $('#dd3-content-' + id).removeClass('open');
                $(this).find('.zmdi').removeClass('zmdi-chevron-down').addClass('zmdi-chevron-up');
            } else {
                $('#dd3-content-' + id).addClass('open');
                $(this).find('.zmdi').removeClass('zmdi-chevron-up').addClass('zmdi-chevron-down');

                setTimeout(function () {
                    //  var body = (data_items[0][id].body != 0)?data_items[0][id].body:'<div class="body-empty"><a class="edit-empty-block" id="edit-empty-block-' + id+ '" data-id="' + id + '">edit block<a></div>';
                    var body = (data_items[0][id].body != 0) ? data_items[0][id].body : '';

                    $('<div id="block-content-' + id + '" data-id="' + id + '" class="block-content">' + body + '</div>').insertAfter($('#dd3-content-' + id));

                       var math = document.getElementById('block-content-' + id);
                       MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);

//                MathJax.Hub.Queue(
//                    ["resetEquationNumbers", MathJax.InputJax.TeX],
//                    ["PreProcess", MathJax.Hub],
//                    ["Reprocess", MathJax.Hub]
//                    );

                $('block-content-' + id).find('')

                }, 150);
            }
        });


        $('.js-edit').on('click', function () {
            var id = $(this).data('id');
            $('#block-content-' + id).remove();

            if ($('#dd3-content-' + id).hasClass('open')) {
                $('#expand-' + id).trigger('click');
            }

            $('#dd3-content-' + id).addClass('edit');
            $(this).addClass('hidden');
            $(this).prev().removeClass('hidden');

            var body = (data_items[0][id].body != 0) ? data_items[0][id].body : '';
            // use mathJaxReload function
            data_items[0][id].body = mathJaxReload(body);

            $('<div id="html-editor-' + id + '" data-id="' + id + '">' + data_items[0][id].body + '</div>').insertAfter($('#dd3-content-' + id));

            $('#html-editor-' + id).summernote({
                placeholder: 'write here...',
                height: 400, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
                //  fontNames: ['noto-sans'],
                toolbar: [
                    ['insert', ['equation', 'draw']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear', 'superscript', 'subscript']],
                    ['fonts', ['fontsize']],
                    ['color', ['color']],
                    ['undo', ['undo', 'redo']],
                    ['ckMedia', ['ckImageUploader', 'ckVideoEmbeeder']],
                    ['misc', ['link', 'picture', 'table', 'hr', 'codeview', 'fullscreen']],
                    ['height', ['lineheight']]
                ],
                disableDragAndDrop: true,
                onImageUpload: function (files, editor, welEditable) {
                    var id = $(this).data('id');
                    sendFile(files[0], editor, welEditable, id);
                }
            });


//             var math = document.getElementById('html-editor-' + id);
//             MathJax.Hub.Queue(["Typeset",MathJax.Hub,math]);

            MathJax.Hub.Queue(
                    ["resetEquationNumbers", MathJax.InputJax.TeX],
                    ["PreProcess", MathJax.Hub],
                    ["Reprocess", MathJax.Hub]
                    );
       });

        $('.js-save').on('click', function () {

            var id = $(this).data('id');
            var html_data = $('#html-editor-' + id).code();

            if (html_data == '<br>') {
                $('#html-editor-' + id).code();
                html_data = '';
            }
            if ((!html_data) && ($('#dd3-content-' + id).hasClass('open'))) {
                $('#expand-' + id).dblclick();
            }


            data_items[0][id].body = mathJaxReload(html_data);

            $('#html-editor-' + id).destroy();
            $('#html-editor-' + id).remove();
            $('#expand-' + id).dblclick();

            $('#dd3-content-' + id).removeClass('edit');
            $(this).addClass('hidden');
            $(this).next().removeClass('hidden');

            var data = {
                name: 'block-edit-body',
                pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                id_block: id,
                block_name: $('#block-name-' + id).text(),
                data: data_items[0][id].body
            }

            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                data: data ? data : [0],
                success: function (result) {
                    notify('Has been saved', 'inverse', 4000);
                }
            });
        });

        $('.js-remove').on('click', function () {

            var $this = $(this);

            swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover this block',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {

                    var id = $this.prev().data('id');
                    var item = $('#item-' + id);
                    
                    $.each($(item).find('.dd-item'), function (i, v) {
                        var id = $(v).data('id');
                       
                        deleteBlock(id);
                    });

                    if (item.parent().find('li').size() == 1) {
                        item.parent().remove();
                    } else {
                        item.remove();
                    }
                    deleteBlock(id);
                    updateStruct();
                    swal('Deleted!', 'Block has been deleted', 'success');
                }
            });
        });


        $('.dd3-content').on('click', function () {
            $.each($('.dd3-content'), function (item, value) {
                $(this).removeClass('active');
                $(this).prev().removeClass('active');
            });
            var id = $(this).data('id');
            $('#dd3-content-' + id).addClass('active');
            $('#dd3-content-' + id).prev().addClass('active');
        });

        $('.dd3-content').on('dblclick', function () {
            $.each($('.dd3-content'), function (item, value) {
                $(this).removeClass('active');
                $(this).prev().removeClass('active');
            });

            var id = $(this).data('id');
            $('#dd3-content-' + id).addClass('active');
            $('#dd3-content-' + id).prev().addClass('active');
        });
    }

    function apendState(list,index,el) {
        app_data.struct_update = false;
        
        $.each(list, function (item, value) {
            // format state [open,expand,edited]
            
            var state = value['state'];
            
            if(state[0]) {
                $("#item-" + value.id_block ).find('.js-expand').trigger('click');
            }
            if(state[1]) {
                $("#item-" + value.id_block ).find('.button-expand').trigger('click');
            }
            if(state[2]) {
               $("#item-" + value.id_block ).find('.js-edit').trigger('click');
            }
        });
        app_data.struct_update = true;
        
    };

    function appendBlocks(list, index, el) {

        function buildItem(list, value) {

            var html = $('<li class="dd-item dd3-item" id="item-' + list[value.id]['id_block'] + '" data-id="' + list[value.id]['id_block'] + '"><div class="dd-handle  dd3-handle"></div><div id="dd3-content-' + list[value.id]['id_block'] + '" class="dd3-content" data-id="' + list[value.id]['id_block'] + '">' +
                    '<span class="js-expand waves-effect"  data-id="' + list[value.id]['id_block'] + '"><i class="zmdi zmdi-chevron-up zmdi-hc-fw"></i></span>' +
                    '<span class="js-save waves-effect hidden"  data-id="' + list[value.id]['id_block'] + '"><i class="zmdi zmdi-save zmdi-hc-fw"></i></span>' +
                    '<span class="js-edit waves-effect" data-id="' + list[value.id]['id_block'] + '"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                    '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +
                    '<div id="block-name-' + list[value.id]['id_block'] + '" data-name="block-edit-name" data-pk="' + list[value.id]['id_block'] + '" data-id="' + list[value.id]['id_block'] + '" class="block-name">' + list[value.id]['name'] + '</div>' +
                    '<div id="expand-' + list[value.id]['id_block'] + '" class="expand"></div>' +
                    '</div></li>');
            if (value.children) {

                var ol = $('<ol class="dd-list"></ol>');
                $.each(value.children, function (i, sub) {
                    ol.append(buildItem(list, sub));
                });
                html.append(ol);
            }
            return html;
        };

        var parent_ol = $('#dd-list');
        $.each(index, function (item, value) {
            if (list.length != 0) {
                parent_ol.append(buildItem(list, value));
            }
        });
        el.append(parent_ol);
    };



    // использование Math.round() даст неравномерное распределение!
    function getUniqRandomInt(min, max, items) {
        var id = Math.floor(Math.random() * (max - min + 1)) + min;

        if (!$.inArray(id, items ? items : 0)) {
            // console.log(id,items);
            getUniqRandomInt(min, max, items);
        } else {
            return id;
        }
    };
    
    $('#add-block').on('click', function addBlock() {

        var items = [];
        $('.js-edit').each(function () {
            items.push($(this).data('id'));
        });

        var id_block = getUniqRandomInt(1000, 9999, items);


        if ($('.dd3-content.active').length) {
            var el = $('<ol class="dd-list"></ol>');
            var id = $('.dd3-content.active').data('id');
            $('#item-' + id).append(el);
        } else if ($('#dd-list')) {
            var el = $('#dd-list');
        } else {

        }

        data_items[0][id_block] = {};
        data_items[0][id_block]['state'] = [0,0,0];
        var str = id_block.toString();

        var child = $('<li class="dd-item dd3-item" id="item-' + id_block + '" data-id="' + id_block + '"><div class="dd-handle  dd3-handle"></div><div id="dd3-content-' + id_block + '" class="dd3-content" data-id="' + id_block + '">' +
                '<span class="js-expand waves-effect"  data-id="' + id_block + '"><i class="zmdi zmdi-chevron-up zmdi-hc-fw"></i></span>' +
                '<span class="js-save waves-effect hidden"  data-id="' + id_block + '"><i class="zmdi zmdi-save zmdi-hc-fw"></i></span>' +
                '<span class="js-edit waves-effect" data-id="' + id_block + '"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +
                '<div id="block-name-' + id_block + '" data-name="block-edit-name" data-pk="' + id_block + '" data-id="' + id_block + '" class="block-name">Block name</div>' +
                '<div id="expand-' + id_block + '" class="expand"></div>' +
                '</div></li>');

        $(el).append(child);

        var data = {
            action: 'create-block',
            pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
            id_block: id_block,
            name: $('#block-name-' + id_block).text(),
            index: id_block,
        };

        $.ajax({
            type: 'post',
            url: '<?= APP::Module('Routing')->root ?>students/user/api/add/block.json',
            data: data ? data : [0],
            success: function (result) {
                notify('Has been added', 'inverse', 4000);

            }
        });

        updateStruct();
        refresh();

    });

    //editables
    $('#lecture').editable({
        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/lecture.json',
        mode: 'inline',
        success: function (response, newValue) {
            if (response.status == 'error') {
                console.log('error update DB');
            } else {
                notify('Has been saved', 'inverse', 4000);
            }
        }
    });
    $('#user-priv-view').editable({
        showbuttons: false,
        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/lecture.json',
        mode: 'inline',
        success: function (response, newValue) {
            if (response.status == 'error') {
                console.log('error update DB');
            } else {
                notify('Has been saved', 'inverse', 4000);
            }
        },
        source: [
            {value: 0, text: 'for all'},
            {value: 1, text: 'for university'},
            {value: 2, text: 'for classmates'},
            {value: 3, text: 'locked'}
        ]
    });
    $('#user-priv-edit').editable({
        showbuttons: false,
        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/lecture.json',
        mode: 'inline',
        success: function (response, newValue) {
            if (response.status == 'error') {
                console.log('error update DB');
            } else {
                notify('Has been saved', 'inverse', 4000);
            }
        },
        source: [
            {value: 0, text: 'for all'},
            {value: 1, text: 'for university'},
            {value: 2, text: 'for classmates'},
            {value: 3, text: 'locked'}
        ]
    });

    getList();

});

    </script>



</body>
</html>
