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

   

     <? APP::Render('core/widgets/css') ?>
    <style type="text/css">
        .toggle-switch {
            margin-top: 10px;
        }

        .h-logo a small {
            font-size: 14px;
        }

        .main-menu {
            padding-top: 120px;
        }
        
        .select2-container {
            margin-top: 8px;
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
        <? APP::Render('student/widgets/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Create new lecture
                                    <small>The first step requires to make the body of lecture</small>
                                </h2>
                            </div>
                            <div class="card-body card-padding">
                                <form method="Post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="zmdi zmdi-sun"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" placeholder="discipline name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span>
                                                <div class="fg-line">
                                                    <select id="country">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" placeholder="city" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-graduation-cap"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" placeholder="institute" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>

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
    
    <!-- Module addition Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>/public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    

<? APP::Render('core/widgets/js') ?>

      <script>

$('#country').select2({
    placeholder: "Country",
    minimumInputLength: 3,
  ajax: {
    dataType: 'json',
    type: 'POST',
    url: '<?= APP::Module('Routing')->root ?>students/api/get/country.json',
    delay: 500,
   
    processResults: function (data) {
        return {
            results: $.map(data, function (item) {
                return {
                    text: item.name,
                    id: item.id
                }
            })
        };
    },
     
  },
  


  width: '100%',
});




   
           </script>

</body>
</html>

  
