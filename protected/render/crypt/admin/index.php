<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Crypt</title>
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
    <h1>Crypt</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Crypt
    <hr>
    
    <form id="update-settings">
        <label for="module_crypt_key">Key</label>
        <br>
        <input id="module_crypt_key" type="text" name="module_crypt_key" value="<?= $data ?>">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-settings').submit(function(event) {
            event.preventDefault();

            var module_crypt_key = $(this).find('#module_crypt_key');
            module_crypt_key.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (module_crypt_key.val() === '') { module_crypt_key.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/crypt/api/settings/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Crypt settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/crypt';
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