<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Sessions</title>
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
    <h1>Sessions</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Sessions
    <hr>
    
    <form id="update-settings">
        <label for="module_sessions_cookie_domain">Cookie domain</label>
        <br>
        <input id="module_sessions_cookie_domain" type="text" name="module_sessions_cookie_domain" value="<?= $data['module_sessions_cookie_domain'] ?>">
        <div class="error"></div>
        <br><br>

        <label for="module_sessions_cookie_lifetime">Cookie lifetime</label>
        <br>
        <input id="module_sessions_cookie_lifetime" type="text" name="module_sessions_cookie_lifetime" value="<?= $data['module_sessions_cookie_lifetime'] ?>"> sec
        <div class="error"></div>
        <br><br>
        
        <label for="module_sessions_compress">Compress</label>
        <br>
        <input id="module_sessions_compress" type="text" name="module_sessions_compress" value="<?= $data['module_sessions_compress'] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="module_sessions_gc_maxlifetime">GC maximum lifetime</label>
        <br>
        <input id="module_sessions_gc_maxlifetime" type="text" name="module_sessions_gc_maxlifetime" value="<?= $data['module_sessions_gc_maxlifetime'] ?>"> sec
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-settings').submit(function(event) {
            event.preventDefault();

            var module_sessions_cookie_domain = $(this).find('#module_sessions_cookie_domain');
            var module_sessions_gc_maxlifetime = $(this).find('#module_sessions_gc_maxlifetime');
            var module_sessions_cookie_lifetime = $(this).find('#module_sessions_cookie_lifetime');
            var module_sessions_compress = $(this).find('#module_sessions_compress');
            
            module_sessions_cookie_domain.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_sessions_gc_maxlifetime.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_sessions_cookie_lifetime.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            module_sessions_compress.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (module_sessions_cookie_domain.val() === '') { module_sessions_cookie_domain.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_sessions_gc_maxlifetime.val() === '') { module_sessions_gc_maxlifetime.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_sessions_cookie_lifetime.val() === '') { module_sessions_cookie_lifetime.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (module_sessions_compress.val() === '') { module_sessions_compress.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/sessions/api/settings/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Sessions settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/sessions';
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