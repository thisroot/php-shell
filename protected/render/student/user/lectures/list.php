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
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootgrid/jquery.bootgrid.min.css" rel="stylesheet">

    <!-- Module Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>



     <? APP::Render('core/widgets/css') ?>
    <link href="<?= APP::Module('Routing')->root ?>public/modules/students/main.css" rel="stylesheet" type="text/css"/>
    

</head>
<body  id="module-student">
     <!-- Render Header -->
   <? APP::Render('student/widgets/header', 'include', [
       'img' => APP::Module('Student')->user_data['user_settings']['img_crop']
           ]); ?>
     <!-- Stop Render Header -->
    <section id="main">
        <? APP::Render('student/widgets/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Lectures list
                                    <small>see youself lectures</small>
                                </h2>
                            </div>
                            <div class="card-body">
                                
                               <table class="table table-hover table-vmiddle" id="lectures-table">
                                <thead>
                                    <tr>
                                        <th data-column-id="id" data-formatter="link" data-visible="false" data-width="20%">ID</th>
                                        <th data-column-id="name" data-formatter="link">Name</th>
                                        <th data-column-id="city" data-formatter="link" data-visible="false" data-width="20%">City</th>
                                        <th data-column-id="country" data-formatter="link" data-visible="false" data-width="20%">Country</th>
                                        <th data-column-id="university" data-formatter="link" data-visible="false" data-width="20%">University</th>
                                        <th data-column-id="faculty" data-formatter="link" data-visible="false" data-width="20%">Faculty</th>
                                        <th data-column-id="chair" data-formatter="link" data-visible="false" data-width="20%">Chair</th>
                                        <th data-column-id="date" data-formatter="link" data-order="desc" data-visible="false" data-width="20%">Data</th>
                                        <th data-column-id="actions" data-formatter="actions" data-width="20%">Actions</th>
                                    </tr>
                                </thead>
                               </table>

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
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>

    <!-- Module addition Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/shortcuts/shortcut.js" type="text/javascript"></script>


<? APP::Render('core/widgets/js') ?>

   <script>
            $(document).ready(function() {
                
                var connections_table = $("#lectures-table").bootgrid({
                    rowCount: [4,10,20],
                    ajax: true,
                    ajaxSettings: {
                        method: 'POST',
                        cache: false
                    },
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/get/lectures/list.json',
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-chevron-down pull-left',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-chevron-up pull-left'
                    },
                    sorting: false,
                    formatters: {
                        actions: function(column, row) {                                           
                                 return     '<a href="javascript:void(0)" class="btn btn-sm btn-default btn-icon waves-effect waves-circle remove-lecture" data-id_hash="'  + row.id_hash  + '"><span class="zmdi zmdi-delete"></span></a>';
                        },
                                
                          link: function(column, row){
                                return '<a class="link" href="<?= APP::Module('Routing')->root ?>students/user/lecture/' + row.id_hash + '">' + row.name + '</a>';
                        }       
                    }
                }).on('loaded.rs.jquery.bootgrid', function () {
                
                    connections_table.find('.remove-lecture').on('click', function (e) {
                        var id_hash = $(this).data('id_hash');
                        swal({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this backup point',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            showLoaderOnConfirm: true
                        }, function(isConfirm){
                            if (isConfirm) {
                                $.post('<?= APP::Module('Routing')->root ?>students/user/api/delete/lecture.json', {
                                    id_hash: id_hash
                                }, function() { 
                                    connections_table.bootgrid('reload', true);
                                    swal('Deleted!', 'Point of backup has been deleted', 'success');
                                });
                            }
                        });
                    });
                    
                   
                    
                    $('#add-backup').on('click', function (e) {
                    
                        swal({
                            title: 'Are you sure?',
                            text: 'That you want to create point of backup',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            showLoaderOnConfirm: true
                        }, function(isConfirm){
                            if (isConfirm) {
                                $.post('<?= APP::Module('Routing')->root ?>admin/backup/api/add.json', {
                                  
                                }, function() { 
                                    connections_table.bootgrid('reload', true);
                                    swal('Restored!', 'Point of backup has been created', 'success');
                                });
                            }
                        });
                    });
                });
            });
            
            
        </script>

</body>
</html>


