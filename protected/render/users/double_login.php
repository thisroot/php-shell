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
    <h1>The operation requires a password</h1>
    <form id="double-login">
        <label>E-mail</label>
        <br>
        <input value="<?= $data['email'] ?>" disabled>
        <div class="error"></div>
        <br><br>

        <label for="password">Password</label>
        <br>
        <input id="password" type="password" name="password">
        <a href="javascript:void(0);" class="hide-password">Show</a>
        <div class="error"></div>
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

        $('#double-login').submit(function(event) {
            event.preventDefault();

            var password = $(this).find('#password');
            password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Password not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);

            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>users/api/double-login.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch (result.status) {
                        case 'error': alert('Login failed'); break;
                        case 'success': window.location.href = '<?= $return ?>'; break;
                    }

                    $('#double-login').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>