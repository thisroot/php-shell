<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Mail</title>
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
    <h1>Mail</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/mail">Mail</a> > Settings
    <hr>
    
    <form id="update-settings">
        <label for="module_mail_x_mailer">X-Mailer</label>
        <br>
        <input id="module_mail_x_mailer" type="text" name="module_mail_x_mailer" value="<?= $data['module_mail_x_mailer'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_mail_charset">Charset</label>
        <br>
        <input id="module_mail_charset" type="text" name="module_mail_charset" value="<?= $data['module_mail_charset'] ?>">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-settings').submit(function(event) {
            event.preventDefault();

            var module_mail_x_mailer = $(this).find('#module_mail_x_mailer');
            var module_mail_charset = $(this).find('#module_mail_charset');

            module_mail_x_mailer.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_mail_charset.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_mail_x_mailer.val() === '') { module_mail_x_mailer.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_mail_charset.val() === '') { module_mail_charset.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/mail/api/settings/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Mail settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/mail/settings';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-settings').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>