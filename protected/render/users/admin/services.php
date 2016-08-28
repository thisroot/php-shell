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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Services
    <hr>
    
    <form id="update-services">
        <label for="module_users_login_service">Login</label>
        <br>
        <select id="module_users_login_service" name="module_users_login_service">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_register_service">Register</label>
        <br>
        <select id="module_users_register_service" name="module_users_register_service">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_reset_password_service">Reset password</label>
        <br>
        <select id="module_users_reset_password_service" name="module_users_reset_password_service">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_change_password_service">Change password</label>
        <br>
        <select id="module_users_change_password_service" name="module_users_change_password_service">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#module_users_login_service').val('<?= $data['module_users_login_service'] ?>');
        $('#module_users_register_service').val('<?= $data['module_users_register_service'] ?>');
        $('#module_users_reset_password_service').val('<?= $data['module_users_reset_password_service'] ?>');
        $('#module_users_change_password_service').val('<?= $data['module_users_change_password_service'] ?>');
        
        $('#update-services').submit(function(event) {
            event.preventDefault();

            var module_users_login_service = $(this).find('#module_users_login_service');
            var module_users_register_service = $(this).find('#module_users_register_service');
            var module_users_reset_password_service = $(this).find('#module_users_reset_password_service');
            var module_users_change_password_service = $(this).find('#module_users_change_password_service');
            
            module_users_login_service.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_register_service.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_reset_password_service.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_change_password_service.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_users_login_service.val() === '') { module_users_login_service.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_register_service.val() === '') { module_users_register_service.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_reset_password_service.val() === '') { module_users_reset_password_service.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_change_password_service.val() === '') { module_users_change_password_service.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/services/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Services settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/services';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-services').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>