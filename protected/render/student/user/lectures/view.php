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
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/sortable/st/app.css" rel="stylesheet" type="text/css"/>

    <? APP::Render('core/widgets/css') ?>
    <link href="<?= APP::Module('Routing')->root ?>public/modules/students/main.css" rel="stylesheet" type="text/css"/>

</head>
<body id="module-student">

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
<? APP::Render('student/user/lectures/sidebar', 'include', ['page' => 'lecture_view']) ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">            
                                <h2><?= $data['name']; ?>
                                    <small><?= $data['university'] . ' / ' . $data['faculty'] ?></small>
                                </h2>

                                <ul class="actions">
                                    <li>
                                        <div class="input-group time-container">  
                                            <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i> <span class="time"> <?= $data['date_last_update'] ?></span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="dropdown m-l-25">
                                            <a href="#" class="dropdown-toggle btn palette-Purple-400 bg waves-effect" data-toggle="dropdown"><i class="zmdi zmdi-menu"></i></a>
                                            <ul class="dropdown-menu pull-right dm-icon ">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-share"></i>Share</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-copy"></i>Copy</a></li>
                                                <li class="divider"></li>
                                                <li role="presentation"><a id="action-delete" role="menuitem" tabindex="-1" href="#"><i class="zmdi zmdi-lock-open"></i>Request to access</a></li>
                                            </ul>
                                        </div> 
                                    </li>
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
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/sortable/Sortable.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/shortcuts/shortcut.js" type="text/javascript"></script>
    <script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>
    <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
 <!--  <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/locale/ru.js" type="text/javascript"></script> -->

<? APP::Render('core/widgets/js') ?>


    <script>
        $(document).ready(function () {

            var ago = moment($('.time').text()).fromNow();
            $('.time').text(ago);

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

                        $.each(result, function (i, value) {

                            value.body = (value.body !== '0') ? value.body : '';

                            var el = document.createElement('li');
                            el.innerHTML =
                                    '<div id="block-name-' + value.id_block + '" data-name="block-edit-name" data-pk="' + value.id_block + '" data-id="' + value.id_block + '" class="block-name">' + value.name + '</div>' +
                                    '<div class="panel panel-collapse">' +
                                    '<div class="panel-heading" role="tab" id="heading-' + value.id_block + '">' +
                                    '<h4 class="panel-title">' +
                                    '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' + value.id_block + '" aria-expanded="false" aria-controls="collapse-' + value.id_block + '">' +
                                    '.' +
                                    '</a>' +
                                    '</h4>' +
                                    '</div>' +
                                    '<div id="collapse-' + value.id_block + '" aria-expanded="false" class="collapse" role="tabpanel" aria-labelledby="heading-' + value.id_block + '">' +
                                    '<div  class="panel-body">' +
                                    '<div id="html-editor-' + value.id_block + '">' +
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
            var sortable = Sortable.create(el, {
                animation: 150
            });

            getList();
        });
    </script>



</body>
</html>


