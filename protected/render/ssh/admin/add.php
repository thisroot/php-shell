<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>SSH</title>
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
    <h1>SSH</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/ssh">SSH</a> > Add connection
    <hr>
    
    <form id="add-connection">
        <label for="host">Host</label>
        <br>
        <input id="host" type="text" name="host" value="127.0.0.1">
        <div class="error"></div>
        <br><br>
        
        <label for="port">Port</label>
        <br>
        <input id="port" type="text" name="port" value="22" style="width: 50px">
        <div class="error"></div>
        <br><br>
        
        <label for="user">User</label>
        <br>
        <input id="user" type="text" name="user" value="">
        <div class="error"></div>
        <br><br>
        
        <label for="password">Password</label>
        <br>
        <input id="password" type="password" name="password" value="">
        <a href="javascript:void(0);" class="hide-password">Show</a>
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
        
        $('#add-connection').submit(function(event) {
            event.preventDefault();

            var host = $(this).find('#host');
            host.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (host.val() === '') { host.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var port = $(this).find('#port');
            port.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (port.val() === '') { port.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var user = $(this).find('#user');
            user.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (user.val() === '') { user.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var password = $(this).find('#password');
            password.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (password.val() === '') { password.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/ssh/api/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Connection "' + user.val() + '@' + host.val() + ':' + port.val() + '" has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/ssh';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 1: $('#host').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 2: $('#port').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 3: $('#user').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 4: $('#password').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#add-connection').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>