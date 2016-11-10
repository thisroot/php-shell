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
        
        #lectures-table td {
            padding: 0px 15px;
        }
        
        #lectures-table td a {
            padding: 10px 0px;
            display: block;
            width: 100%;
        }
        
        #module-student #content a, #module-student .card-header h2, #module-student .input-group-addon   {
            color: #7e57c2;
        }
        
        

    </style>


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
        <? APP::Render('student/widgets/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div style="padding:5px" class="card-header">
                                
                            </div>
                            <div class="card-body">

                                 <table class="table table-hover table-vmiddle" id="lectures-table">
                                <thead>
                                    <tr>
                                        <th class="th-link" data-column-id="id" data-visible="false" data-width="20%">ID</th>
                                        <th class="th-link"  data-column-id="name" data-formatter="link">lectures</th>
                                        <th data-width="10%" data-column-id="privacy" data-formatter="privacy"></th>
                                      
                                    </tr>
                                </thead>
                               </table>
                                
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                               <h2>By tags
                                    
                                </h2>
                            </div>
                            <div class="card-body card-padding">

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
                        </div>

                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h2>By users</h2>
                            </div>
                            <div class="card-body card-padding">
                                
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
    <script src="<?= APP::Module('Routing')->root ?>/public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/locale/ru.js" type="text/javascript"></script> 


<? APP::Render('core/widgets/js') ?>

    <script>
    $(document).ready(function() {
        
       

        $("#lectures-table").bootgrid({
                labels: {
                    loading:  
                        '<div class="preloader pls-purple p-t-25">' + 
                                '<svg class="pl-circular" viewBox="25 25 50 50">' + 
                                    '<circle class="plc-path" cx="50" cy="50" r="20"></circle>' +
                                '</svg>' + 
                            '</div>'
                },
                
                searchSettings: {
                    delay: 500,
                    characters: 3
                    },
                    rowCount: [10,30,60],
                    ajax: true,
                    ajaxSettings: {
                        method: 'POST',
                        cache: false
                    },
                    url: '<?= APP::Module('Routing')->root ?>students/api/get/lectures/list.json',
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-chevron-down pull-left',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-chevron-up pull-left'
                    },
                    sorting: false,
                    formatters: {
         
                        link: function(column, row){
                        return    '<a href="<?= APP::Module('Routing')->root ?>students/user/lecture/' + row.id_hash + '">' +
                            '<div class="list-group-item media">'+
                                    '<div class="pull-left"><img class="avatar-img" src="'+ row.img +'" alt=""></div>'+
                                    '<div class="pull-right p-t-10"><div class="time">'+ moment(row.date).fromNow() +'</div></div>' +
                                            '<div class="media-body"><div class="lgi-heading">' + row.name + '</div>'+
                                            '<small class="lgi-text">'+row.country+' | '+ row.city +' | '+ row.university +'</small></div></div></a>';
 
                              //  return '<a href="<?= APP::Module('Routing')->root ?>students/user/lecture/' + row.id_hash + '">' + row.name + '</a>';
                        },
                       privacy: function(column,row) {
                           if(row.edit == 1) {
                               return '<a href="<?= APP::Module('Routing')->root ?>students/user/lecture/' + row.id_hash + '">' +
                                       '<button class="btn palette-Deep-Purple-300 bg waves-effect"><i class="zmdi zmdi-edit"></i></button></a>'
                        } else {
                                return '<a href="<?= APP::Module('Routing')->root ?>students/user/lecture/' + row.id_hash + '">' +
                                        '<button class="btn palette-Deep-Purple-300 bg waves-effect"><i class="zmdi zmdi-eye"></i></button></a>'
                            }
                        }                       
                        },
                     requestHandler : function (request) {
                       
                        request.university = $('#university :selected').text().replace(/\s+/g,' ');
                        request.faculty = $('#faculty :selected').text().replace(/\s+/g,' ');
                        request.chair = $('#chair :selected').text().replace(/\s+/g,' ');
                        request.id_user_hash = '<?= APP::Module('Crypt')->Encode(isset(APP::Module('Users')->user['id'])?APP::Module('Users')->user['id']:'default') ?>';
                     
                        return request;
                    }    
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
                      lang: 'RU',
                      type: 'filter'
                    
                    };
                    return query;
                },
                  url: '<?= APP::Module('Routing')->root ?>students/user/api/get/filter/lectures.json',
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
                }).on('change', function (evt) {
                  
                    //    $(".search-field").trigger("keypress")
                    var searchTimeout = null;
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function () {
                        $('#lectures-table').bootgrid('reload');
                    }, 500);
                });            
        });
        
      


});
    </script>

</body>
</html>


