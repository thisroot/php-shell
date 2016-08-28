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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Authentication
    <hr>
    
    <form id="update-auth">
        <label for="module_users_check_rules">Check rules</label>
        <br>
        <select id="module_users_check_rules" name="module_users_check_rules">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_auth_token">Token auth</label>
        <br>
        <select id="module_users_auth_token" name="module_users_auth_token">
            <option value="1">Enable</option>
            <option value="0">Disable</option>
        </select>
        <div class="error"></div>
        <br><br>
        
        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#module_users_check_rules').val('<?= $data['module_users_check_rules'] ?>');
        $('#module_users_auth_token').val('<?= $data['module_users_auth_token'] ?>');
        
        $('#update-auth').submit(function(event) {
            event.preventDefault();

            var module_users_check_rules = $(this).find('#module_users_check_rules');
            var module_users_auth_token = $(this).find('#module_users_auth_token');
            
            module_users_auth_token.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_check_rules.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_users_auth_token.val() === '') { module_users_auth_token.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_check_rules.val() === '') { module_users_check_rules.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/auth/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Authentication settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/auth';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-auth').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>