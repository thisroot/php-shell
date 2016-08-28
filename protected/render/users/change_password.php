<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Change password</title>
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
    <h1>Change password</h1>
    <?
    if ((int) APP::Module('Registry')->Get('module_users_change_password_service')) {
        ?>
        <form id="change-password">
            <label for="password">New password</label>
            <br>
            <input id="password" type="password" name="password">
            <a href="javascript:void(0);" class="hide-password">Show</a>
            <div class="error"></div>
            <br><br>

            <label for="re-password">Retype new password</label>
            <br>
            <input id="re-password" type="password" name="re-password">
            <a href="javascript:void(0);" class="hide-password">Show</a>
            <div class="error"></div>
            <br><br>

            <input type="submit" value="Change">
        </form>

        <script>
            $('.hide-password').on('click', function() {
                var $this = $(this),
                    $password_field = $this.prev('input');

                ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
                ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
            });

            $('#change-password').submit(function(event) {
                event.preventDefault();

                var password = $(this).find('#password');
                var re_password = $(this).find('#re-password');

                password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                re_password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

                if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Password not specified'); return false; }
                if (password.val() !== re_password.val()) { re_password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Passwords do not match'); return false; }

                $(this).find('[type="submit"]').attr('disabled', true);

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>users/api/change-password.json',
                    data: $(this).serialize(),
                    success: function(result) {
                        console.log(result);
                        $('#change-password').find('[type="submit"]').attr('disabled', false);
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