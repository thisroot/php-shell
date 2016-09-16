<? if(APP::Module('Users')->user['role'] == 'default') {header('Location:'.APP::Module('Routing')->root);exit();}
   if((APP::Module('Users')->user['id'] !== $data['id_user']) && ($data['private'] != -1)) {header('Location:'.APP::Module('Routing')->root);exit();} 
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
    <style type="text/css">
        .toggle-switch {
            margin-top: 10px;
        }

        .h-logo a small {
            font-size: 14px;
        }

        .select2-container {
            margin-top: 8px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 0px;
            border-bottom: 1px solid #e0e0e0;;
            border-radius: 0px;
        }


        .fg-line:not(.form-group) {
            padding-left: 8px;
        }

        .round-button-container{
            list-style: none;
            padding: 0;
            margin: 30px 0 60px;
            padding-left: 40px;
        }

        .round-button-container > li {
            display: inline-block;

            /* background-color: rgba(255, 255, 255, 0.2); */
            margin-right: 13px;
            color: #fff;
            font-size: 20px;
            vertical-align: top;
            cursor: pointer;
        }

        .custom-counter {
            margin: 0;
            padding: 0;
            list-style-type: none;
          }

        .custom-counter li {
            counter-increment: step-counter;
            margin-bottom: 10px;
        }

        .custom-counter li::before {
            content: counter(step-counter);
            margin-right: 5px;
            font-size: 80%;
            background-color: rgb(0,200,200);
            color: white;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .block__list { 
            max-width: 100%;   
        }
        
        /* editable */
        
        .editable-input, .form-control:not(.fc-alt), .form-inline .form-group {
            width: 100%;
        }
        
        .editable-container.editable-inline {
            width: 50%;
        }
        
        
        #items .editableform {
            margin-bottom: 0;
            position: absolute;
            left: 60px;
            background-color: white;
            z-index: 1;
            margin-top: 8px;
            width: 50%;

        }
        
        /* Dragging */
        .drag-handle {
            margin-top: 8px;
            position: absolute;
            right: 60px;
            z-index: 1;
        }
        
        .js-remove {
            position: absolute;
            right: 20px;
            z-index: 1;
            margin-top: 8px;
            margin-right: 10px;
            font: bold 20px Sans-Serif;
            color: #5F9EDF;
            display: inline-block;
            cursor: pointer;
        }
        
        .js-edit, .js-save {
            margin-top: 8px;
            position: absolute;
            right: 100px;
            z-index: 1;
            margin-right: 10px;
            font: bold 20px Sans-Serif;
            color: #5F9EDF;
            display: inline-block;
            cursor: pointer;
        }
        
        .block-name {
           position: absolute;
           left: 60px;
           z-index: 1;
           margin-right: 10px;
           font-size: 14px;
           color: #5F9EDF;
           display: inline-block;
           background-color: white;
           padding-top: 8px;
            
        }
        
        .button-hover:hover {
            border: 1px solid #5f9edf;
            background-color: #ececec;
            border-radius: 3px;
        }
        
        /* summernote */
        .note-toolbar.panel-heading:before, .note-toolbar.panel-heading:after {
            content: "";
        }
        
      


    </style>


