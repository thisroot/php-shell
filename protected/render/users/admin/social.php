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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Social networks
    <hr>
    
    <form id="update-social-networks">
        <h3>Facebook</h3>
        
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td><label for="module_users_social_auth_fb_id">ID</label></td>
                <td><label for="module_users_social_auth_fb_key">Key</label></td>
            </tr>
            <tr>
                <td>
                    <input id="module_users_social_auth_fb_id" type="text" name="module_users_social_auth_fb_id" value="<?= isset($data['module_users_social_auth_fb_id']) ? $data['module_users_social_auth_fb_id'] : '' ?>" style="width: 300px; margin-right: 10px">
                    <div class="error"></div>
                </td>
                <td>
                    <input id="module_users_social_auth_fb_key" type="text" name="module_users_social_auth_fb_key" value="<?= isset($data['module_users_social_auth_fb_key']) ? $data['module_users_social_auth_fb_key'] : '' ?>" style="width: 300px">
                    <div class="error"></div>
                </td>
            </tr>
        </table>

        <h3>VK</h3>
        
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td><label for="module_users_social_auth_vk_id">ID</label></td>
                <td><label for="module_users_social_auth_vk_key">Key</label></td>
            </tr>
            <tr>
                <td>
                    <input id="module_users_social_auth_vk_id" type="text" name="module_users_social_auth_vk_id" value="<?= isset($data['module_users_social_auth_vk_id']) ? $data['module_users_social_auth_vk_id'] : '' ?>" style="width: 300px; margin-right: 10px">
                    <div class="error"></div>
                </td>
                <td>
                    <input id="module_users_social_auth_vk_key" type="text" name="module_users_social_auth_vk_key" value="<?= isset($data['module_users_social_auth_vk_key']) ? $data['module_users_social_auth_vk_key'] : '' ?>" style="width: 300px">
                    <div class="error"></div>
                </td>
            </tr>
        </table>
        
        <h3>Google</h3>
        
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td><label for="module_users_social_auth_google_id">ID</label></td>
                <td><label for="module_users_social_auth_google_key">Key</label></td>
            </tr>
            <tr>
                <td>
                    <input id="module_users_social_auth_google_id" type="text" name="module_users_social_auth_google_id" value="<?= isset($data['module_users_social_auth_google_id']) ? $data['module_users_social_auth_google_id'] : '' ?>" style="width: 300px; margin-right: 10px">
                    <div class="error"></div>
                </td>
                <td>
                    <input id="module_users_social_auth_google_key" type="text" name="module_users_social_auth_google_key" value="<?= isset($data['module_users_social_auth_google_key']) ? $data['module_users_social_auth_google_key'] : '' ?>" style="width: 300px">
                    <div class="error"></div>
                </td>
            </tr>
        </table>
        
        <h3>Yandex</h3>
        
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td><label for="module_users_social_auth_ya_id">ID</label></td>
                <td><label for="module_users_social_auth_ya_key">Key</label></td>
            </tr>
            <tr>
                <td>
                    <input id="module_users_social_auth_ya_id" type="text" name="module_users_social_auth_ya_id" value="<?= isset($data['module_users_social_auth_ya_id']) ? $data['module_users_social_auth_ya_id'] : '' ?>" style="width: 300px; margin-right: 10px">
                    <div class="error"></div>
                </td>
                <td>
                    <input id="module_users_social_auth_ya_key" type="text" name="module_users_social_auth_ya_key" value="<?= isset($data['module_users_social_auth_ya_key']) ? $data['module_users_social_auth_ya_key'] : '' ?>" style="width: 300px">
                    <div class="error"></div>
                </td>
            </tr>
        </table>

        <br><br>
        
        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#update-social-networks').submit(function(event) {
            event.preventDefault();

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/users/api/social/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Social networks settings has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/social';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#update-social-networks').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>