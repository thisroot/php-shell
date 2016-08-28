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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users/roles">Roles</a> > Add role
    <hr>
    
    <form id="add-role">
        <label for="role">Role</label>
        <br>
        <input id="role" type="text" name="role">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Add">
    </form>
    
    <script>
        $('#add-role').submit(function(event) {
            event.preventDefault();

            var role = $(this).find('#role');
            role.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (role.val() === '') { role.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Role not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/roles/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Role "' + role.val() + '" has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/roles';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 1: $('#role').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Role not specified'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#add-role').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>