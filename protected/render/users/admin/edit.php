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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Edit user
    <hr>
    
    <form id="update-user">
        <input type="hidden" name="id" value="<?= APP::Module('Routing')->get['user_id_hash'] ?>">
        
        <label for="email">E-mail</label>
        <br>
        <input value="<?= $data['user']['email'] ?>" disabled>
        <div class="error"></div>
        <br><br>
        
        <?
        if (APP::Module('Sessions')->session['modules']['users']['double_auth']) {
            ?>
            <label for="password">Password</label>
            <br>
            <input id="password" type="password" name="password" value="<?= APP::Module('Crypt')->Decode($data['user']['password']) ?>">
            <a href="javascript:void(0);" class="hide-password">Show</a>
            <div class="error"></div>
            <br><br>

            <label for="re-password">Retype password</label>
            <br>
            <input id="re-password" type="password" name="re-password" value="<?= APP::Module('Crypt')->Decode($data['user']['password']) ?>">
            <a href="javascript:void(0);" class="hide-password">Show</a>
            <div class="error"></div>
            <br><br>
            <?
        } else {
            ?>
            <a href="<?= APP::Module('Routing')->root ?>users/login/double/<?= APP::Module('Crypt')->SafeB64Encode(APP::Module('Routing')->SelfUrl()) ?>">Change password</a>
            <br><br>
            <?
        }
        ?>

        <label for="role">Role</label>
        <br>
        <select id="role" name="role">
            <? foreach ($data['roles'] as $role) { ?><option value="<?= $role ?>"><?= $role ?></option><? } ?>
        </select>
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#role').val('<?= $data['user']['role'] ?>');
        
        $('.hide-password').on('click', function() {
            var $this = $(this),
                $password_field = $this.prev('input');

            ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
            ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
        });
        
        $('#update-user').submit(function(event) {
            event.preventDefault();

            var role = $(this).find('#role');
            role.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (role.val() === '') { role.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            <?
            if (APP::Module('Sessions')->session['modules']['users']['double_auth']) {
                ?>
                var password = $(this).find('#password');
                var re_password = $(this).find('#re-password');
                
                password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                re_password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
                
                if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
                if (password.val() !== re_password.val()) { re_password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Passwords do not match'); return false; }
                <?
            }
            ?>

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('User "<?= $data['user']['email'] ?>" has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-user').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>