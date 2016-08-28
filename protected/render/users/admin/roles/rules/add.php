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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users/roles">Roles</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Routing')->get['role_id_hash'] ?>"><?= $data ?></a> > Add rule
    <hr>
    
    <form id="add-rule">
        <input type="hidden" name="role" value="<?= APP::Module('Routing')->get['role_id_hash'] ?>">
        
        <label for="uri_pattern">URL pattern</label>
        <br>
        <input id="uri_pattern" type="text" name="uri_pattern" style="width: 500px"> (regular expression)
        <div class="error"></div>
        <br><br>
        
        <label for="target">Target URI</label>
        <br>
        <input id="target" type="text" name="target" value="users/login" style="width: 500px">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Add rule">
    </form>
    
    <script>
        $('#add-rule').submit(function(event) {
            event.preventDefault();

            var uri_pattern = $(this).find('#uri_pattern');
            uri_pattern.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (uri_pattern.val() === '') { uri_pattern.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            var target = $(this).find('#target');
            target.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (target.val() === '') { target.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/roles/rules/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Rule has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Routing')->get['role_id_hash'] ?>';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 1: alert('Role not found'); break;
                                    case 2: $('#uri_pattern').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 3: $('#target').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#add-rule').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>