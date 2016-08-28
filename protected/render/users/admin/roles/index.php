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
    function Remove(link, role) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/users/api/roles/remove.json', {
            id: role
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/roles'; 
        });
    }
    </script>
</head>
<body>
    <h1>Users</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > Roles
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/users/roles/add">Add role</a>
    <br><br>
    <?
    if (count($data)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 85%">Role</th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data as $role) {
                    ?>
                    <tr>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Crypt')->Encode($role['id']) ?>"><?= $role['value'] ?></a></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? Remove(this, <?= $role['id'] ?>) : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Roles not found';
    }
    ?>
</body>
</html>