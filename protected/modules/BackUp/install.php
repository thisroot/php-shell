<?
$error = false;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'users_set_connection': $_SESSION['core']['install']['users']['connection'] = $_POST['connection']; break;
        
        case 'module_backup_ssh_connection':
            if (isset($_POST['module_backup_ssh_connection'])) {
                $_SESSION['core']['install']['backup']['module_backup_ssh_connection'] = $_POST['module_backup_ssh_connection'];
                $_SESSION['core']['install']['backup']['module_backup_ssh_add_connection'] = 'module_backup_ssh_add_connection';
            } else {
                $_SESSION['core']['install']['backup']['module_backup_ssh_connection'] = 0;
            }
            break;

        case 'add-ssh':
            $_SESSION['core']['install']['backup']['module_backup_ssh_connection'] = 0;
            unset($_SESSION['core']['install']['backup']['module_backup_ssh_add_connection']);
            break;
        
        case 'select-ssh':
            unset($_SESSION['core']['install']['backup']['module_backup_ssh_connection']);
            break;
        
        case 'back-to-ssh':
            unset($_SESSION['core']['install']['backup']['module_backup_ssh_connection']);
            break;
        
        case 'login-link':
            unset($_SESSION['core']['install']['backup']['module_backup_remote_host']);
            break;

        case 'login':
            if (isset($_POST['host'])) {
                $_SESSION['core']['install']['backup']['module_backup_remote_host'] = $_POST['host'];
                $_SESSION['core']['install']['backup']['module_backup_remote_email'] = $_POST['email'];
                $_SESSION['core']['install']['backup']['module_backup_remote_pass'] = APP::Module('Crypt')->Encode($_POST['password']);
                $_SESSION['core']['install']['backup']['module_backup_server_mode'] = isset($_POST['server-mode'])?1:0;
                $_SESSION['core']['install']['backup']['register'] = 'register';
            } else {
                $_SESSION['core']['install']['backup']['module_backup_remote_host'] = 0;
            }
            break;

        case 'add-registration':
            $_SESSION['core']['install']['backup']['module_backup_remote_host'] = 0;
            unset($_SESSION['core']['install']['backup']['register']);
            break;

            break;
        case 'add-cronjob':
            $_SESSION['core']['install']['backup']['add-cronjob'] = $_POST['action'];
            $_SESSION['core']['install']['backup']['module_backup_id_ssh'] = APP::Module('Crypt')->Decode($_POST['ssh_id_hash']);
            $_SESSION['core']['install']['backup']['module_backup_every_jobs'] = $_POST['jobs-every'];
            break;
    }
}

