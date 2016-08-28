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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Add user
    <hr>
    
    <form id="add-user">
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
        
        <label for="re-password">Retype password</label>
        <br>
        <input id="re-password" type="password" name="re-password">
        <a href="javascript:void(0);" class="hide-password">Show</a>
        <div class="error"></div>
        <br><br>
        
        <label for="role">Role</label>
        <br>
        <select id="role" name="role">
            <? foreach ($data['roles'] as $role) { ?><option value="<?= $role ?>"><?= $role ?></option><? } ?>
        </select>
        <div class="error"></div>
        <br><br>
        
        <label for="notification">Notification</label>
        <br>
        <select id="notification" name="notification">
            <option value="0">none</option>
            <option value="<?= APP::Module('Registry')->Get('module_users_register_activation_letter') ?>">with activation link</option>
            <option value="<?= APP::Module('Registry')->Get('module_users_register_letter') ?>">without activation link</option>
        </select>
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Add">
    </form>
    
    <script>
        $('.hide-password').on('click', function() {
            var $this = $(this),
                $password_field = $this.prev('input');

            ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
            ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
        });
        
        $('#add-user').submit(function(event) {
            event.preventDefault();

            var email = $(this).find('#email');
            var password = $(this).find('#password');
            var re_password = $(this).find('#re-password');
            var role = $(this).find('#role');
            var notification = $(this).find('#email');

            email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            re_password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            role.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            notification.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();

            if (email.val() === '') { email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (password.val() !== re_password.val()) { re_password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Passwords do not match'); return false; }
            if (role.val() === '') { role.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (notification.val() === '') { notification.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('User "' + email.val() + '" has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 2: $('#email').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Already registered'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#add-user').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>