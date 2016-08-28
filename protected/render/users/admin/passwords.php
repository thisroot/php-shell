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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Passwords
    <hr>
    
    <form id="update-passwords">
        <label for="module_users_min_pass_length">Minimum password length (register)</label>
        <br>
        <input id="module_users_min_pass_length" type="text" name="module_users_min_pass_length" value="<?= $data['module_users_min_pass_length'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_users_gen_pass_length">Generated password length</label>
        <br>
        <input id="module_users_gen_pass_length" type="text" name="module_users_gen_pass_length" value="<?= $data['module_users_gen_pass_length'] ?>">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-passwords').submit(function(event) {
            event.preventDefault();

            var module_users_min_pass_length = $(this).find('#module_users_min_pass_length');
            var module_users_gen_pass_length = $(this).find('#module_users_gen_pass_length');

            module_users_min_pass_length.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_users_gen_pass_length.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_users_min_pass_length.val() === '') { module_users_min_pass_length.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_users_gen_pass_length.val() === '') { module_users_gen_pass_length.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/passwords/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Passwords settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/passwords';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-passwords').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>