ob_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Install BackUp</title>
        <meta charset="UTF-8">
        <meta name="robots" content="none">
         <!-- Vendor CSS -->
        <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">        
        <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
        <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
		
		<!-- Javascript Libraries -->
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/fileinput/fileinput.min.js"></script>
    </head>
    <body>

        <?
        if (!$error) {
        if (!isset($_SESSION['core']['install']['users']['connection'])) {
            $error = true;
            ?>
            <h3>Select connection</h3>
            <form method="post">
                <input type="hidden" name="action" value="users_set_connection">
                <select name="connection">
                    <? foreach (array_keys(APP::Module('DB')->conf['connections']) as $connection) { ?><option value="<?= $connection ?>"><?= $connection ?></option><? } ?>
                </select>
                <br><br>
                <input type="submit" value="Next">
            </form>
            <?
        }
    }
        
        
        if (!$error) {
            if (!isset($_SESSION['core']['install']['backup']['module_backup_ssh_connection'])) {

                $error = true;

                if (APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value'])) {
                    $_SESSION['core']['install']['backup']['module_backup_ssh_add_connection'] = 'module_backup_ssh_add_connection';
                    $data = APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value']);
                    ?>
                    <h1>Select SSH</h1>

                    <form method="post">
                        <input type="hidden" name="action" value="module_backup_ssh_connection">
                        <label for="module_backup_ssh_connection">SSH connection</label>
                        <br>

                        <select id="module_backup_ssh_connection" type="text" name="module_backup_ssh_connection">
                            <? foreach ($data['module_ssh_connection'] as $ssh_con) { ?>
                                <option   value="<?= $ssh_con['id'] ?>"><?= json_decode($ssh_con['value'])[2] . '@' . json_decode($ssh_con['value'])[0] . ':' . json_decode($ssh_con['value'])[1] ?></option><? } ?>
                        </select>
                        <div class="error"></div>
                        <br><br>


                        <input type="submit" value="Next">
                    </form>
                    <br><br>
                    <form method="POST">
                        <input type="hidden" name="action" value="add-ssh">
                        <input type="submit" value="Add SSH">
                    </form>

                    <?
                } else {
                    $error = false;
                }
            }
        }

        if (!$error) {
            if (!isset($_SESSION['core']['install']['backup']['module_backup_ssh_add_connection'])) {
                unset($_SESSION['core']['install']['backup']['module_backup_ssh_connection']);
                ?><h1>Add SSH</h1><? $error = true; 
				
				if (APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value'])) { ?>
				 <form method="POST">
                        <input type="hidden" name="action" value="select-ssh">
                        <input type="submit" value="Select SSH">
                 </form><br><br> <?
				} ?>
				
                <form method="POST" id="add-connection">
                    <input id="module_backup_ssh_connection" type="hidden" name="module_backup_ssh_connection" value="">
                    <label for="host">Host</label>
                    <br>
                    <input id="host" type="text" name="host" value="127.0.0.1">
                    <div class="error"></div>
                    <br><br>

                    <label for="port">Port</label>
                    <br>
                    <input id="port" type="text" name="port" value="22" style="width: 50px">
                    <div class="error"></div>
                    <br><br>

                    <label for="user">User</label>
                    <br>
                    <input id="user" type="text" name="user" value="">
                    <div class="error"></div>
                    <br><br>

                    <label for="password">Password</label>
                    <br>
                    <input id="password" type="password" name="password" value="">
                    <a href="javascript:void(0);" class="hide-password">Show</a>
                    <div class="error"></div>
                    <br><br>

                    <input type="submit" value="Add">             
                </form>
                
                  
                
                <script>
                    $('.hide-password').on('click', function () {
                        var $this = $(this),
                                $password_field = $this.prev('input');

                        ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                        ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
                    });

                    $('#add-connection').submit(function (event) {
                        event.preventDefault();

                        var host = $(this).find('#host');
                        host.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                        if (host.val() === '') {
                            host.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                            return false;
                        }

                        var port = $(this).find('#port');
                        port.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                        if (port.val() === '') {
                            port.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                            return false;
                        }

                        var user = $(this).find('#user');
                        user.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                        if (user.val() === '') {
                            user.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                            return false;
                        }

                        var password = $(this).find('#password');
                        password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                        if (password.val() === '') {
                            password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                            return false;
                        }

                        $(this).find('[type="submit"]').attr('disabled', true);

                        $.ajax({
                            type: 'post',
                            url: '<?= APP::Module('Routing')->root ?>admin/ssh/api/add.json',
                            data: $(this).serialize(),
                            success: function (result) {
                                switch (result.status) {
                                    case 'success':
                                        alert('Connection "' + user.val() + '@' + host.val() + ':' + port.val() + '" has been added');
                                        $('#add-connection').unbind();
                                        $(this).find('#host').val(result.connection_id);
                                        $('#add-connection').submit();

                                        break;
                                    case 'error':
                                        $.each(result.errors, function (i, error) {
                                            switch (error) {
                                                case 1:
                                                    $('#host').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                                                    break;
                                                case 2:
                                                    $('#port').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                                                    break;
                                                case 3:
                                                    $('#user').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                                                    break;
                                                case 4:
                                                    $('#password').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified');
                                                    break;
                                            }
                                        });
                                        break;
                                }

                                $('#add-connection').find('[type="submit"]').attr('disabled', false);
                            }
                        });
                    });
                </script>
                <?
            }
        }

        if (!$error) {
            if (!isset($_SESSION['core']['install']['backup']['module_backup_remote_host'])) {
                ?><h1>Backup server</h1>
                <? $error = true; ?>
                <form method="POST">
                    <input type="hidden" name="action" value="back-to-ssh">
                    <input type="submit" value="back">
                </form>
                
                <form method="POST">
                    <input type="hidden" name="action" value="add-registration">
                    <input type="submit" value="Register">
                </form>
                <br><br>

                <form method="POST" id="login">
                    <input type="hidden" name="action" value="login">
                    <label for="host">Host</label>
                    <br>
                    <input id="host" name="host" value="https://default.com">
                    <br><br>
                    <label for="email">E-mail</label>
                    <br>
                    <input id="email" type="email" name="email">
                    <div class="error"></div>
                    <br>

                    <label for="password">Password</label>
                    <br>
                    <input id="password" type="password" name="password">
                    <a href="javascript:void(0);" class="hide-password">Show</a>
                    <div class="error"></div>
                    <br>
                    <label><input name="server-mode"  value="true" type="checkbox">Enable server mode</label><br><br>
					<input hidden="true" type="checkbox" name="remember-me" checked="checked">
                    <input type="submit" value="Login">
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
                            url: host.val() + '/users/api/login.json',
                            data: $(this).serialize(),
                            success: function (result) {
                                switch (result.status) {
                                    case 'error':
                                        alert('Login failed');
                                        break;
                                    case 'success':

                                        $('#login').unbind();
                                        $('#login').submit();
                                        break;
                                }



                            }
                        });
                    });
                </script>

                <?
            }
        }

        if (!$error) {
            if (!isset($_SESSION['core']['install']['backup']['register'])) {
                ?><h1>Register</h1>
                <? $error = true; ?>
                
                        <form method="POST">
                            <input type="hidden" name="action" value="login-link">
                            <input type="submit" value="login">
                        </form>
						<br><br>

                    <form method="POST" id="register">
                        <input type="hidden" name="action" value="login">
                        <label for="host">Host</label>
                        <br>
                        <input id="host" type="text" name="host" value="nebesa.me">
                        <br><br>
                        <label for="email">E-mail</label>
                        <br>
                        <input id="email" type="email" name="email">
                        <div class="error"></div>
                        <br><br>

                        <label for="password">Password</label>
                        <br>
                        <input id="password" type="password" name="password">
                        <a href="javascript:void(0);" class="hide-password">Show</a>
                        <div class="error"></div>
                        <br><br>

                        <label for="re-password">Retype password</label>
                        <br>
                        <input id="re-password" type="password" name="re-password">
                        <a href="javascript:void(0);" class="hide-password">Show</a>
                        <div class="error"></div>
                        <br><br>

                        <input type="submit" value="Register">
                    </form>

                    <script>
                        $('.hide-password').on('click', function () {
                            var $this = $(this),
                                    $password_field = $this.prev('input');

                            ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                            ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
                        });

                        $('#register').submit(function (event) {
                            event.preventDefault();

                            var host = $(this).find('#host');
                            var email = $(this).find('#email');
                            var password = $(this).find('#password');
                            var re_password = $(this).find('#re-password');

                            email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                            password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                            re_password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

                            if (host.val() === '') {
                                password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Host not specified');
                                return false;
                            }
                            if (email.val() === '') {
                                email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('E-Mail not specified');
                                return false;
                            }
                            if (password.val() === '') {
                                password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Password not specified');
                                return false;
                            }
                            if (password.val() !== re_password.val()) {
                                re_password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Passwords do not match');
                                return false;
                            }

                            $(this).find('[type="submit"]').attr('disabled', true);

                            $.ajax({
                                type: 'post',
                                url: '//' + host.val() + '/users/api/register.json',
                                crossDomain: true,
                                data: $(this).serialize(),
                                success: function (result) {
                                    console.log(result);
                                    switch (result.status) {
                                        case 'error':
                                            alert('Register failed');
                                            break;
                                        case 'success':
                                            $('#register').unbind();
                                            $('#register').submit();
                                    }
                                    $('#register').find('[type="submit"]').attr('disabled', false);
                                }
                            });
                        });
                    </script>
                    <?
                }
            
        }

        if (!$error) {
            if (!isset($_SESSION['core']['install']['backup']['add-cronjob'])) {
                ?><h1>Sheduler</h1>
                <? $error = true; ?>
                <form method="POST">
                            <input type="hidden" name="action" value="login-link">
                            <input type="submit" value="back">
                </form>
				<br><br>
                <form id="module_backup_cron_every" method="POST">
                    <input id="action" type="hidden" name="action" value="add-cronjob">
                    <input id="ssh_id_hash" type="hidden" name="ssh_id_hash" value="<?= APP::Module('Crypt')->Encode($_SESSION['core']['install']['backup']['module_backup_ssh_connection']) ?>">
                    <label><input name="jobs-every[]" id="every-day" value="day" type="radio">Every day</label><br><br>
                    <label><input name="jobs-every[]" id="every-week" value="week" type="radio">Every week</label><br><br>
                    <label><input name="jobs-every[]" id="every-month" value="month" type="radio">Every month</label><br><br>
                    <label><input name="jobs-every[]" id="every-year" value="year" type="radio">Every year</label><br><br>
                    <input type="submit" value="Add">
                </form>

                <?
            }
        }
        ?>

    </body>
