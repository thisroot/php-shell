<?
if (APP::Module('Users')->user['role'] == 'default') {
    header('Location:' . APP::Module('Routing')->root);
    exit();
}
if ((APP::Module('Users')->user['id'] !== $data['id_user']) && ($data['privacy_edit'] != 0 ) &&
        (!((APP::Module('Student')->Relations(APP::Module('Users')->user['id'],$data['id_user'],'university')) && ($data['privacy_edit'] == 1))) && 
        (!((APP::Module('Student')->Relations(APP::Module('Users')->user['id'],$data['id_user'],'classmates')) && ($data['privacy_edit'] == 2))))  {
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

      <!-- Render Header -->
   <? 
   if(APP::Module('Users')->user['role'] != 'default') {
   APP::Render('student/widgets/header', 'include', [
       'img' => APP::Module('Student')->user_data['user_settings']['img_crop']
   ]); } else {
      APP::Render('student/widgets/header');
    } ?>
     <!-- Stop Render Header -->

    <section id="main">
<? APP::Render('student/user/lectures/sidebar','include',['page' => 'lecture_edit']) ?>

        <section id="content">
           
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           
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
                            
                           
                            <div class="card-body card-padding  ">
                                
                                <div id="items" class="dd"></div>

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
<? APP::Render('core/widgets/js') ?>


    <script>
        $(document).ready(function () {

            var ago = moment($('.time').text()).fromNow();
            $('.time').text(ago);

            shortcut.add("Ctrl+s", function () {
                $('.js-save').trigger('click');
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
            
            getList();


            /*
            function deleteBlock(item) {
                var data = {
                    name: 'remove-block',
                    item: item
                }

               

                $.ajax({
                    type: 'post',
                    url: '<?//= APP::Module('Routing')->root ?>students/user/api/delete/block.json',
                    data: data ? data : [0],
                    success: function (result) {
                        //console.log(result);

                    }
                });
            }

            getList();
            
           

            function updateStruct() {
                var index = [];
                var items = $('#items').find('.block-name');

                $.each(items, function (i, value) {
                    index[i] = $(value).data('pk');
                });

                var data = {
                    name: 'update-index',
                    pk: '<?//= APP::Module('Crypt')->Encode($data['id']); ?>',
                    index: index
                }

                $.ajax({
                    type: 'post',
                    url: '<?//= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                    data: data ? data : [0],
                    success: function (result) {
                        //console.log(result);

                    }
                });
            }
            ; */
    
            $('.dd').on('change', function() {
                    var data = {
                        name: 'update-index',
                        pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                        index: $(this).nestable('serialize')
                    };
                    
                     $.ajax({
                        type: 'post',
                        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                        data: data ? data : [0],
                        success: function (result) {
                        }
                    });
            });
            
            function refresh() {
            
                $('.block-name').editable({
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
                       
                        setTimeout(function(){
                            $('<div id="block-content-' + id+ '" data-id="' + id + '" class="block-content">' + data_items[0][id].body + '</div>').insertAfter($('#dd3-content-'+id));}, 150); 
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
                        console.log('privet');
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
                
                $('.dd-handle').bind('movestart', function() {
                   console.log('priet'); 
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
                
               
            }
            
            function appendBlocks(list,index,el) {
                                var child;
                                var ol = $('<ol class="dd-list"></ol>');
                                $.each(index, function (i, v) {
                                        $.each(list,function(item,value) {
                                            
                                            if(v.id == value.id_block) {
                                            child = $('<li class="dd-item dd3-item" id="item-' + value.id_block + '" data-id="' + value.id_block + '"><div class="dd-handle  dd3-handle"></div><div id="dd3-content-'+ value.id_block +'" class="dd3-content" data-id="' + value.id_block + '">'+
                                                    '<span class="js-expand waves-effect"  data-id="' + value.id_block + '"><i class="zmdi zmdi-chevron-up zmdi-hc-fw"></i></span>' +
                                                    '<span class="js-save waves-effect hidden"  data-id="' + value.id_block + '"><i class="zmdi zmdi-save zmdi-hc-fw">fd</i></span>' +
                                                    '<span class="js-edit waves-effect" data-id="' + value.id_block + '"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                                                    '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +                                                   
                                                    '<div id="block-name-' + value.id_block + '" data-name="block-edit-name" data-pk="' + value.id_block + '" data-id="' + value.id_block + '" class="block-name">' + value.name + '</div>' +
                                                    '<div class="expand"></div>'+
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
            
            /*
            function refresh() {
                $('.js-edit').unbind();

                $('.js-edit').on('click', function () {
                    var item = $(this).data('item');
                    if (!$('#collapse-' + item).hasClass('in')) {
                        $('#heading-' + item + ' a').trigger('click');
                    }
                    $(this).addClass('hidden');
                    $(this).prev().removeClass('hidden');


                  //  CKEDITOR.replace('html-editor-' + item);
 
                  //  $('.cke_editable').attr('syle', 'background-color: #edecec;');
                    
                     $('#html-editor-' + item).summernote({
                     height: 400, // set editor height
                     minHeight: null, // set minimum height of editor
                     maxHeight: null, // set maximum height of editor
                     focus: true, // set focus to editable area after initializing summernote
                     fontNames: ['Arial', 'Arial Black', 'Play', 'Tahoma'],
                     toolbar: [
                     ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear', 'superscript', 'subscript']],
                     ['fonts', ['fontsize', 'fontname']],
                     ['color', ['color']],
                     ['undo', ['undo', 'redo', 'help']],
                     ['ckMedia', ['ckImageUploader', 'ckVideoEmbeeder']],
                     ['misc', ['link', 'picture', 'table', 'hr', 'codeview', 'fullscreen']],
                     ['para', ['ul', 'ol', 'paragraph', 'leftButton', 'centerButton', 'rightButton', 'justifyButton', 'outdentButton', 'indentButton']],
                     ['height', ['lineheight']],
                     ]
                     });
                    
                });

                $('.block-name').editable({
                    url: '<?//= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                    mode: 'inline',
                    params: function (params) {
                        params.lecture = '<?//= APP::Module('Crypt')->Encode($data['id']); ?>';
                        return params;
                    },
                    success: function (response, newValue) {
                        if (response.status == 'error') {
                            console.log('error update DB')
                        }
                    }
                });

                $('.js-save').on('click', function () {

                  
                    var item = $(this).data('item');
                    var html_data = $('#html-editor-' + item).code();
                    console.log(html_data);
                    if (html_data == '<br>') {
                        $('#html-editor-' + item).code();
                        html_data = $('#html-editor-' + item).code()
                    }
                    if ((!html_data) && ($('#collapse-' + item).hasClass('in'))) {
                        $('#heading-' + item + ' a').trigger('click');
                    }

                    $('#html-editor-' + item).destroy();
                    $(this).addClass('hidden');
                    $(this).next().removeClass('hidden');

                    var data = {
                        name: 'block-edit-body',
                        pk: '<?//= APP::Module('Crypt')->Encode($data['id']); ?>',
                        id_block: item,
                        block_name: $('#block-name-' + item).text(),
                        data: html_data
                    }


                    $.ajax({
                        type: 'post',
                        url: '<?//= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                        data: data ? data : [0],
                        success: function (result) {
                            console.log(result);

                        }
                    });
                });

            }

            refresh();

            // использование Math.round() даст неравномерное распределение!
            function getUniqRandomInt(min, max, items) {
                var id = Math.floor(Math.random() * (max - min + 1)) + min;

                if (!$.inArray(id, items)) {
                    // console.log(id,items);
                    getUniqRandomInt(min, max, items);
                } else {
                    return id;
                }
            }
            ;

            $('#add-block').on('click', function () {

                var items = [];
                $('.js-edit').each(function () {
                    items.push($(this).data('item'));
                });

                var id = getUniqRandomInt(1000, 9999, items);
                var el = document.createElement('li');
                el.innerHTML =
                        '<span class="js-save waves-effect hidden"  data-item="' + id + '"><i class="zmdi zmdi-save zmdi-hc-fw"></i></span>' +
                        '<span class="js-edit waves-effect" data-item="' + id + '"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                        '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +
                        '<span class="drag-handle"><i class="zmdi zmdi-swap-vertical zmdi-hc-fw"></i></span>' +
                        '<div id="block-name-' + id + '" data-name="block-edit-name" data-pk="' + id + '" data-id="' + id + '" class="block-name">Name block</div>' +
                        '<div class="panel panel-collapse">' +
                        '<div class="panel-heading" role="tab" id="heading-' + id + '">' +
                        '<h4 class="panel-title">' +
                        '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' + id + '" aria-expanded="true" aria-controls="collapse-' + id + '">' +
                        '.' +
                        '</a>' +
                        '</h4>' +
                        '</div>' +
                        '<div id="collapse-' + id + '" class="collapse in" role="tabpanel" aria-labelledby="heading-' + id + '">' +
                        '<div  class="panel-body">' +
                        '<div id="html-editor-' + id + '">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                sortable.el.appendChild(el);


                var data = {
                    action: 'create-block',
                    pk: '<?//= APP::Module('Crypt')->Encode($data['id']); ?>',
                    id_block: id,
                    name: $('#block-name-' + id).text(),
                    index: $('#block-name-' + id).parent().index(),
                }


                $.ajax({
                    type: 'post',
                    url: '<?//= APP::Module('Routing')->root ?>students/user/api/add/block.json',
                    data: data ? data : [0],
                    success: function (result) {
                        // console.log(result);

                    }
                });

                updateStruct();
                refresh();
            });  */

            //editables 
            $('#lecture').editable({
                url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/lecture.json',
                mode: 'inline',
                success: function (response, newValue) {
                    if (response.status == 'error') {
                        console.log('error update DB');
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
                    }
                },
                source: [
                    {value: 0, text: 'for all'},
                    {value: 1, text: 'for university'},
                    {value: 2, text: 'for classmates'},
                    {value: 3, text: 'locked'}
                ]
            });



        });
    </script>



</body>
</html>


