<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Users</title>
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
    <h1>Users</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Notifications
    <hr>
    
    <form id="update-notifications">
        <label for="module_users_register_activation_letter">Login information with activation link</label>
        <br>
        <input id="module_users_register_activation_letter" type="text" name="module_users_register_activation_letter" value="<?= $data['module_users_register_activation_letter'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_register_letter">Login information without activation link</label>
        <br>
        <input id="module_users_register_letter" type="text" name="module_users_register_letter" value="<?= $data['module_users_register_letter'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_reset_password_letter">Link to change password</label>
        <br>
        <input id="module_users_reset_password_letter" type="text" name="module_users_reset_password_letter" value="<?= $data['module_users_reset_password_letter'] ?>">
        <div class="error"></div>
        <br><br>

        <label for="module_users_change_password_letter">Notice of password change</label>
        <br>
        <input id="module_users_change_password_letter" type="text" name="module_users_change_password_letter" value="<?= $data['module_users_change_password_letter'] ?>">
        <div class="error"></div>
        <br><br>
        
        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-notifications').submit(function(event) {
            event.preventDefault();

            var module_users_register_letter = $(this).find('#module_users_register_letter');
            var module_users_register_letter = $(this).find('#module_users_register_letter');
            var module_users_reset_password_letter = $(this).find('#module_users_reset_password_letter');
            var module_users_change_password_letter = $(this).find('#module_users_change_password_letter');
            
            module_users_register_letter.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_register_letter.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_reset_password_letter.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_change_password_letter.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

            if (module_users_register_letter.val() === '') { module_users_register_letter.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_register_letter.val() === '') { module_users_register_letter.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_reset_password_letter.val() === '') { module_users_reset_password_letter.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_change_password_letter.val() === '') { module_users_change_password_letter.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/notifications/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Notifications settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/notifications';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-notifications').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>