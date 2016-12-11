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
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <? APP::Render('core/widgets/css') ?>
    <link href="<?= APP::Module('Routing')->root ?>public/modules/students/main.css" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        .toggle-switch {
            margin-top: 10px;
        }

        .h-logo a {
            font-size: 14px;
        }

        .main-menu {
            padding-top: 120px;
        }

        .not-active {
            pointer-events: none;
            cursor: default;
        }
    </style>

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
    APP::Render('student/widgets/header', 'include', [
        'img' => $data['user_settings']['img_crop']
    ]);
    ?>
    <!-- Stop Render Header -->
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
                                    <?
                                    if ($data['user_settings']['img_crop'] != NULL) {
                                        echo ' <img src="' . $data['user_settings']['img_crop'] . '"/>';
                                    } else {
                                        echo ' <img style="padding:30px;" src="' . APP::Module('Routing')->root . 'public/modules/students/img/social.svg"/>';
                                    }
                                    ?>


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
                                                    <input value="<?= $data['user_settings']['email'] ?>" id="user_email" class="form-control" placeholder="email" type="email">
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

                            <div class="card-body p-t-25 p-l-25 p-r-25">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">

                                            <div class="dropdown">
                                                <button type="button" data-toggle="dropdown" aria-expanded="false"  class="btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-graduation-cap "></i>Create unit</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="unit-add" data-unit="university" href="#">High school</a></li>
                                                    <li><a class="unit-add" data-unit="school" href="#">Base school</a></li>
                                                    <li class="divider"></li>
                                                    <li><a class="unit-add" data-unit="sertification" href="#">Sertification</a></li>
                                                    <li><a class="unit-add" data-unit="courses" href="#">Courses</a></li>
                                                    <li class="divider"></li>
                                                    <li><a class="unit-add" data-unit="internal" href="#">Internal</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="fg-line form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-eye"></i></span>
                                                <div class="fg-line">
                                                    <select id="user_priv_view" class="selectpicker">
                                                        <option value="0">for all</option>
                                                        <option value="1">for univercity </option>
                                                        <option value="2">for classmates </option>
                                                        <option value="3">looked for all </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="fg-line form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-edit"></i></span>
                                                <div class="fg-line">
                                                    <select id="user_priv_edit" class="selectpicker">
                                                        <option value="0">for all</option>
                                                        <option value="1">for university </option>
                                                        <option value="2">for classmates </option>
                                                        <option value="3">looked for all </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-groupt">
                                            <div class="input-group">
                                                <div class="toggle-switch" >
                                                    <label for="lang" class="ts-label">Russian</label>
                                                    <input id="lang" type="checkbox" hidden="hidden">
                                                    <label for="lang" class="ts-helper"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group pull-right">
                                            <div class="input-group">
                                                <button id="submit-save"  class="btn palette-Teal bg btn-icon-text waves-effect"><i class="zmdi zmdi-save "></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-7 col-xs-6">
                        <div class="row">
                            <div id="unit-data" class="hidden" data-id="<?= $data['user_units'] ? $data['user_units'][count($data['user_units']) - 1]['id_unit'] + 1 : 0 ?>"></div>
                            <div id="unit-block-internal" class="col-md-12 "></div>
                            <div id="unit-block-sertification" class="col-md-12 "></div>
                            <div id="unit-block-courses" class="col-md-12 "></div>
                            <div id="unit-block-university" class="col-md-12 "></div>
                            <div id="unit-block-school" class="col-md-12 "></div>
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
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootstrap-growl/bootstrap-growl.min.js" type="text/javascript"></script>

    <!-- Module addition Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/Croppie/croppie.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/fileinput/fileinput.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/input-mask/input-mask.min.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/farbtastic/farbtastic.min.js" type="text/javascript"></script>

    <!-- Module Script -->
    <script src="<?= APP::Module('Routing')->root ?>public/modules/students/main.js" type="text/javascript"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/min/moment.min.js" type="text/javascript"></script>
 <!--  <script src="<?= APP::Module('Routing')->root ?>public/plugins/moment/locale/ru.js" type="text/javascript"></script> -->

    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>



    <? APP::Render('core/widgets/js') ?>

    <script>
        $(document).ready(function () {
            function getUnits() {
                var data = <?= json_encode($data['user_units']); ?>;

                $.each(data, function (index, value) {
                    $.each(value, function(i,v) {
                        if (i != 'id_unit'){if ((v == 0) || (v == '1970-09-18 00:00:00')) {value[i] = '';}}
                    });
                    switch (value['unit']) {
                        case 'university':
                            var id_unit = value['id_unit'];
                            var unit_university = $('<div id="unit-' + id_unit + '" data-unit="university" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                                    '<h2>High school</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                                    '<button id="save-' + id_unit + '" data-action="edit" data-id="' + id_unit + '"   class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                                    '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                                    '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                                    '</div></li></ul></div><div class="card-body card-padding"><div class="row"><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                                    '<select class="select2" data-def_id ="'+value['id_country']+'" value="'+value['country']+'" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                                    '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_city']+'" value="'+value['city']+'" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                                    '<option></option></select></div></div> </div></div><div class="col-sm-6"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                                    '<select class="select2" id="university-' + id_unit + '" data-def_id ="'+value['id_university']+'" value="'+value['university']+'" data-ph="university"  data-set="university">' +
                                    '<option></option></select></div></div> </div></div><div class="col-sm-5"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-accounts"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_faculty']+'" value="'+value['faculty']+'" id="faculty-' + id_unit + '" data-ph="faculty"  data-set="faculty">' +
                                    '<option></option></select> </div></div></div></div><div class="col-sm-7"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_chair']+'" value="'+value['chair']+'" id="chair-' + id_unit + '" data-ph="chair"  data-set="chair">' +
                                    '<option></option></select></div></div></div></div>' +
                                    '<div class="col-md-12"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-sun"></i></span><div class="fg-line">' +
                                    '<input id="specialisation-' + id_unit + '" value="'+value['specialisation']+'" class="form-control" placeholder="specialisation programm" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-4"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                                    '<input id="group-' + id_unit + '" value="'+value['index_group']+'" class="form-control" placeholder="group index" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-sm-4"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-graduation-cap"></i></span> <div class="fg-line">' +
                                    '<select id="hi_ed_type-' + id_unit + '" class="selectpicker">' +
                                    '<option value="bachelor">bachelor</option>' +
                                    '<option value="specialist">specialist</option>' +
                                    '<option value="magister">magister</option>' +
                                    '<option value="PG">PG</option>' +
                                    '<option value="Ph.D">Ph.D</option>' +
                                    '<option value="intern">intern</option>' +
                                    '<option value="clinical intern">clinical intern</option>' +
                                    '<option value="applicant">applicant</option>' +
                                    '<option value="intern assistant">intern assistant</option>' +
                                    '<option value="doctoral">doctoral</option>' +
                                    '<option value="adjunct">adjunct</option>' +
                                    '</select></div></div></div></div>' +
                                    '<div class="col-sm-4"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="graduation-' + id_unit + '" value="'+ (value['date_end']).split('-')[0] +'" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                                    '</div></div></div>' +
                                    '</div></div></div>').addClass('animated bounceIn');
                            var unit = unit_university;
                            $('#unit-block-university').prepend(unit);
                            $('#hi_ed_type-' + id_unit +' option[value='+value['hi_ed_type']+']').attr('selected','selected');
                            $('#graduation-' + id_unit).datetimepicker({
                                viewMode: 'years',
                                format: 'YYYY'
                            });
                            break;
                        case 'school':
                            var id_unit = value['id_unit'];
                            var unit_school = $('<div id="unit-' + id_unit + '" data-unit="school" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                                    '<h2>Base school</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                                    '<button id="save-' + id_unit + '" data-action="edit" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                                    '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                                    '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                                    '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                                    '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                                    '<select class="select2" data-def_id ="'+value['id_country']+'" value="'+value['country']+'" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                                    '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_city']+'" value="'+value['city']+'" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                                    '<option></option></select></div></div> </div></div><div class="col-sm-6"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                                    '<select class="select2" id="school-' + id_unit + '" data-def_id ="'+value['id_school']+'" value="'+value['school']+'" data-ph="school"  data-set="school">' +
                                    '<option></option></select></div></div> </div></div>' +
                                    '<div class="col-md-3"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                                    '<input id="group-' + id_unit + '" class="form-control" value="'+value['index_group']+'" placeholder="group index" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="graduation-' + id_unit + '" type="text" value="'+ (value['date_end']).split('-')[0] +'" class="form-control date-picker" placeholder="Graduation date...">' +
                                    '</div></div></div>' +
                                    '</div></div></div>').addClass('animated bounceIn');
                            unit = unit_school;
                            $('#unit-block-school').prepend(unit);
                            $('#graduation-' + id_unit).datetimepicker({
                                viewMode: 'years',
                                format: 'YYYY'
                            });
                            break;
                        case 'sertification':
                             var id_unit = value['id_unit'];
                             var unit_sertification = $('<div id="unit-' + id_unit + '" data-unit="sertification" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                                    '<h2>Sertification</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                                    '<button id="save-' + id_unit + '" data-action="edit" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                                    '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                                    '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                                    '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                                    '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                                    '<select class="select2" data-def_id ="'+value['id_country']+'" value="'+value['country']+'" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                                    '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_city']+'" value="'+value['city']+'" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                                    '<option></option></select></div></div> </div></div>' +
                                    '<div class="col-md-6"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                                    '<input id="organisation-' + id_unit + '" class="form-control" value="'+value['organisation']+'" placeholder="organisation" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-12"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                                    '<input id="specialisation-' + id_unit + '" class="form-control" value="'+value['specialisation']+'" placeholder="subject" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-6"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-receipt"></i></span><div class="fg-line">' +
                                    '<input id="sertificate-' + id_unit + '" class="form-control" value="'+value['sertificate']+'" placeholder="sertificate number" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="graduation-' + id_unit + '" value="'+ (value['date_end']).split('-')[1]+'/'+(value['date_end']).split('-')[0] +'" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                                    '</div></div></div>' +
                                    '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="until-' + id_unit + '" value="'+ (value['date_until']).split('-')[1]+'/'+(value['date_until']).split('-')[0] +'" type="text" class="form-control date-picker" placeholder="By date date...">' +
                                    '</div></div></div>' +
                                    '</div></div></div>').addClass('animated bounceIn');
                            unit = unit_sertification;
                            $('#unit-block-sertification').prepend(unit);
                            $('#graduation-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });
                            $('#until-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });
                            break;
                        case 'courses':
                            var id_unit = value['id_unit'];
                            var unit_courses = $('<div id="unit-' + id_unit + '" data-unit="courses" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                                    '<h2>Courses</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                                    '<button id="save-' + id_unit + '" data-action="edit" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                                    '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                                    '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                                    '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                                    '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                                    '<select class="select2" data-def_id ="'+value['id_country']+'" value="'+value['country']+'" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                                    '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_city']+'" value="'+value['city']+'" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                                    '<option></option></select></div></div> </div></div>' +
                                    '<div class="col-md-6"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                                    '<input id="organisation-' + id_unit + '" class="form-control" value="'+value['organisation']+'" placeholder="organisation" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-12"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                                    '<input id="specialisation-' + id_unit + '" class="form-control" value="'+value['specialisation']+'" placeholder="specialisation" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-6"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-receipt"></i></span><div class="fg-line">' +
                                    '<input id="sertificate-' + id_unit + '" class="form-control" value="'+value['sertificate']+'" placeholder="sertificate number" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="start-' + id_unit + '" value="'+ (value['date_start']).split('-')[1]+'/'+(value['date_start']).split('-')[0] +'" type="text" class="form-control date-picker" placeholder="Start date...">' +
                                    '</div></div></div>' +
                                    '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="graduation-' + id_unit + '" value="'+ (value['date_end']).split('-')[1]+'/'+(value['date_end']).split('-')[0] +'" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                                    '</div></div></div>' +
                                    '</div></div></div>').addClass('animated bounceIn');
                            unit = unit_courses;
                            $('#unit-block-courses').prepend(unit);
                            $('#start-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });

                            $('#graduation-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });
                            break;
                        case 'internal':
                            var id_unit = value['id_unit'];
                            var unit_internal = $('<div id="unit-' + id_unit + '" data-unit="internal" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                                    '<h2>Internal</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                                    '<button id="save-' + id_unit + '" data-action="edit" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                                    '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                                    '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                                    '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                                    '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                                    '<select class="select2" data-def_id ="'+value['id_country']+'" value="'+value['country']+'" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                                    '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                                    '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                                    '<select class="select2" data-def_id ="'+value['id_city']+'" value="'+value['city']+'" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                                    '<option></option></select></div></div> </div></div>' +
                                    '<div class="col-md-6"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                                    '<input id="organisation-' + id_unit + '" class="form-control" value="'+value['organisation']+'" placeholder="organisation" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-md-8"><div class="form-group">' +
                                    '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                                    '<input id="specialisation-' + id_unit + '" class="form-control" value="'+value['specialisation']+'" placeholder="subject" type="text">' +
                                    '</div> </div></div></div>' +
                                    '<div class="col-sm-2"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="start-' + id_unit + '" value="'+ (value['date_start']).split('-')[1]+'/'+(value['date_start']).split('-')[0] +'"  type="text" class="form-control date-picker" placeholder="Start">' +
                                    '</div></div></div>' +
                                    '<div class="col-sm-2"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                                    '<input id="graduation-' + id_unit + '" value="'+ (value['date_end']).split('-')[1]+'/'+(value['date_end']).split('-')[0] +'"  type="text" class="form-control date-picker" placeholder="End">' +
                                    '</div></div></div>' +
                                    '</div></div></div>').addClass('animated bounceIn');
                            unit = unit_internal;
                            $('#unit-block-internal').prepend(unit);
                            $('#start-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });
                            $('#graduation-' + id_unit).datetimepicker({
                                format: 'MM/YYYY'
                            });
                            break;
                    }

                     $('#unit-' + id_unit).find('.save').on('click', function () {
                    //console.log('privet');
                    var id = $(this).data('id');
                    var action = $(this).data('action');
                    var unit = $(this).parents('.card');
                    var id_unit = id;
                    var unit_name = unit.data('unit');


                    switch (unit_name) {
                        case 'university':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: ((unit.find('#country-' + id + ' :selected').val() || (unit.find('#country-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#country-' + id + ' :selected').val() : 0,
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : '0',
                                id_city: ((unit.find('#city-' + id + ' :selected').val() || (unit.find('#city-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#city-' + id + ' :selected').val() : 0,
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                id_university: unit.find('#university-' + id + ' :selected').val() ? unit.find('#university-' + id + ' :selected').val() : '0',
                                university: unit.find('#university-' + id + ' :selected').text() ? unit.find('#university-' + id + ' :selected').text() : 0,
                                id_faculty: ((unit.find('#faculty-' + id + ' :selected').val() || (unit.find('#faculty-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#faculty-' + id + ' :selected').val() : 0,
                                faculty: unit.find('#faculty-' + id + ' :selected').text() ? unit.find('#faculty-' + id + ' :selected').text() : '0',
                                id_chair: ((unit.find('#chair-' + id + ' :selected').val() || (unit.find('#chair-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#chair-' + id + ' :selected').val() : 0,
                                chair: unit.find('#chair-' + id + ' :selected').text() ? unit.find('#chair-' + id + ' :selected').text() : '0',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : '0',
                                index_group: unit.find('#group-' + id).val() ? unit.find('#group-' + id).val() : '0',
                                hi_ed_type: unit.find($('#hi_ed_type-' + id))[0]['value'] ? unit.find($('#hi_ed_type-' + id))[0]['value'] : '0',
                                date_end: unit.find('#graduation-' + id).val() ? '01/' + unit.find('#graduation-' + id).val() : 'NULL'
                            };
                            break;
                        case 'school':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: ((unit.find('#country-' + id + ' :selected').val() || (unit.find('#country-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#country-' + id + ' :selected').val() : 0,
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : '0',
                                id_city: ((unit.find('#city-' + id + ' :selected').val() || (unit.find('#city-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#city-' + id + ' :selected').val() : 0,
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : '0',
                                school: unit.find('#school-' + id + ' :selected').text() ? unit.find('#school-' + id + ' :selected').text() : '0',
                                index_group: unit.find('#group-' + id).val() ? unit.find('#group-' + id).val() : '0',
                                date_end: unit.find('#graduation-' + id).val() ? '01/' + unit.find('#graduation-' + id).val() : 'NULL'
                            };
                            break;
                        case 'sertification':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: ((unit.find('#country-' + id + ' :selected').val() || (unit.find('#country-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#country-' + id + ' :selected').val() : 0,
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : '0',
                                id_city: ((unit.find('#city-' + id + ' :selected').val() || (unit.find('#city-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#city-' + id + ' :selected').val() : 0,
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : '0',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : '0',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : '0',
                                sertificate: unit.find('#sertificate-' + id).val() ? unit.find('#sertificate-' + id).val() : '0',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_until: unit.find('#until-' + id).val() ? unit.find('#until-' + id).val() : 'NULL'
                            };
                            break;
                        case 'courses':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: ((unit.find('#country-' + id + ' :selected').val() || (unit.find('#country-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#country-' + id + ' :selected').val() : 0,
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : '0',
                                id_city: ((unit.find('#city-' + id + ' :selected').val() || (unit.find('#city-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#city-' + id + ' :selected').val() : 0,
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : '0',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : '0',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : '0',
                                sertificate: unit.find('#sertificate-' + id).val() ? unit.find('#sertificate-' + id).val() : '0',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_start: unit.find('#start-' + id).val() ? unit.find('#start-' + id).val() : 'NULL'
                            };
                            break;
                        case 'internal':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: ((unit.find('#country-' + id + ' :selected').val() || (unit.find('#country-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#country-' + id + ' :selected').val() : 0,
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : '0',
                                id_city: ((unit.find('#city-' + id + ' :selected').val() || (unit.find('#city-' + id + ' :selected').val() =='NULL' ))) ? unit.find('#city-' + id + ' :selected').val() : 0,
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : '0',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : '0',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : '0',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_start: unit.find('#start-' + id).val() ? unit.find('#start-' + id).val() : 'NULL'
                            };
                            break;
                    }


                    $.extend(data, {action: 'unit-' + action, id_hash: '<?= APP::Module('Crypt')->Encode(APP::Module('Users')->user['id']) ?>'});
                    $.ajax({
                        type: 'post',
                        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                        data: data ? data : [0],
                        success: function (result) {
                            switch (result.status) {
                                case 'success':
                                    $('#save-' + result.id_unit).attr('data-action', 'edit');
                                    $('#save-' + result.id_unit).data('action', 'edit');
                                    notify('Has been updated','inverse');
                                    break;
                                case 'error':
                                    notify(result.message,'inverse');
                                    break;
                            }
                        }
                    });

                });

                    $.each($(unit).find('.select2'), function () {

                    if ((def_value !== '') || (def_value !== 0)) {
                        // add saved value
                        var def_value = $(this).attr('value');
                        var def_id = $(this).data('def_id');
                        $(this).find('option').attr('value', def_id).text(def_value);
                    }

                    $(this).select2({
                        placeholder: $(this).data('ph'),
                        minimumInputLength: 3,
                        ajax: {
                            dataType: 'json',
                            type: 'POST',
                            data: function (params) {
                                var data_item = $(this).parents('.card').data('item');
                                var data_unit = $(this).parents('.card').data('unit');
                                switch (data_unit) {
                                    case 'university':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : "",
                                            id_university: ($('#university-' + data_item)) ? $('#university-' + data_item).val() : "",
                                            id_faculty: ($('#faculty-' + data_item)) ? $('#faculty-' + data_item).val() : "",
                                        };
                                        break;
                                    case 'school':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'sertification':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'courses':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'internal':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                }

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
            }

            getUnits();

            $('.delete').on('click',function(){
                var id = $(this).data('id');
                $('#unit-'+id).addClass('animated fadeOutDown');
                setTimeout(function(){
                $('#unit-'+id).remove();
                }, 400);
                if ($(this).prev().prev().data('action') == 'edit') {

                    var data = {
                        action: 'unit-delete',
                        id_hash: '<?= APP::Module('Crypt')->Encode($data['user']['id'])?>',
                        id_unit: id

                    };
                    $.ajax({
                        type: 'post',
                        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                        data: data ? data : [0],
                        success: function (result) {
                            switch (result.status) {
                                case 'success':

                                    $('#save-' + result.id_unit).attr('data-action', 'edit');
                                    $('#save-' + result.id_unit).data('action', 'edit');
                                    notify('Has been deleted','inverse');
                                    break;
                                case 'error':
                                    notify('oops...error','inverse');
                                    break;

                            }
                        }
                    });
                };
            });

             $('.reset').on('click',function(){
                var id = $(this).data('id');
                $.each($('#unit-'+id).find('.select2'), function () {
                    $(this).val('').trigger('change');
                });

                 $.each($('#unit-'+id).find('input'),function() {
                     $(this).val('');
                 });
            }
                );

            $('.unit-add').on('click', function () {
                var unit_name = $(this).data('unit');
                var id_unit = $('#unit-data').data('id');
                $('#unit-data').data('id', id_unit + 1);

                var unit_university = $('<div id="unit-' + id_unit + '" data-unit="university" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                        '<h2>High school</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                        '<button id="save-' + id_unit + '" data-action="save" data-id="' + id_unit + '"   class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                        '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                        '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                        '</div></li></ul></div><div class="card-body card-padding"><div class="row"><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                        '<select class="select2" data-def_id ="" value="" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                        '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                        '<option></option></select></div></div> </div></div><div class="col-sm-6"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                        '<select class="select2" id="university-' + id_unit + '" data-def_id ="" value="" data-ph="university"  data-set="university">' +
                        '<option></option></select></div></div> </div></div><div class="col-sm-5"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-accounts"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="faculty-' + id_unit + '" data-ph="faculty"  data-set="faculty">' +
                        '<option></option></select> </div></div></div></div><div class="col-sm-7"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-account"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="chair-' + id_unit + '" data-ph="chair"  data-set="chair">' +
                        '<option></option></select></div></div></div></div>' +
                        '<div class="col-md-12"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-sun"></i></span><div class="fg-line">' +
                        '<input id="specialisation-' + id_unit + '" class="form-control" placeholder="specialisation programm" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-4"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                        '<input id="group-' + id_unit + '" class="form-control" placeholder="group index" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-sm-4"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-graduation-cap"></i></span> <div class="fg-line">' +
                        '<select id="hi_ed_type-' + id_unit + '" class="selectpicker">' +
                        '<option value="bachelor">bachelor</option>' +
                        '<option value="specialist">specialist</option>' +
                        '<option value="magister">magister</option>' +
                        '<option value="PG">PG</option>' +
                        '<option value="Ph.D">Ph.D</option>' +
                        '<option value="intern">intern</option>' +
                        '<option value="clinical intern">clinical intern</option>' +
                        '<option value="applicant">applicant</option>' +
                        '<option value="intern assistant">intern assistant</option>' +
                        '<option value="doctoral">doctoral</option>' +
                        '<option value="adjunct">adjunct</option>' +
                        '</select></div></div></div></div>' +
                        '<div class="col-sm-4"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="graduation-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                        '</div></div></div>' +
                        '</div></div></div>').addClass('animated bounceIn');

                var unit_school = $('<div id="unit-' + id_unit + '" data-unit="school" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                        '<h2>Base school</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                        '<button id="save-' + id_unit + '" data-action="save" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                        '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                        '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                        '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                        '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                        '<select class="select2" data-def_id ="" value="" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                        '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                        '<option></option></select></div></div> </div></div><div class="col-sm-6"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                        '<select class="select2" id="school-' + id_unit + '" data-def_id ="" value="" data-ph="school"  data-set="school">' +
                        '<option></option></select></div></div> </div></div>' +
                        '<div class="col-md-3"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                        '<input id="group-' + id_unit + '" class="form-control" value="" placeholder="group index" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="graduation-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                        '</div></div></div>' +
                        '</div></div></div>').addClass('animated bounceIn');

                var unit_sertification = $('<div id="unit-' + id_unit + '" data-unit="sertification" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                        '<h2>Sertification</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                        '<button id="save-' + id_unit + '" data-action="save" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                        '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                        '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                        '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                        '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                        '<select class="select2" data-def_id ="" value="" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                        '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                        '<option></option></select></div></div> </div></div>' +
                        '<div class="col-md-6"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                        '<input id="organisation-' + id_unit + '" class="form-control" value="" placeholder="organisation" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-12"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                        '<input id="specialisation-' + id_unit + '" class="form-control" value="" placeholder="subject" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-6"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-receipt"></i></span><div class="fg-line">' +
                        '<input id="sertificate-' + id_unit + '" class="form-control" value="" placeholder="sertificate number" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="graduation-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                        '</div></div></div>' +
                        '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="until-' + id_unit + '" type="text" class="form-control date-picker" placeholder="By date date...">' +
                        '</div></div></div>' +
                        '</div></div></div>').addClass('animated bounceIn');

                var unit_courses = $('<div id="unit-' + id_unit + '" data-unit="courses" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                        '<h2>Courses</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                        '<button id="save-' + id_unit + '" data-action="save" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                        '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                        '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                        '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                        '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                        '<select class="select2" data-def_id ="" value="" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                        '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                        '<option></option></select></div></div> </div></div>' +
                        '<div class="col-md-6"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                        '<input id="organisation-' + id_unit + '" class="form-control" value="" placeholder="organisation" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-12"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                        '<input id="specialisation-' + id_unit + '" class="form-control" value="" placeholder="specialisation" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-6"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-receipt"></i></span><div class="fg-line">' +
                        '<input id="sertificate-' + id_unit + '" class="form-control" value="" placeholder="sertificate number" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="start-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Start date...">' +
                        '</div></div></div>' +
                        '<div class="col-sm-3"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="graduation-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Graduation date...">' +
                        '</div></div></div>' +
                        '</div></div></div>').addClass('animated bounceIn');

                var unit_internal = $('<div id="unit-' + id_unit + '" data-unit="internal" data-item="' + id_unit + '" class="card"><div class="card-header">' +
                        '<h2>Internal</h2><ul class="ah-actions actions a-alt"><li><div class="btn-group">' +
                        '<button id="save-' + id_unit + '" data-action="save" data-id="' + id_unit + '"  class="save btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-save"></i>Save</button>' +
                        '<button id="reset-' + id_unit + '" data-id="' + id_unit + '"  class="reset btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-refresh"></i>Reset</button>' +
                        '<button id="delete-' + id_unit + '" data-id="' + id_unit + '"  class="delete btn palette-Purple-400 bg btn-icon-text waves-effect"><i class="zmdi zmdi-delete "></i>Delete</button>' +
                        '</div></li></ul></div><div class="card-body card-padding"><div class="row">' +
                        '<div class="col-sm-3"><div class="fg-line form-group"><div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span><div class="fg-line ">' +
                        '<select class="select2" data-def_id ="" value="" id="country-' + id_unit + '" data-ph="country" data-set="country">' +
                        '<option></option></select></div></div></div></div><div class="col-sm-3"><div class="fg-line form-group"><div class="input-group">' +
                        '<span class="input-group-addon"><i class="zmdi zmdi-city"></i></span><div class="fg-line">' +
                        '<select class="select2" data-def_id ="" value="" id="city-' + id_unit + '" data-ph="city" data-set="city">' +
                        '<option></option></select></div></div> </div></div>' +
                        '<div class="col-md-6"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-balance"></i></span><div class="fg-line">' +
                        '<input id="organisation-' + id_unit + '" class="form-control" value="" placeholder="organisation" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-md-8"><div class="form-group">' +
                        '<div class="input-group"><span class="input-group-addon"><i class="zmdi zmdi-flag"></i></span><div class="fg-line">' +
                        '<input id="specialisation-' + id_unit + '" class="form-control" value="" placeholder="subject" type="text">' +
                        '</div> </div></div></div>' +
                        '<div class="col-sm-2"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="start-' + id_unit + '" type="text" class="form-control date-picker" placeholder="Start">' +
                        '</div></div></div>' +
                        '<div class="col-sm-2"><div class="input-group form-group"><span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span><div class="dtp-container fg-line">' +
                        '<input id="graduation-' + id_unit + '" type="text" class="form-control date-picker" placeholder="End">' +
                        '</div></div></div>' +
                        '</div></div></div>').addClass('animated bounceIn');

                var unit;
                switch (unit_name) {
                    case 'university':
                        unit = unit_university;
                        $('#unit-block-university').prepend(unit);
                        $('#graduation-' + id_unit).datetimepicker({
                            viewMode: 'years',
                            format: 'YYYY'
                        });
                        break;
                    case 'school':
                        unit = unit_school;
                        $('#unit-block-school').prepend(unit);
                        $('#graduation-' + id_unit).datetimepicker({
                            viewMode: 'years',
                            format: 'YYYY'
                        });
                        break;
                    case 'sertification':
                        unit = unit_sertification;
                        $('#unit-block-sertification').prepend(unit);
                        $('#graduation-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });
                        $('#until-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });
                        break;
                    case 'courses':
                        unit = unit_courses;
                        $('#unit-block-courses').prepend(unit);
                        $('#start-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });

                        $('#graduation-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });
                        break;
                    case 'internal':
                        unit = unit_internal;
                        $('#unit-block-internal').prepend(unit);
                        $('#start-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });
                        $('#graduation-' + id_unit).datetimepicker({
                            format: 'MM/YYYY'
                        });
                        break;
                }

                $('.selectpicker').selectpicker('refresh');



                $('#unit-' + id_unit).find('.save').on('click', function () {
                    //console.log('privet');
                    var id = $(this).data('id');
                    var action = $(this).data('action');
                    var unit = $(this).parents('.card');
                    var id_unit = id;
                    var unit_name = unit.data('unit');


                    switch (unit_name) {
                        case 'university':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: unit.find('#country-' + id + ' :selected').val() ? unit.find('#country-' + id + ' :selected').val() : 'NULL',
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : 'NULL',
                                id_city: unit.find('#city-' + id + ' :selected').val() ? unit.find('#city-' + id + ' :selected').val() : 'NULL',
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                id_university: unit.find('#university-' + id + ' :selected').val() ? unit.find('#university-' + id + ' :selected').val() : 'NULL',
                                university: unit.find('#university-' + id + ' :selected').text() ? unit.find('#university-' + id + ' :selected').text() : 'NULL',
                                id_faculty: unit.find('#faculty-' + id + ' :selected').val() ? unit.find('#faculty-' + id + ' :selected').val() : 'NULL',
                                faculty: unit.find('#faculty-' + id + ' :selected').text() ? unit.find('#faculty-' + id + ' :selected').text() : 'NULL',
                                id_chair: unit.find('#chair-' + id + ' :selected').val() ? unit.find('#chair-' + id + ' :selected').val() : 'NULL',
                                chair: unit.find('#chair-' + id + ' :selected').text() ? unit.find('#chair-' + id + ' :selected').text() : 'NULL',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : 'NULL',
                                index_group: unit.find('#group-' + id).val() ? unit.find('#group-' + id).val() : 'NULL',
                                hi_ed_type: unit.find($('#hi_ed_type-' + id))[0]['value'] ? unit.find($('#hi_ed_type-' + id))[0]['value'] : 'NULL',
                                date_end: unit.find('#graduation-' + id).val() ? '01/' + unit.find('#graduation-' + id).val() : 'NULL'
                            };
                            break;
                        case 'school':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: unit.find('#country-' + id + ' :selected').val() ? unit.find('#country-' + id + ' :selected').val() : 'NULL',
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : 'NULL',
                                id_city: unit.find('#city-' + id + ' :selected').val() ? unit.find('#city-' + id + ' :selected').val() : 'NULL',
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                id_school: unit.find('#school-' + id + ' :selected').val() ? unit.find('#school-' + id + ' :selected').val() : 'NULL',
                                school: unit.find('#school-' + id + ' :selected').text() ? unit.find('#school-' + id + ' :selected').text() : 'NULL',
                                index_group: unit.find('#group-' + id).val() ? unit.find('#group-' + id).val() : 'NULL',
                                date_end: unit.find('#graduation-' + id).val() ? '01/' + unit.find('#graduation-' + id).val() : 'NULL'
                            };
                            break;
                        case 'sertification':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: unit.find('#country-' + id + ' :selected').val() ? unit.find('#country-' + id + ' :selected').val() : 'NULL',
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : 'NULL',
                                id_city: unit.find('#city-' + id + ' :selected').val() ? unit.find('#city-' + id + ' :selected').val() : 'NULL',
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : 'NULL',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : 'NULL',
                                sertificate: unit.find('#sertificate-' + id).val() ? unit.find('#sertificate-' + id).val() : 'NULL',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_until: unit.find('#until-' + id).val() ? unit.find('#until-' + id).val() : 'NULL'
                            };
                            break;
                        case 'courses':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: unit.find('#country-' + id + ' :selected').val() ? unit.find('#country-' + id + ' :selected').val() : 'NULL',
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : 'NULL',
                                id_city: unit.find('#city-' + id + ' :selected').val() ? unit.find('#city-' + id + ' :selected').val() : 'NULL',
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : 'NULL',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : 'NULL',
                                sertificate: unit.find('#sertificate-' + id).val() ? unit.find('#sertificate-' + id).val() : 'NULL',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_start: unit.find('#start-' + id).val() ? unit.find('#start-' + id).val() : 'NULL'
                            };
                            break;
                        case 'internal':
                            var data = {
                                unit: unit_name,
                                id_unit: id_unit,
                                id_country: unit.find('#country-' + id + ' :selected').val() ? unit.find('#country-' + id + ' :selected').val() : 'NULL',
                                country: unit.find('#country-' + id + ' :selected').text() ? unit.find('#country-' + id + ' :selected').text() : 'NULL',
                                id_city: unit.find('#city-' + id + ' :selected').val() ? unit.find('#city-' + id + ' :selected').val() : 'NULL',
                                city: unit.find('#city-' + id + ' :selected').text() ? unit.find('#city-' + id + ' :selected').text() : 'NULL',
                                organisation: unit.find('#organisation-' + id).val() ? unit.find('#organisation-' + id).val() : 'NULL',
                                specialisation: unit.find('#specialisation-' + id).val() ? unit.find('#specialisation-' + id).val() : 'NULL',
                                date_end: unit.find('#graduation-' + id).val() ? unit.find('#graduation-' + id).val() : 'NULL',
                                date_start: unit.find('#start-' + id).val() ? unit.find('#start-' + id).val() : 'NULL'
                            };
                            break;
                    }

                    $.extend(data, {action: 'unit-' + action, id_hash: '<?= APP::Module('Crypt')->Encode($data['user']['id'])?>'});

                    $.ajax({
                        type: 'post',
                        url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                        data: data ? data : [0],
                        success: function (result) {
                            switch (result.status) {
                                case 'success':
                                    $('#save-' + result.id_unit).attr('data-action', 'edit');
                                    $('#save-' + result.id_unit).data('action', 'edit');
                                    notify('Has been saved','inverse');
                                    break;
                                case 'error':
                                    notify('oops...error','inverse');
                                    break;

                            }
                        }
                    });

                });



                $.each($(unit).find('.select2'), function () {

                    if ((def_value !== '') || (def_value !== 0)) {
                        // add saved value
                        var def_value = $(this).attr('value');
                        var def_id = $(this).data('def_id');
                        $(this).find('option').attr('value', def_id).text(def_value);
                    }

                    $(this).select2({
                        placeholder: $(this).data('ph'),
                        minimumInputLength: 3,
                        ajax: {
                            dataType: 'json',
                            type: 'POST',
                            data: function (params) {
                                var data_item = $(this).parents('.card').data('item');
                                var data_unit = $(this).parents('.card').data('unit');
                                switch (data_unit) {
                                    case 'university':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : "",
                                            id_university: ($('#university-' + data_item)) ? $('#university-' + data_item).val() : "",
                                            id_faculty: ($('#faculty-' + data_item)) ? $('#faculty-' + data_item).val() : "",
                                        };
                                        break;
                                    case 'school':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'sertification':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'courses':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                    case 'internal':
                                        return {
                                            search: params.term,
                                            page: params.page,
                                            set: $(this).data('set'),
                                            lang: $('#lang:checked').val() ? 1 : 0,
                                            // set specific fields
                                            id_country: ($('#country-' + data_item)) ? $('#country-' + data_item).val() : "",
                                            id_city: ($('#city-' + data_item)) ? $('#city-' + data_item).val() : ""
                                        };
                                        break;
                                }

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
                            }).then(function () {
                                console.log('jQuery bind complete');
                            });

                        }

                        reader.readAsDataURL(input.files[0]);
                    } else {
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

                $('#upload').on('click', function () {
                    $('#input-photo').trigger('click');
                })

                $('#input-photo').on('change', function () {
                    readFile(this);
                });

             
                $('#upload-result').on('click', function (ev) {
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (resp) {

                        var data = {
                            id_hash: '<?= APP::Module('Crypt')->Encode($data['user']['id'])?>',
                            action: 'image-crop',
                            data: resp
                        };

                       
                        $.ajax({
                            type: 'post',
                            url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                            data: data ? data : [0],
                            success: function (result) {


                                $('#default-photo img').attr('src', resp).removeAttr('style');
                                $('#default-photo').removeClass('hidden');
                                $('#upload-photo').removeClass('ready');
                                $('#upload-buttons').addClass('hidden');

                                // enable if you want to uplad full image
                                /*
                                 $uploadCrop.croppie('result', {
                                 type: 'canvas',
                                 size: 'original'
                                 }).then(function (resp) {

                                 var data = {
                                 id_hash: '<? //= APP::Module('Crypt')->Encode(APP::Module('Users')->user['id'])   ?>',
                                 action: 'image-full',
                                 data: resp
                                 }

                                 var img_full = data.data;

                                 $.ajax({
                                 type: 'post',
                                 url: '<? //= APP::Module('Routing')->root   ?>students/user/api/edit/settings.json',
                                 data: data ? data : [0],
                                 success: function (result) {

                                 $('#default-photo img').attr('src',img_full).removeAttr('style');
                                 $('#default-photo').removeClass('hidden');
                                 $('#upload-photo').removeClass('ready');
                                 $('#upload-buttons').addClass('hidden');

                                 }
                                 });

                                 });
                                 */
                            }
                        });

                    });
                });

            }

            demoUpload();


            // SERVER MODE
            var flag, check;
            function checkMode() {

                if (flag !== 1) {
                    check = '<?= $data['user_settings']['lang'] ?>';
                }
                if (check == 1) {
                    $('#lang').attr("checked", true);
                    $('#lang').prev().text("English");
                } else {
                    $('#lang').prev().text("Russian");
                }
            }

            checkMode();

            $('#lang').bind('click', function () {
                check = (check == 1) ? 0 : 1;
                checkMode();
            });

            flag = 1;


            $('#submit-reset').on('click', function (event) {
                event.preventDefault();

                $.each($('.select2'), function () {
                    $(this).val('').trigger('change');
                });

                $('#lecture').val('');

            });


            $('#submit-save').on('click', function (event) {
                event.preventDefault();

                var first_name = $('#user_first_name');
                var last_name = $('#user_last_name');
                var email = $('#user_email');
                var phone = $('#user_phone');
                var about = $('#user_about');
                var priv_view = ($('#user_priv_view'))[0]['value'];
                var priv_edit = ($('#user_priv_edit'))[0]['value'];
                var lang = $('#lang:checked');


                first_name.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                last_name.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                email.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                phone.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();

                if (first_name.val() === '') {
                    first_name.closest('.form-group').addClass('has-error has-feedback').find('.input-group').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }

                if (last_name.val() === '') {
                    last_name.closest('.form-group').addClass('has-error has-feedback').find('.input-group').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }

                if ((email.val() === '') || (!validateEmail(email.val()))) {
                    email.closest('.form-group').addClass('has-error has-feedback').find('.input-group').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }

                if (phone.val() === '') {
                    phone.closest('.form-group').addClass('has-error has-feedback').find('.input-group').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }

                var data = {
                    action: 'main-info',
                    id_hash: '<?= APP::Module('Crypt')->Encode($data['user']['id'])?>',
                    first_name: first_name.val() ? first_name.val() : 'NULL',
                    last_name: last_name.val() ? last_name.val() : 'NULL',
                    email: email.val() ? email.val() : 'NULL',
                    phone: phone.val() ? phone.val() : 'NULL',
                    about: about.val() ? about.val() : 'NULL',
                    priv_view: priv_view,
                    priv_edit: priv_edit,
                    lang: lang.val() ? 1 : 0
                }

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>students/user/api/edit/settings.json',
                    data: data,
                    success: function (result) {
                        switch (result.status) {
                            case 1:
                                swal({
                                    title: 'Done!',
                                    text: 'Settings has been updated',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: true
                                });
                                break;
                            case 0:
                                notify('nothing to change...','inverse');
                                break;
                        }
                    }
                });

            });

            /*
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
             lang: $('#lang:checked').val()?1:0,
             // set specific fields
             id_country: ($('#country'))?$('#country').val():"",
             id_city: ($('#city'))?$('#city').val():"",
             id_university: ($('#university'))?$('#university').val():"",
             id_faculty: ($('#faculty'))?$('#faculty').val():"",
             }
             return query;
             },
             url: '<?//=APP::Module('Routing')->root ?>students/user/api/get/vkdata.json',
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
             */
        });
    </script>

</body>
</html>


