<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Users</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 3px;
            border: 1px solid black;
            vertical-align: text-top;
        }
        th {
            background: #b0e0e6;
            text-align: left;
        }
    </style>
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
    <script>
    function Remove(link, user) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/users/api/remove.json', {
            id: user
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users'; 
        });
    }
    </script>
</head>
<body>
    <h1>Users</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Users
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/users/add">Add user</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/roles">Roles</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/social">Social networks</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/services">Services</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/auth">Authentication</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/passwords">Passwords</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/notifications">Notifications</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/users/timeouts">Timeouts</a>
    
    <br><br>
    <?
    if (count($data)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%">ID</th>
                    <th style="width: 15%">E-Mail</th>
                    <th style="width: 15%">Role</th>
                    <th style="width: 15%">Reg date</th>
                    <th style="width: 15%">Last visit</th>
                    <th style="width: 10%"></th>
                    <th style="width: 10%"></th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data as $user) {
                    ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td><?= $user['reg_date'] ?></td>
                        <td><?= $user['last_visit'] ?></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>users/profile?user_token=<?= APP::Module('Crypt')->Encode(json_encode([$user['email'], $user['password']])) ?>">Login</a></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/users/edit/<?= APP::Module('Crypt')->Encode($user['id']) ?>">Edit</a></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? Remove(this, <?= $user['id'] ?>) : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Users not found';
    }
    ?>
</body>
</html>