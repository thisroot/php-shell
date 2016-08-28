<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>BackUp</title>
        <meta charset="UTF-8">
        <meta name="robots" content="none">
        <style>
            .has-error {
                background: #fdd3d3;
            }
            .error {
                display: none;
            }
            .is-visible {
                display: block;
            }
        </style>
        <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
    </head>
    <body>
        <h1>BackUp</h1>
        <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/backup">BackUp</a> > Settings
        <hr>

        <form id="update-settings">
            <label for="module_backup_ssh_connection">SSH connection</label>
            <br>

            <select id="module_ssh_connection" type="text" name="module_backup_ssh_connection">
                <? foreach ($data[0]['module_ssh_connection'] as $ssh_con) { ?>  <? // json_decode($ssh_con['value'])[2] . '@' . json_decode($ssh_con['value'])[0] . ':' . json_decode($ssh_con['value'])[1] ?>
                    <option <? if ($data['1'][0]['value'] == $ssh_con['value']) {
                    echo 'selected';
                } ?>  value="<?= $ssh_con['id'] ?>"><?= json_decode($ssh_con['value'])[2] . '@' . json_decode($ssh_con['value'])[0] . ':' . json_decode($ssh_con['value'])[1] ?></option><? } ?>
            </select>

            <div class="error"></div>
            <input hidden="true" type="submit" value="Add">
  
        </form>
  
        <script>
            $('#update-settings').submit(function (event) {
                event.preventDefault();

                var module_cron_tmp_file = $(this).find('#module_cron_tmp_file');
                module_cron_tmp_file.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                if (module_cron_tmp_file.val() === '') {
                    module_cron_tmp_file.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                    return false;
                }

                $(this).find('[type="submit"]').attr('disabled', true);

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>admin/backup/api/settings/update.json',
                    data: $(this).serialize(),
                    success: function (result) {
                        switch (result.status) {
                            case 'success':
                                break;
                            case 'error':
                                $.each(result.errors, function (i, error) {
                                    switch (error) {
                                    }
                                });
                                break;
                        }

                        $('#update-settings').find('[type="submit"]').attr('disabled', false);
                    }
                });
            });
        </script>
        <br><br>
        
                            <form method="POST" id="login">
                                <input type="hidden" name="action" value="login">
                                <label for="host">Host</label>
                                <br>
                                <input id="host" name="host" value="<?= APP::Module('Registry')->Get('module_backup_remote_host') ?>">
                                <br><br>
                                <label for="email">E-mail</label>
                                <br>
                                <input id="email" type="email" name="email" value="<?= APP::Module('Registry')->Get('module_backup_remote_email') ?>">
                                <div class="error"></div>
                                <br><br>

                                <label for="password">Password</label>
                                <br>
                                <input id="password" type="password" name="password" value="<?= APP::Module('Crypt')->Decode(APP::Module('Registry')->Get('module_backup_remote_pass')) ?>">
                                <a href="javascript:void(0);" class="hide-password">Show</a>
                                <div class="error"></div>
                                <br><br>
                               <input hidden="true" type="submit" value="Add">
                            </form>
                            
                            <script>
                                $('.hide-password').on('click', function () {
                                    var $this = $(this),
                                            $password_field = $this.prev('input');

                                    ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                                    ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
                                });

                                $('#login').submit(function (event) {

                                    event.preventDefault();

                                    var email = $(this).find('#email');
                                    var password = $(this).find('#password');
                                    var host = $(this).find('#host');


                                    email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                                    password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

                                    if (email.val() === '') {
                                        email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('E-Mail not specified');
                                        return false;
                                    }
                                    if (password.val() === '') {
                                        password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Password not specified');
                                        return false;
                                    }
                                    if (host.val() === '') {
                                        password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Host not specified');
                                        return false;
                                    }

                                    $(this).find('[type="submit"]').attr('disabled', true);

                                    $.ajax({
                                        type: 'post',
                                        url: '//' + host.val() + '/users/api/login.json',
                                        data: $(this).serialize(),
                                        success: function (result) {
                                            switch (result.status) {
                                                case 'error':
                                                    alert('Login failed');
                                                    break;
                                                case 'success':
                                                    break;
                                            }


                                           
                                        }
                                    });
                                });
                            </script>
                            <br><br>
        <?
       $job_id = APP::Module('Registry')->Get('module_backup_id_cron_job');
        $job = APP::Module('Registry')->Get('module_cron_job', 'id ='.$job_id);
        $data['job'] = explode(' ', $job, 6);
        ?>
        <form id="edit-cronjob"> 
        <input type="hidden" name="job_id_hash" value="<?= APP::Module('Crypt')->Encode($job_id) ?>">

        <label for="job_0">Minute</label>
        <br>
        <input id="job_0" type="text" name="job[0]" value="<?= $data['job'][0] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_1">Hour</label>
        <br>
        <input id="job_1" type="text" name="job[1]" value="<?= $data['job'][1] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_2">Day of month</label>
        <br>
        <input id="job_2" type="text" name="job[2]" value="<?= $data['job'][2] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_3">Month</label>
        <br>
        <input id="job_3" type="text" name="job[3]" value="<?= $data['job'][3] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_4">Day of week</label>
        <br>
        <input id="job_4" type="text" name="job[4]" value="<?= $data['job'][4] ?>">
        <div class="error"></div>
        <br><br>
        
        <input hidden="true" id="job_5" type="text" name="job[5]" style="width: 500px" value="php <?= APP::Module('Routing')->root ?>backup/make >/dev/null 2>&1">
        <div class="error"></div>
        

        <input hidden="true" type="submit" value="Save changes">
    </form>
    
    <script>
        $('#edit-cronjob').submit(function(event) {
            event.preventDefault();

            var job_0 = $(this).find('#job_0');
            job_0.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_0.val() === '') { job_0.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_1 = $(this).find('#job_1');
            job_1.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_1.val() === '') { job_1.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_2 = $(this).find('#job_2');
            job_2.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_2.val() === '') { job_2.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_3 = $(this).find('#job_3');
            job_3.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_3.val() === '') { job_3.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_4 = $(this).find('#job_4');
            job_4.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_4.val() === '') { job_4.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_5 = $(this).find('#job_5');
            job_5.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_5.val() === '') { job_5.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/cron/api/jobs/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                           
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 2: $('#job_0').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 3: $('#job_1').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 4: $('#job_2').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 5: $('#job_3').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 6: $('#job_4').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 7: $('#job_5').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 8: alert('Command already exists'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#edit-cronjob').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
    
    <form id="set-settings">
        <input type="submit" value="Save">
    </form>
    <script>
              $('#set-settings').submit(function(event) {
                event.preventDefault();
                if (
             $('#update-settings').submit() && $('#login').submit() && $('#edit-cronjob').submit()) {
                 alert('BackUp has been updated');
             }
         
        });
    </script>
    </body>
</html>