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

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 0px;
            border-bottom: 1px solid #e0e0e0;;
            border-radius: 0px;
        }
        
      
        .fg-line:not(.form-group) {
            padding-left: 8px;
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
                                                    <input id="lecture" class="form-control" placeholder="discipline name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span>
                                                <div class="fg-line ">
                                                    <select class="select2" id="country" data-ph="country" data-set="country">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                                <div class="fg-line">
                                                     <select class="select2" id="city" data-ph="city" data-set="city">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-graduation-cap"></i></span>
                                                <div class="fg-line">
                                                    <select class="select2" id="university" data-ph="university"  data-set="university">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-accounts"></i></span>
                                                <div class="fg-line">
                                                    <select class="select2" id="faculty" data-ph="faculty"  data-set="faculty">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                <div class="fg-line">
                                                    <select class="select2" id="chair" data-ph="chair"  data-set="chair">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="fg-line form-group">
                                                <div id="create-lecture" class="btn palette-Purple-400 bg waves-effect btn-lg">Create</div>
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
    $(document).ready(function() {
        
        $('#create-lecture').on('click',function(event) {
                    event.preventDefault();
                    
                     var lecture = $('#lecture');
                     var country = $('#country :selected');
                     var city = $('#city :selected');
                     var university = $('#university :selected');
                     var faculty = $('#faculty :selected');
                     var chair = $('#chair :selected');
                     
                     lecture.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                     country.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                     city.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                     university.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                     faculty.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                     chair.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();                                   
                    
                    if (lecture.val() === '') { lecture.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-12').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>'); return false; }
                    if (country.text() === '') { country.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>'); return false; }
                    if (city.text() === '') { city.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>'); return false; }
                    if (university.text() === '') { university.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-6').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>'); return false; }
                    if (faculty.text() === '') { faculty.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-5').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>'); return false; }
                    if (chair.text() === '') { chair.text('none')  }
                  
                    $(this).find('#create-lecture').html('Processing...').attr('disabled', true);
                    
                    var data = {
                        lecture: lecture.val(),
                        country: country.text(),
                        city: city.text(),
                        university: university.text(),
                        faculty: faculty.text(),
                        chair: chair.text(),
                    }
                    
                    
                    
                     $.ajax({
                        type: 'post',
                        url: '<?= APP::Module('Routing')->root ?>students/user/api/add/lecture.json',
                        data: $.param(data),
                        success: function(result) {
                            switch(result.status) {
                                case 'success':
                                    window.location.replace('<?= APP::Module('Routing')->root ?>students/user/lecture/' + result.hash + '/edit');
                                case 'error': 
                                    $.each(result.errors, function(i, error) {});
                                    break;
                            }

                            $('#update-settings').find('[type="submit"]').html('Save changes').attr('disabled', false);
                        }
                    });
        });

        $.each($('.select2'), function() {
            $(this).select2({
                placeholder: $(this).attr('id'),
                minimumInputLength: 3,
                ajax: {
                  dataType: 'json',
                  type: 'POST',
                  data: function (params) {
                    var query = {
                      search: params.term,
                      page: params.page,
                      set: $(this).data('set'),
                      // set specific fields
                      id_country: ($('#country'))?$('#country').val():"",
                      id_city: ($('#city'))?$('#city').val():"",
                      id_university: ($('#university'))?$('#university').val():"",
                      id_faculty: ($('#faculty'))?$('#faculty').val():"",
                    }
                    return query;
                },
                  url: '<?= APP::Module('Routing')->root ?>students/user/api/get/vkdata.json',
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
        });


});
    </script>

</body>
</html>