</html>
<?
$content = ob_get_contents();
ob_end_clean();

if ($error) {
    echo $content;
    exit;
}


 

if (!APP::Module('Registry')->Get('module_backup_ssh_connection')) {
    APP::Module('Registry')->Add('module_backup_ssh_connection', $_SESSION['core']['install']['backup']['module_backup_ssh_connection']);
} else {
    APP::Module('Registry')->Update(['value' => $_SESSION['core']['install']['backup']['module_backup_ssh_connection']],[['item','=','module_backup_ssh_connection', PDO::PARAM_STR]]);
}
if (!APP::Module('Registry')->Get('module_backup_remote_host')) {
    APP::Module('Registry')->Add('module_backup_remote_host', $_SESSION['core']['install']['backup']['module_backup_remote_host']);
    APP::Module('Registry')->Add('module_backup_remote_email', $_SESSION['core']['install']['backup']['module_backup_remote_email']);
    APP::Module('Registry')->Add('module_backup_remote_pass', $_SESSION['core']['install']['backup']['module_backup_remote_pass']);
    APP::Module('Registry')->Add('module_backup_server_mode', $_SESSION['core']['install']['backup']['module_backup_server_mode']);
    APP::Module('Registry')->Add('module_backup_max_saved_backups', 10);
    APP::Module('Registry')->Add('module_backup_segment_size', 500);
}

