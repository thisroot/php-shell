<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Cron</title>
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
    <h1>Cron</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/cron">Cron</a> > Settings
    <hr>
    
    <form id="update-settings">
        <label for="module_cron_tmp_file">Temp file</label>
        <br>
        <input id="module_cron_tmp_file" type="text" name="module_cron_tmp_file" value="<?= $data ?>">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-settings').submit(function(event) {
            event.preventDefault();

            var module_cron_tmp_file = $(this).find('#module_cron_tmp_file');
            module_cron_tmp_file.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (module_cron_tmp_file.val() === '') { module_cron_tmp_file.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/cron/api/settings/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Cron settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/cron/settings';
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