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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Timeouts
    <hr>
    
    <form id="update-timeouts">
        <label for="module_users_timeout_activation">User activation</label>
        <br>
        <input id="module_users_timeout_activation" type="text" name="module_users_timeout_activation" value="<?= $data['module_users_timeout_activation'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_timeout_email">Account E-Mail</label>
        <br>
        <input id="module_users_timeout_email" type="text" name="module_users_timeout_email" value="<?= $data['module_users_timeout_email'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_timeout_token">Auth token</label>
        <br>
        <input id="module_users_timeout_token" type="text" name="module_users_timeout_token" value="<?= $data['module_users_timeout_token'] ?>">
        <div class="error"></div>
        <br><br>
        
        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-timeouts').submit(function(event) {
            event.preventDefault();

            var module_users_timeout_token = $(this).find('#module_users_timeout_token');
            var module_users_timeout_email = $(this).find('#module_users_timeout_email');
            var module_users_timeout_activation = $(this).find('#module_users_timeout_activation');
            
            module_users_timeout_token.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_timeout_email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_timeout_activation.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_users_timeout_token.val() === '') { module_users_timeout_token.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_timeout_email.val() === '') { module_users_timeout_email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_timeout_activation.val() === '') { module_users_timeout_activation.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/timeouts/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Timeouts settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/timeouts';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-timeouts').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>