if (!APP::Module('Registry')->Get('module_backup_cron_id')) {

    $CMD = 'php ' . ROOT . '/init.php BackUp SendFile';
    $SSH = $_SESSION['core']['install']['backup']['module_backup_id_ssh'];
    $result = [];

    foreach ($_SESSION['core']['install']['backup']['module_backup_every_jobs'] as $jobs) {
        switch ($jobs) {
            case 'day': // 0 0 * * *
                array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '*', '*', '*', $CMD]));
                break;
            case 'week': // 0 0 * * 0
                array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '*', '*', '0', $CMD]));
                break;
            case 'month': // 0 0 1 * *
                array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '1', '*', '*', $CMD]));
                break;
            case 'year': // 0 0 1 1 *
                array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '1', '1', '*', $CMD]));
                break;
        }
    }
    APP::Module('Registry')->Add('module_backup_cron_id', json_encode($result));
}

if (!APP::Module('Registry')->Get('module_backup__users_rule')) {
    
    $roles = APP::Module('Registry')->Get(['module_users_role'],['id','value']);
        foreach ($roles['module_users_role'] as $role) {
            if ($role['value'] == 'default') {
                $id = APP::Module('Registry')->Add('module_users_rule','["backup\\\/user(.*)","users\/login"]',$role['id']);
                APP::Module('Registry')->Add('module_backup_users_rule',$id);
            }
        }
}


if (!APP::Module('DB')->Open('auto')->query('SHOW TABLES LIKE "backups"')->rowCount()) {
        APP::Module('DB')->Open('auto')->query('CREATE TABLE backups (
                                                        id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                                                        id_user int(11) DEFAULT NULL,
                                                        id_archive varchar(255) DEFAULT NULL,
                                                        backup_path varchar(255) DEFAULT NULL,
                                                        date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                                        PRIMARY KEY (id))
                                                        ENGINE=InnoDB DEFAULT CHARSET=utf8;');														
}

APP::Module('Triggers')->Register('send_backup', 'BackUp', 'SendFile');
APP::Module('Triggers')->Register('get_backup', 'BackUp', 'Make');
APP::Module('Triggers')->Register('server_get_backup', 'BackUp', 'GetFile');
APP::Module('Triggers')->Register('server_download_backup', 'BackUp', 'APIServerDownload');
APP::Module('Triggers')->Register('server_remove_backup', 'BackUp', 'APIServerRemove');
APP::Module('Triggers')->Register('get_backups_list', 'BackUp', 'APIClientList');
APP::Module('Triggers')->Register('server_get_backups_list', 'BackUp', 'APIServerList');

// Install module
$data->extractTo(ROOT);


$users_conf_file = ROOT . '/protected/modules/BackUp/conf.php';
$users_conf = preg_replace('/\'connection\' => \'auto\'/', '\'connection\' => \'' . $_SESSION['core']['install']['users']['connection']. '\'', file_get_contents($users_conf_file));
file_put_contents($users_conf_file, $users_conf);