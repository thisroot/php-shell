<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP-shell - BackUp</title>

    <!-- Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/src/jquery.nouislider.css" rel="stylesheet">

    <style type="text/css">
        .toggle-switch {
            margin-top: 10px;
        }
    </style>

    <? APP::Render('core/widgets/css') ?>
</head>
<body data-ma-header="teal">
    <?
    APP::Render('admin/widgets/header', 'include', [
        'BackUp' => 'admin/backup/settings'
    ]);
    ?>
    <section id="main">
        <? APP::Render('admin/widgets/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="card">
                    <form id="update-settings" class="form-horizontal" role="form">
                        <div class="card-header">
                            <h2>Settings</h2>
                        </div>

                        <?
                        $job = APP::Module('Registry')->Get(['module_backup_cron_id'], ['id', 'value']);
                        ?>

                        <div class="card-body card-padding">

                            <ul class="tab-nav m-b-15" role="tablist" data-tab-color="teal">
                                <li class="active"><a href="#timings" role="tab" data-toggle="tab">Timings</a></li>
                                <li role="presentation"><a href="#client" role="tab" data-toggle="tab">Client</a></li>
                                <li role="presentation"><a href="#server" role="tab" data-toggle="tab">Server</a></li>
                                <li role="presentation"><a href="#auth" role="tab" data-toggle="tab">Auth</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active animated fadeIn in" id="timings">
                                    <div class="form-group">
                                        <label for="jobs_every[]" class="col-sm-2 control-label">Everytime</label>
                                        <div class="col-sm-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="radio radio-inline m-b-15">
                                                        <label>
                                                            <input id="day" name="jobs_every[]" value="day" type="radio">
                                                            <i class="input-helper"></i>
                                                            DAY
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio radio-inline m-b-15">
                                                        <label>
                                                            <input id="week" name="jobs_every[]" value="week" type="radio">
                                                            <i class="input-helper"></i>
                                                            WEEK
                                                        </label>
                                                    </div></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="radio radio-inline m-b-15">
                                                        <label>
                                                            <input id="month" name="jobs_every[]" value="month" type="radio">
                                                            <i class="input-helper"></i>
                                                            MONTH
                                                        </label>
                                                    </div></div>
                                                <div class="col-sm-6">
                                                    <div class="radio radio-inline m-b-15">
                                                        <label>
                                                            <input id="year" name="jobs_every[]" value="year" type="radio">
                                                            <i class="input-helper"></i>
                                                            YEAR
                                                        </label>
                                                    </div></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated fadeIn in" id="client">
                                    <div class="form-group">
                                        <label for="ssh_connection" class="col-sm-2 control-label">SSH</label>
                                        <div class="col-sm-3">
                                            <select id="ssh_connection" name="ssh_connection" class="selectpicker">
                                                <? foreach ($data[0]['module_ssh_connection'] as $ssh_con) { ?>
                                                    <option <?
                                                    if ($data['1'][0]['value'] == $ssh_con['value']) {
                                                        echo 'selected';
                                                    }
                                                    ?>  value="<?= $ssh_con['id'] ?>"><?= json_decode($ssh_con['value'])[2] . '@' . json_decode($ssh_con['value'])[0] . ':' . json_decode($ssh_con['value'])[1] ?></option><? } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated fadeIn in" id="server">
                                    <div class="form-group">
                                        <label for="server_mode" class="col-sm-3 control-label">Enable server mode</label>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch" data-ts-color="red">
                                                <label for="server_mode" class="ts-label"></label>
                                                <input id="server_mode"  name="server_mode"  hidden="hidden" type="checkbox">
                                                <label for="server_mode" class="ts-helper"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_backups" class="col-sm-3 control-label">Max saved backups</label>
                                        <div class="col-sm-3">
                                            <div class="fg-line">
                                                <input type="text" class="form-control" name="max_backups" id="max_backups" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="size_segment" class="col-sm-3 control-label">Archive segment (MB)</label>
                                        <div class="col-sm-3">
                                            <div class="fg-line">
                                                <input type="text" class="form-control" name="size_segment" id="size_segment" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated fadeIn in" id="auth">
                                    <div class="form-group">
                                        <label for="host" class="col-sm-2 control-label">Host</label>
                                        <div class="col-sm-3">
                                            <div class="fg-line">
                                                <input type="text" class="form-control" name="host" id="host" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-3">
                                            <div class="fg-line">
                                                <input type="text" class="form-control" name="email" id="email" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-3">
                                            <div class="fg-line">
                                                <input type="password"  class="form-control" name="pass" id="pass" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">
                                        <button id="update-settings" type="submit" class="btn palette-Teal bg waves-effect btn-lg">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

<? APP::Render('admin/widgets/footer') ?>
    </section>

<? APP::Render('core/widgets/page_loader') ?>
    <? APP::Render('core/widgets/ie_warning') ?>

    <!-- Javascript Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>

<? APP::Render('core/widgets/js') ?>

    <script>
        $(document).ready(function () {
    // TIMINGS
    if(<?= $data['every_job']?> !=='notset') {
        $( "#<?=$data['every_job']?>" ).attr("checked",true);
    }


   // AUTH
            $('#host').val('<?= $data['host'] ?>');
            $('#email').val('<?= $data['email'] ?>');
            $('#pass').val('<?= $data['pass'] ?>');

    // SERVER MODE
    var flag, check;
    function checkMode() {

        if(flag !== 1) {
            check = <?= $data['mode'] ?>;
        }

            if(check === 1) {
                $('#server_mode').attr("checked", true);
                $('#max_backups').removeAttr('disabled');
                $('#max_backups').attr('enabled','enabled');
                $('#size_segment').removeAttr('disabled');
                $('#size_segment').attr('enabled','enabled');
                $('#max_backups').val('<?= $data['module_backup_max_saved_backups'] ?>');
                $('#size_segment').val('<?= $data['module_backup_segment_size'] ?>');

            } else {
                $('#max_backups').val('-');
                $('#max_backups').attr('disabled','disabled');
                $('#size_segment').val('-');
                $('#size_segment').attr('disabled','disabled');
            }
            }

            checkMode();

            $('#server_mode').bind('click', function(){
                check = (check == 1)?0:1;
                checkMode();
            });

            flag = 1;

            $('#update-settings').submit(function (event) {
                event.preventDefault();

                var jobs_every = $(this).find("input[name^='jobs_every']:checked:enabled");
                var ssh_connection = $(this).find('#ssh_connection');
                var server_mode = $(this).find('#server_mode');
                var max_backups = $(this).find('#max_backups');
                var size_segment = $(this).find('#size_segment');
                var host = $(this).find('#host');
                var email = $(this).find('#email');
                var pass = $(this).find('#pass');


                max_backups.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                size_segment.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                host.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                email.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();
                pass.closest('.form-group').removeClass('has-error has-feedback').find('.form-control-feedback, .help-block').remove();

                if (host.val() === '') {
                    host.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                if (email.val() === '') {
                    email.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }
                if (pass.val() === '') {
                    pass.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                    return false;
                }

                if(server_mode.val() === 'on') {
                    if (max_backups.val() === '') {
                        max_backups.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                        return false;
                    }
                    if (size_segment.val() === '') {
                        size_segment.closest('.form-group').addClass('has-error has-feedback').find('.col-sm-3').append('<span class="zmdi zmdi-close form-control-feedback"></span><small class="help-block">Not specified</small>');
                        return false;
                    }
                }
          

              //  $(this).find('[type="submit"]').html('Processing...').attr('disabled', true);


                $.ajax({
                    type: 'post',
                    url: '<?=  APP::Module('Routing')->root ?>admin/backup/api/settings/update.json',
                    data: $(this).serialize(),
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

                        $('#update-settings').find('[type="submit"]').html('Save changes').attr('disabled', false);
                    }
                });

             
            });


        });
    </script>
</body>
</html>