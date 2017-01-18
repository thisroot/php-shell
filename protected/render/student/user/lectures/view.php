<?
if (APP::Module('Users')->user['role'] != 'default') {
    if ((APP::Module('Users')->user['id'] == $data['id_user']) ||
        ($data['privacy_edit'] == 0) ||
        ((APP::Module('Student')->Relations(APP::Module('Users')->user['id'],$data['id_user'],'university')) && ($data['privacy_edit'] == 1)) ||
        ((APP::Module('Student')->Relations(APP::Module('Users')->user['id'],$data['id_user'],'classmates')) && ($data['privacy_edit'] == 2)))
    {
        header('Location:' . APP::Module('Routing')->SelfUrl() . '/edit');
        exit();
    }
} elseif ($data['privacy_edit'] == 0) {
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
    <meta name="title" content="<?= $data['name'] ?>" />
    <meta name="description" content="<?= $data['university'] . ' / ' . $data['faculty']; ?>" />
    <link rel="image_src" href="<?= APP::Module('Routing')->root ?>public/modules/students/img/logo-students-tool-ful.png" />
    <title><?= $data['name']; ?></title>

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
    <style type="text/css">
        html:not(.ismobile) .page-loader {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        html:not(.ismobile) .page-loader .preloader {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        .preloader.pl-xl {
            width: 80px;
        }
        .preloader {
            position: relative;
            margin: 0px auto;
            display: inline-block;
        }

        svg:not(:root) {
            overflow: hidden;
        }
        .pl-circular {
            animation: rotate 2s linear infinite;
            height: 100%;
            transform-origin: center center;
            width: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

    </style>

</head>
<body  id="module-student" data-ma-header="teal" class="main-container">
    <? APP::Render('student/widgets/page_loader') ?>
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

    APP::Render('student/widgets/logo');   
    if (APP::Module('Users')->user['role'] != 'default') {
        APP::Render('student/widgets/ulogin', 'include', [
       'img' => APP::Module('Student')->user_data['user_settings']['img_crop']
   ]);
    } else {
        APP::Render('student/widgets/ulogin');
    }
    ?>
    <!-- Stop Render Header -->

    
<? APP::Render('student/user/lectures/sidebar','include',['page' => 'lecture_view']) ?>

        <section id="content" class="col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-lg-10">
                        <div class="card p-b-30">

                            <div class="card-header">
                                <h2><a href="#" id="lecture" data-type="text" data-pk="<?= APP::Module('Crypt')->Encode($data['id']); ?>" data-title=""><?= $data['name'];?></a>
                                    <small><?= $data['university'] . ' / ' . $data['faculty'] ?>/ </small>
                                </h2>

                                <ul class="actions">
                                    <li>
                                        <div class="input-group time-container p-r-5">
                                            <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i> <span class="time"> <?= $data['date_last_update'] ?></span>
                                        </div>
                                    </li>
                                    <? if(APP::Module('Users')->user['id'] == $data['id_user'] ) {?>
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
                                       <button class="visible show-all btn btn-sm palette-Purple-400 bg btn-icon-text waves-effect m-l-5"><i class="zmdi zmdi-unfold-more"></i>Show</button>
                                    </li>
                                    <li>
                                       <button class="accordeon expand-all btn btn-sm palette-Purple-400 bg btn-icon-text waves-effect m-l-5 m-r-5"><i class="zmdi zmdi-unfold-more"></i>Expand</button>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-sm m-r-5 palette-Purple-400 bg waves-effect" data-toggle="dropdown"><i class="zmdi zmdi-menu"></i></a>
                                            <ul class="dropdown-menu pull-right dm-icon ">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-share"></i>Share</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-copy"></i>Copy</a></li>
                                                <li class="divider"></li>
                                                <li role="presentation"><a id="action-delete" role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-delete"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>

                            </div>


                            <div  class="card-body card-padding card-lecture paper ">

                                <div id="items" class="dd"></div>

                                <div class="panel-group" role="tablist" aria-multiselectable="true">
                                <ol id="items1"> </ol>
                                </div>


                            </div>
                        </div>
        </section>

   
    

    

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

   <!-- <script src="<?//= APP::Module('Routing')->root ?>public/plugins/sortable/Sortable.js" type="text/javascript"></script> -->

    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/summernote/dist/summernote-updated.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/shortcuts/shortcut.js" type="text/javascript"></script>

    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
  <!--  <script src="<?//= APP::Module('Routing')->root ?>public/plugins/moment/locale/ru.js" type="text/javascript"></script> -->

 <!--   <script src="<?//= APP::Module('Routing')->root ?>public/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?//= APP::Module('Routing')->root ?>public/plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script> -->

    <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>
    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML"></script>

  <!--  <link href="<?//= APP::Module('Routing')->root ?>public/modules/students/ckeditor.css" rel="stylesheet" type="text/css"/> -->
   <!--  <script src="<?//= APP::Module('Routing')->root?>public/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script> -->
  <!--   <script src="<?//= APP::Module('Routing')->root?>public/plugins/nestedSortable/jquery.mjs.nestedSortable.js" type="text/javascript"></script> -->
    <script src="<?= APP::Module('Routing')->root?>public/plugins/Nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root?>public/plugins/jquery.event.move/js/jquery.event.move.js" type="text/javascript"></script>
<? APP::Render('core/widgets/js') ?>


    <script>
        $(document).ready(function () {

            var ago = moment($('.time').text()).fromNow();
            $('.time').text(ago);



            $(document).click(function(event) {
                    if(!$(event.target).closest('.dd-item').length) {
                        $.each($('.active'), function() {
                            $(this).removeClass('active');
                        });
                    } else {
                         $.each($('.active'), function() {
                            $(this).removeClass('active');
                        });
                        var id = $(event.target).closest('.dd-item').data('id');
                        $('#dd3-content-'+id).addClass('active');
                    }
                });

                $('.visible').on('click', function() {

                    if($(this).hasClass('show-all')) {
                         $('.dd').nestable('expandAll');
                         $(this).removeClass('show-all');
                         $(this).addClass('hide-all');
                         $(this).find('.zmdi').removeClass('zmdi-unfold-more');
                         $(this).find('.zmdi').addClass('zmdi-unfold-less');
                         $(this).find('.zmdi')[0].nextSibling.nodeValue = 'Hide';
                         $.each($('.js-expand'), function() {
                             var id = $(this).data('id');
                             if(!$(this).parent().hasClass('open')) {
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
                         $.each($('.js-expand'), function() {
                              var id = $(this).data('id');
                             if($(this).parent().hasClass('open')) {
                                 $(this).trigger('click');
                             }

                         });
                    }
                });

                $('.accordeon').on('click', function() {
                    if($(this).hasClass('expand-all')) {
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
                            appendBlocks(list,index,$('#items'));

                        $('.dd').nestable();
                        $('.dd').nestable('collapseAll');
                        refresh();
                        }
               });
            }
            
            function getBlockBody(id_block, callback) {
                var data = {
                    name: 'get-block-body',
                    pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                    id_block: id_block
                };

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/get/block/body.json',
                    data: data ? data : [0],
                    success: function (result) {
                        callback(result);
                    },
                    error: function (result) {
                        callback(result);
                    }
                });
            };

            getList();


            function refresh() {

              $('.expand').unbind();
              $('.js-expand').unbind();
              $('.js-save').unbind();
              $('.js-edit').unbind();
              $('.js-delete').unbind();
              $('.dd3-content').unbind();




                $('.expand').on('click', function() {
                   $(this).parent().find('.js-expand').trigger('click');
                });

                $('.js-expand').on('click', function() {
                    var id = $(this).data('id');

                    if($('#dd3-content-'+id).hasClass('open')) {

                         setTimeout(function(){
                            $('#block-content-' + id).remove(); }, 150);
                        $('#dd3-content-'+id).removeClass('open');
                        $(this).find('.zmdi').removeClass('zmdi-chevron-down').addClass('zmdi-chevron-up');
                   } else {
                       $('#dd3-content-'+id).addClass('open');
                       $(this).find('.zmdi').removeClass('zmdi-chevron-up').addClass('zmdi-chevron-down');

                        setTimeout(function () {
                                //  var body = (data_items[0][id].body != 0)?data_items[0][id].body:'<div class="body-empty"><a class="edit-empty-block" id="edit-empty-block-' + id+ '" data-id="' + id + '">edit block<a></div>';
                                var body;
                                //   console.log(data_items[0][id].body);
                               
                                if (typeof data_items[0][id].body == 'undefined') {
                                    
                                    getBlockBody(id, function (data) {
                                        data_items[0][id].body = data[0].body != 0?data[0].body:'';
                                        $('<div id="block-content-' + id + '" data-id="' + id + '" class="block-content">' + data_items[0][id].body + '</div>').insertAfter($('#dd3-content-' + id));
                                    });

                                } else {                                  
                                    $('<div id="block-content-' + id + '" data-id="' + id + '" class="block-content">' + data_items[0][id].body + '</div>').insertAfter($('#dd3-content-' + id));
                                }

                                var math = document.getElementById('block-content-' + id);
                                MathJax.Hub.Queue(["Typeset", MathJax.Hub, math]);
                                $('block-content-' + id).find('')

                            }, 150);
                    }
                });

                $('.dd3-content').hover(function() {
                      $.each($('.dd3-content'),function(item,value) {
                       $(this).removeClass('active');
                    });
                    var id = $(this).data('id');
                    $('#dd3-content-'+id).addClass('active');
                });

                $('.dd3-content').on('click', function() {
                      $.each($('.dd3-content'),function(item,value) {
                       $(this).removeClass('active');
                    });

                    var id = $(this).data('id');
                    $('#dd3-content-'+id).addClass('active');
                });
            }

            function appendBlocks(list,index,el) {
                                var child;
                                var ol = $('<ol id="dd-list" class="dd-list"></ol>');
                                $.each(index, function (i, v) {
                                        $.each(list,function(item,value) {

                                            if(v.id == value.id_block) {
                                            child = $('<li class="dd-item dd3-item" id="item-' + value.id_block + '" data-id="' + value.id_block + '"><div class="dd-handle  dd3-handle"></div><div id="dd3-content-'+ value.id_block +'" class="dd3-content" data-id="' + value.id_block + '">'+
                                                    '<span class="js-expand expand-view waves-effect"  data-id="' + value.id_block + '"><i class="zmdi zmdi-chevron-up zmdi-hc-fw"></i></span>' +
                                                    '<div id="block-name-' + value.id_block + '" data-name="block-edit-name" data-pk="' + value.id_block + '" data-id="' + value.id_block + '" class="block-name">' + value.name + '</div>' +
                                                    '<div id="expand-' + value.id_block + '" class="expand"></div>'+
                                                    '</div></li>');

                                            ol.append(child);
                                            }
                                        });
                                     if(v.children) {
                                              appendBlocks(list,v.children,child);
                                            }
                                });
                                el.append(ol);
                            }

        });
    </script>



</body>
</html>


