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
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/Croppie/croppie.css" rel="stylesheet" type="text/css"/>
    <!-- Module Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/farbtastic/farbtastic.css" rel="stylesheet" type="text/css"/>


     <? APP::Render('core/widgets/css') ?>
    <style type="text/css">
        .toggle-switch {
            margin-top: 4px;
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
        
        #lectures-table td {
            padding: 0px 15px;
        }
        
        #lectures-table td a {
            padding:15px;
            display: block;
            width: 100%;
        }
        
        #upload-photo {
            display: none; 
        }
        
        #upload-photo.ready {
         display: block;
        }
        
        #default-photo {
          
           background-color: rgb(237, 236, 236);
           width: 100%;
           height: 260px;
           overflow: hidden;
        }
        
        #default-photo img {
         
            width: 100%;
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
        }

        #default-photo img:hover {
            -webkit-transform: scale(1.3);
            transform: scale(1.3);
        }
        
        #default-photo div  {
            position: absolute;
            bottom: 40px;
            width: calc(100% - 60px);
            left: 0;
            margin-left: 30px;
            text-align: center;
            background-color: rgba(156, 156, 156, 0.72);
            padding: 10px;
            color: white;
            cursor: pointer;
            transition: .5s ease-in-out;
           
        }
        
         #default-photo div:hover {
             background-color: rgba(171, 71, 188, 0.72);
         }
         
         #upload-buttons {
             margin-top: 20px;
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
                   
                    
                    <div class="col-md-3 col-sm-5 col-xs-6 container-image">
                        <div class="card">
                           
                            <div class="card-body card-padding">
                                
                                <div id="upload-photo">
                                   
                                </div>
                               
                                <div id="upload-buttons" class="btn-group btn-group-justified hidden" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                        <button id="upload-reset" type="button" class="btn palette-Purple-400 bg waves-effect">Remove</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button id="upload-result" type="button" class="btn palette-Purple-400 bg waves-effect">Upload</button>
                                    </div>
                                </div>

                                <div id="default-photo">
                                    <? if($data['user_settings']['img_crop'] != NULL) {
                                         echo ' <img src="'.$data['user_settings']['img_full'].'"/>';
                                    } 
                                    else {
                                        echo ' <img style="padding:30px;" src="'.APP::Module('Routing')->root.'public/modules/students/img/social.svg"/>';
                                    } ?>
                                    
                                   
                                    <div id="upload">
                                        Upload image
                                    </div>
                                    <input id="input-photo" class="hidden" name="upload" type="file">
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="card">
                           
                            <div class="card-body card-padding">
                                <div class="form-group">
                                <div class="fg-line">
                                    <textarea id="user_about" class="form-control" rows="5" placeholder="Short about youself...."><?= $data['user_settings']['about'] ?></textarea>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                    
                     <div class="col-md-9 col-sm-7 col-xs-6">
                        <div class="card">
                            <div class="card-header">
                                <h2>Personal settings
                                </h2>
                            </div>
                            <div class="card-body card-padding">
                                <div class="row">
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span> 
                                                <div class="fg-line">
                                                    <input value="<?= $data['user_settings']['first_name'] ?>" id="user_first_name" class="form-control" placeholder="first name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span> 
                                                <div class="fg-line">
                                                    <input value="<?= $data['user_settings']['last_name'] ?>" id="user_last_name" class="form-control" placeholder="last name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>    
                                                <div class="fg-line">
                                                    <input value="<?= $data['user_settings']['email'] ?>" id="user_email" class="form-control" placeholder="email" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>    
                                                <div class="fg-line">
                                                    <input value="<?= $data['user_settings']['phone'] ?>" id="user_phone" class="form-control input-mask" data-mask="0 (000) 000 - 0000" placeholder="phone"  type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                     <div class="col-md-9 col-sm-7 col-xs-6">
                        <div class="card">
                            <div class="card-header">
                                <h2>Education template
                                    
                                </h2>
                                
                                
                                <ul class="ah-actions actions a-alt">
                                    <li>

                                        <div class="toggle-switch" >
                                            <label for="lang" class="ts-label">Russian</label>
                                            <input id="lang" type="checkbox" hidden="hidden">
                                            <label for="lang" class="ts-helper"></label>
                                            <label for="lang" class="ts-label m-l-20">English</label>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="btn-group">
                                        <button id="submit-save" class="btn palette-Teal bg btn-icon-text waves-effect"><i class="zmdi zmdi-save "></i> Save</button>
                                    
                                   
                                        <button id="submit-reset" class="btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i> Reset</button>
                                        </div>
                                        </li>
                                </ul>
                                
                                
                            </div>
                            <div class="card-body card-padding">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="zmdi zmdi-sun"></i></span>
                                                <div class="fg-line">
                                                    <input id="lecture" class="form-control" value="<?= $data['user_template']['name']; ?>" placeholder="specialisation programm" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span>
                                                <div class="fg-line ">
                                                    <select class="select2" data-def_id ="<?= $data['user_template']['id_country']; ?>" value="<?= $data['user_template']['country']; ?>" id="country" data-ph="country" data-set="country">
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
                                                     <select class="select2" data-def_id ="<?= $data['user_template']['id_city']; ?>" value="<?= $data['user_template']['city']; ?>" id="city" data-ph="city" data-set="city">
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
                                                    <select class="select2" id="university" data-def_id ="<?= $data['user_template']['id_university']; ?>" value="<?= $data['user_template']['university']; ?>" data-ph="university"  data-set="university">
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
                                                    <select class="select2" data-def_id ="<?= $data['user_template']['id_faculty']; ?>" value="<?= $data['user_template']['faculty']; ?>" id="faculty" data-ph="faculty"  data-set="faculty">
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
                                                    <select class="select2" data-def_id ="<?= $data['user_template']['id_chair']; ?>" value="<?= $data['user_template']['chair']; ?>" id="chair" data-ph="chair"  data-set="chair">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-eye"></i></span>
                                                <div class="fg-line">
                                                     <select id="user_priv_view" class="selectpicker">                                                      
                                                        <option value="0">for all</option>                                                       
                                                        <option value="1">for groups </option>                                                     
                                                        <option value="2">for friends </option>
                                                        <option value="3">looked for all </option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fg-line form-group">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-edit"></i></span>
                                                <div class="fg-line">
                                                     <select id="user_priv_edit" class="selectpicker">                                                      
                                                        <option value="0">for all</option>                                                       
                                                        <option value="1">for groups </option>                                                     
                                                        <option value="2">for friends </option>
                                                        <option value="3">looked for all </option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
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
  <!--  <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script> -->
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>

    <!-- Module addition Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/Croppie/croppie.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/fileinput/fileinput.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/input-mask/input-mask.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/farbtastic/farbtastic.min.js" type="text/javascript"></script>
    
