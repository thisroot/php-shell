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
                    <option <?
                    if ($data['1'][0]['value'] == $ssh_con['value']) {
                        echo 'selected';
                    }
                    ?>  value="<?= $ssh_con['id'] ?>"><?= json_decode($ssh_con['value'])[2] . '@' . json_decode($ssh_con['value'])[0] . ':' . json_decode($ssh_con['value'])[1] ?></option><? } ?>
            </select><br><br>

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
           
            <input id="action" type="hidden" name="action" value="add-cronjob">
            <input id="ssh_id_hash" type="hidden" name="ssh_id_hash" value="<?= APP::Module('Crypt')->Encode($_SESSION['core']['install']['backup']['module_backup_ssh_connection']) ?>"><br><br>
            <label><input name="jobs-every[]" id="every-day" value="day" type="checkbox"> раз в день</label><br><br>
            <label><input name="jobs-every[]" id="every-week" value="week" type="checkbox"> раз в неделю</label><br><br>
            <label><input name="jobs-every[]" id="every-year" value="year" type="checkbox"> раз в год</label><br><br>
             <div class="error"></div>
            <input  type="submit" value="Update">

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

            $('.hide-password').on('click', function () {
                var $this = $(this),
                        $password_field = $this.prev('input');

                ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
            });
        </script>
        <br><br>
    </body>
</html>