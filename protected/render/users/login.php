<?
$return = $data['return'] ? $data['return'] : APP::Module('Routing')->root . 'users/profile';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Login</title>
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
        #return {
            background: #fdd3d3;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h1>Login</h1>
    <?
    if ($data['return']) {
        ?><div id="return"><b>Access to the</b> [<?= $data['return'] ?>] <b>is forbidden</b></div><?
    }
    
    if ((int) APP::Module('Registry')->Get('module_users_login_service')) {
        ?>
        Login via social networks
        <ul>
            <li><a href="http://oauth.vk.com/authorize?<?= urldecode(http_build_query(['client_id' => $data['social_networks']['module_users_social_auth_vk_id'], 'redirect_uri'  => APP::Module('Routing')->root . 'users/login/vk', 'response_type' => 'code', 'scope' => 'email', 'state' => APP::Module('Crypt')->SafeB64Encode('{"return": "' . APP::Module('Crypt')->Encode($return) . '"}')])) ?>">VK</a></li>
            <li><a href="https://www.facebook.com/dialog/oauth?<?= urldecode(http_build_query(['client_id' => $data['social_networks']['module_users_social_auth_fb_id'], 'redirect_uri'  => APP::Module('Routing')->root . 'users/login/fb', 'response_type' => 'code', 'scope' => 'email', 'state' => APP::Module('Crypt')->SafeB64Encode('{"return": "' . APP::Module('Crypt')->Encode($return) . '"}')])) ?>">Facebook</a></li>
            <li><a href="https://accounts.google.com/o/oauth2/auth?<?= urldecode(http_build_query(['client_id' => $data['social_networks']['module_users_social_auth_google_id'], 'redirect_uri'  => APP::Module('Routing')->root . 'users/login/google', 'response_type' => 'code', 'scope' => urlencode('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'), 'state' => APP::Module('Crypt')->SafeB64Encode('{"return": "' . APP::Module('Crypt')->Encode($return) . '"}')])) ?>">Google</a></li>
            <li><a href="https://oauth.yandex.ru/authorize?<?= urldecode(http_build_query(['client_id' => $data['social_networks']['module_users_social_auth_ya_id'], 'redirect_uri'  => APP::Module('Routing')->root . 'users/login/ya', 'response_type' => 'code', 'display' => 'popup', 'state' => APP::Module('Crypt')->SafeB64Encode('{"return": "' . APP::Module('Crypt')->Encode($return) . '"}')])) ?>">Yandex</a></li>
        </ul>

        <form id="login">
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

            <input type="checkbox" name="remember-me"> Remember me
            <br><br>

            <input type="submit" value="Login">
        </form>

        <script>
            $('.hide-password').on('click', function() {
                var $this = $(this),
                    $password_field = $this.prev('input');

                ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
            });

            $('#login').submit(function(event) {
                event.preventDefault();

                var email = $(this).find('#email');
                var password = $(this).find('#password');

                email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

                if (email.val() === '') { email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('E-Mail not specified'); return false; }
                if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Password not specified'); return false; }

                $(this).find('[type="submit"]').attr('disabled', true);

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>users/api/login.json',
                    data: $(this).serialize(),
                    success: function(result) {
                        switch (result.status) {
                            case 'error': alert('Login failed'); break;
                            case 'success': window.location.href = '<?= $return ?>'; break;
                        }

                        $('#login').find('[type="submit"]').attr('disabled', false);
                    }
                });
              });
        </script>
        <?
    } else {
        ?>Service turned off<?
    }
    ?>
</body>
</html>