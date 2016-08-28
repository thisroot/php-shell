<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Reset password</title>
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
    <h1>Reset password</h1>
    <?
    if ((int) APP::Module('Registry')->Get('module_users_reset_password_service')) {
        ?>
        <form id="reset-password">
            <label for="email">E-mail</label>
            <br>
            <input id="email" type="email" name="email">
            <div class="error"></div>
            <br><br>

            <input type="submit" value="Reset">
        </form>

        <script>
            $('#reset-password').submit(function(event) {
                event.preventDefault();

                var email = $(this).find('#email');
                email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                if (email.val() === '') { email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('E-Mail not specified'); return false; }

                $(this).find('[type="submit"]').attr('disabled', true);

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>users/api/reset-password.json',
                    data: $(this).serialize(),
                    success: function(result) {
                        console.log(result);
                        $('#reset-password').find('[type="submit"]').attr('disabled', false);
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