</head>
<body data-ma-header="purple-400">
    <?
    APP::Render('student/widgets/header', 'include', [
        'BackUp' => 'admin/backup/settings'
    ]);
    ?>
    <section id="main">
        <? APP::Render('student/user/lectures/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">            
                                <h2><a href="#" id="lecture" data-type="text" data-pk="<?=APP::Module('Crypt')->Encode($data['id']); ?>" data-title=""><?=$data['name']; ?></a>
                                    <small><?= $data['university'].' / '.$data['faculty'] ?></small>
                                </h2>
                                 <ul class="actions">
                                   <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i> <span class="time"> <?= $data['date_last_update'] ?></span>
                                </ul>
                            </div>
                            <div class="card-body card-padding  ">
                               
                                <div class="panel-group" role="tablist" aria-multiselectable="true">

                                    <ul id="items">
                                       

                                    </ul>

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
    <script src="<?=APP::Module('Routing')->root ?>public/plugins/sortable/Sortable.js" type="text/javascript"></script>
    <script src="<?=APP::Module('Routing')->root ?>public/ui/vendors/summernote/dist/summernote-updated.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/shortcuts/shortcut.js" type="text/javascript"></script>
    
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
  <!--  <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/locale/ru.js" type="text/javascript"></script> -->
    
    
   <? APP::Render('core/widgets/js') ?>
     

    <script>
    $(document).ready(function() {
         
        var ago = moment($('.time').text()).fromNow();
        $('.time').text(ago);
     
        
       shortcut.add("Ctrl+s",function() {
                $('.js-save').trigger('click');
    });   
        
         function getList() {
             
             var data = {
                 name: 'get-list',
                 pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>'
             }
             
             $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/get/list.json',
                    data: data ? data : [0],
                    success: function (result) {
                        
                         $.each(result, function( i, value ) {
                             
                           value.body = (value.body !== '0')?value.body:'';

                           var el = document.createElement('li');
			   el.innerHTML = 
                                    '<span class="js-save waves-effect hidden"  data-item="'+ value.id_block +'"><i class="zmdi zmdi-save zmdi-hc-fw"></i></span>' +
                                            '<span class="js-edit waves-effect" data-item="'+ value.id_block +'"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                                            '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +
                                            '<span class="drag-handle"><i class="zmdi zmdi-swap-vertical zmdi-hc-fw"></i></span>' +
                                            '<div id="block-name-'+ value.id_block +'" data-name="block-edit-name" data-pk="'+ value.id_block +'" data-id="'+ value.id_block +'" class="block-name">'+ value.name +'</div>' +
                                            '<div class="panel panel-collapse">' +
                                                '<div class="panel-heading" role="tab" id="heading-'+ value.id_block +'">' +
                                                    '<h4 class="panel-title">' +
                                                        '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-'+ value.id_block +'" aria-expanded="false" aria-controls="collapse-'+ value.id_block +'">' +
                                                            '.'+
                                                        '</a>' +
                                                    '</h4>' +
                                                '</div>' +
                                                '<div id="collapse-'+ value.id_block +'" aria-expanded="false" class="collapse" role="tabpanel" aria-labelledby="heading-'+ value.id_block +'">' +
                                                    '<div  class="panel-body">' +
                                                        '<div id="html-editor-'+ value.id_block +'">' +
                                                         value.body +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
			sortable.el.appendChild(el);
                           
                           
                    });
                    refresh();

                    }
                });  
        }
        
        
        
        var el = document.getElementById('items');
        var sortable = Sortable.create(el,{
            filter: '.js-remove',
            handle: '.drag-handle',
            animation: 150,
            onFilter: function (evt) {
                var el = sortable.closest(evt.item); // get dragged item
                el && el.parentNode.removeChild(el);
              
            var item = $(el).find('.block-name').data('id');
            deleteBlock(item)
      
                
                updateStruct();
        }, 
        
            onEnd: function (/**Event*/evt) {
                evt.oldIndex;  // element's old index within parent
                evt.newIndex;  // element's new index within parent
                updateStruct();
                
        }
                   
        });
        
        function deleteBlock(item) {
            var data = {
                 name: 'remove-block',
                 item: item
             }
             
             console.log(data);
             
             $.ajax({
                    async: false,
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/delete/block.json',
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
                
                $.each(items, function( i, value ) {
                        index[i] = $(value).data('pk');
                });
                
                var data = {
                 name: 'update-index',
                 pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                 index: index
             }
             
             $.ajax({
                    async: false,
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                    data: data ? data : [0],
                    success: function (result) {
                        //console.log(result);

                    }
                });   
        };
        
       function refresh() {
            $('.js-edit').unbind();
             
             $('.js-edit').on('click', function() {    
             var item = $(this).data('item');
             if(!$('#collapse-' + item).hasClass('in')) {
                $('#heading-'+item+' a').trigger('click');
            }
             $(this).addClass('hidden');
             $(this).prev().removeClass('hidden');
            
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
           url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
           mode: 'inline',
           params: function (params) {
                params.lecture =  '<?= APP::Module('Crypt')->Encode($data['id']); ?>';          
                return params;
            },
           
               success: function(response, newValue) {
                    if(response.status == 'error') {
                        console.log('error update DB')
                    } 
                }
    });
        
        $('.js-save').on('click', function() {
            
             var item = $(this).data('item');
             var html_data = $('#html-editor-' + item).code();
             console.log(html_data);
             if(html_data == '<br>') {
                 $('#html-editor-' + item).code();
                 html_data = $('#html-editor-' + item).code()
             }
             if((!html_data) && ($('#collapse-' + item).hasClass('in'))) {
                $('#heading-'+item+' a').trigger('click');   
            }
             
             $('#html-editor-' + item).destroy();
                         $(this).addClass('hidden');
                         $(this).next().removeClass('hidden');
             
             var data = {
                 name: 'block-edit-body',
                 pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                 id_block: item,
                 block_name: $('#block-name-' + item).text(),
                 data: html_data
             }
             
             
             $.ajax({
                    type: 'post',
                    async: false,
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/block.json',
                    data: data ? data : [0],
                    success: function (result) {
                        console.log(result);

                    }
                });
        });
              
        }
        
       refresh();
        
        // использование Math.round() даст неравномерное распределение!
        function getUniqRandomInt(min, max, items){
          var id =  Math.floor(Math.random() * (max - min + 1)) + min;
    
          if (!$.inArray(id, items)) {
             // console.log(id,items);
                getUniqRandomInt(min,max,items);
          } else {
                return id;
          }
        };

        $('#add-block').on('click', function() {
            
                        var items= [];
                        $('.js-edit').each(function(){
                            items.push($(this).data('item'));
                        });
                       
                        var id = getUniqRandomInt(1000,9999,items);                     
			var el = document.createElement('li');
			el.innerHTML = 
                                    '<span class="js-save waves-effect hidden"  data-item="'+ id +'"><i class="zmdi zmdi-save zmdi-hc-fw"></i></span>' +
                                            '<span class="js-edit waves-effect" data-item="'+ id +'"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></span>' +
                                            '<span class="js-remove waves-effect"><i class="zmdi zmdi-close zmdi-hc-fw"></i></span>' +
                                            '<span class="drag-handle"><i class="zmdi zmdi-swap-vertical zmdi-hc-fw"></i></span>' +
                                            '<div id="block-name-'+ id +'" data-name="block-edit-name" data-pk="'+ id +'" data-id="'+ id +'" class="block-name">Name block</div>' +
                                            '<div class="panel panel-collapse">' +
                                                '<div class="panel-heading" role="tab" id="heading-'+ id +'">' +
                                                    '<h4 class="panel-title">' +
                                                        '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-'+ id +'" aria-expanded="true" aria-controls="collapse-'+ id +'">' +
                                                            '.'+
                                                        '</a>' +
                                                    '</h4>' +
                                                '</div>' +
                                                '<div id="collapse-'+ id +'" class="collapse in" role="tabpanel" aria-labelledby="heading-'+ id +'">' +
                                                    '<div  class="panel-body">' +
                                                        '<div id="html-editor-'+ id +'">' +                                                           
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
			sortable.el.appendChild(el);
                        
                        
                        var data = {
                                action: 'create-block',
                                pk: '<?= APP::Module('Crypt')->Encode($data['id']); ?>',
                                id_block: id,
                                name: $('#block-name-' + id).text(),
                                index: $('#block-name-' + id).parent().index(),
                            }
             
             
                        $.ajax({
                               type: 'post',
                               url: '<?= APP::Module('Routing')->root ?>students/user/api/add/block.json',
                               data: data ? data : [0],
                               success: function (result) {
                                  // console.log(result);

                               }
                           });
                           
                        updateStruct();
                        refresh();	
	}); 
        
         //editables 
    $('#lecture').editable({
           url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/lecture.json',
           mode: 'inline',
               success: function(response, newValue) {
                    if(response.status == 'error') {
                        console.log('error update DB')
                    }
                }
    });
    
});
    </script>
    
     

</body>
</html>