<? APP::Render('core/widgets/js') ?>

    <script>
    $(document).ready(function() {
        
        function demoUpload() {
		var $uploadCrop;

		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('#default-photo').addClass('hidden');
					$('#upload-photo').addClass('ready');
                                        $('#upload-buttons').removeClass('hidden');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		$uploadCrop = $('#upload-photo').croppie({
			viewport: {
				width: 100,
				height: 100,
				type: 'square'
			},
			boundary: {
				width: $('upload-photo').width(),
				height: 160
			},
			enableExif: false
		});
                
                $('#upload').on('click',function() {
                  
                    $('#input-photo').trigger('click');
                })

		$('#input-photo').on('change', function () { readFile(this); });
                
		$('#upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
                                                     
                           var data = {
                                id_hash: '<?= APP::Module('Crypt')->Encode(APP::Module('Users')->user['id']) ?>',
                                action: 'image-crop',
                                data: resp
                            }
                            
                            var img_crop = data.data;
                            
                            $.ajax({
                                type: 'post',
                                url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                                data: data ? data : [0],
                                success: function (result) {

                                    $uploadCrop.croppie('result', {
                                        type: 'canvas',
                                        size: 'original'
                                    }).then(function (resp) {

                                        var data = {
                                             id_hash: '<?= APP::Module('Crypt')->Encode(APP::Module('Users')->user['id']) ?>',
                                             action: 'image-full',
                                             data: resp
                                         }
                                         
                                         var img_full = data.data;

                                         $.ajax({
                                             type: 'post',
                                             url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                                             data: data ? data : [0],
                                             success: function (result) {
                                                
                                                $('#default-photo img').attr('src',img_full).removeAttr('style');
                                                $('#default-photo').removeClass('hidden');
					        $('#upload-photo').removeClass('ready');
                                                $('#upload-buttons').addClass('hidden');
                                                
                                             } 
                                         });

                                    });

                                } 
                            });
                            
			});
		});
                
	}
        
        demoUpload();
        
        
            // SERVER MODE
        var flag, check;
        function checkMode() {

           if(flag !== 1) {
               check = '<?= $data['user_settings']['lang'] ?>';
           }
               if(check == 1) {
                   $('#lang').attr("checked", true);
               }  
       }

        checkMode();

        $('#lang').bind('click', function(){
                   check = (check == 1)?0:1;
                   checkMode();
               });

        flag = 1;    
            
            
         $('#submit-reset').on('click', function(event) {
            event.preventDefault();
            
            $.each($('.select2'), function() {
                $(this).val('').trigger('change');          
            });
            
            $('#lecture').val('');
            
        });

        
        $('#submit-save').on('click', function(event) {
            event.preventDefault();
                       
            var first_name = $('#user_first_name');
            var last_name = $('#user_last_name');
            var email = $('#user_email');
            var phone = $('#user_phone');
            var about = $('#user_about');
            var lecture = $('#lecture');
            var country = $('#country :selected');
            var city = $('#city :selected');
            var university = $('#university :selected');
            var faculty = $('#faculty :selected');
            var chair = $('#chair :selected');
            
            var priv_view = ($('#user_priv_view'))[0]['value'];
            var priv_edit = ($('#user_priv_edit'))[0]['value'];
            var lang = $('#lang:checked');
            
            
            first_name.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
            last_name.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
            email.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
            phone.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
            
             if (first_name.val() === '') {
                    first_name.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                
             if (last_name.val() === '') {
                    last_name.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                
             if (email.val() === '') {
                    email.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                
             if (phone.val() === '') {
                    phone.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                
            var data = {
                action: 'main-info',
                id_hash: '<?= APP::Module('Crypt')->Encode($data['user_settings']['id']); ?>',
                first_name: first_name.val()?first_name.val():'NULL',
                last_name: last_name.val()?last_name.val():'NULL',
                email: email.val()?email.val():'NULL',
                phone: phone.val()?phone.val():'NULL',
                about: about.val()?about.val():'NULL',
                lecture: lecture.val()?lecture.val():'NULL',
                id_country: country.val()?country.val():'NULL',
                country: country.text()?country.text():'NULL',
                id_city: city.val()?city.val():'NULL',
                city: city.text()?city.text():'NULL',
                id_university: university.val()?university.val():'NULL',
                university: university.text()?university.text():'NULL',
                id_faculty: faculty.val()?faculty.val():'NULL',
                faculty: faculty.text()?faculty.text():'NULL',
                id_chair: chair.val()?chair.val():'NULL',
                chair: chair.text()?chair.text():'NULL',
                
                priv_view: priv_view,
                priv_edit: priv_edit,
                lang: lang.val()?1:0
                }
                
                
                
                
                 $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                    data: data,
                    success: function (result) {
                        switch (result.status) {
                            case 'success':
                              
                                swal({
                                    title: 'Done!',
                                    text: 'Sessions settings has been updated',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: true
                                });
                                
                                break;
                            case 'error':
                                $.each(result.errors, function (i, error) {});
                                break;
                        }
                    }
                });
            
        });
        
        
        $.each($('.select2'), function() {
        if((def_value !=='') || (def_value !== 0)) {
           // add saved value
           var def_value = $(this).attr('value');
           var def_id = $(this).data('def_id');
           $(this).find('option').attr('value', def_id).text(def_value);
       }
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
                   width: '100%'

                   });
           });
});
    </script>

</body>
</html>


