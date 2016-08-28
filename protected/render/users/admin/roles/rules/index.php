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
    function Remove(link, rule) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/users/api/roles/rules/remove.json', {
            id: rule
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Routing')->get['role_id_hash'] ?>'; 
        });
    }
    </script>
</head>
<body>
    <h1>Users</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users">Users</a> > <a href="<?= APP::Module('Routing')->root ?>admin/users/roles">Roles</a> > <?= $data['role'] ?>
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Routing')->get['role_id_hash'] ?>/add">Add rule</a>
    <br><br>
    <?
    if (count($data['rules'])) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 35%">URI pattern</th>
                    <th style="width: 35%">Target URI</th>
                    <th style="width: 15%"></th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ((array) $data['rules'] as $rule) {
                    $rule_value = json_decode($rule['value'], 1);
                    ?>
                    <tr>
                        <td><?= $rule_value[0] ?></td>
                        <td><?= $rule_value[1] ?></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/users/roles/rules/<?= APP::Module('Routing')->get['role_id_hash'] ?>/edit/<?= APP::Module('Crypt')->Encode($rule['id']) ?>">Edit</a></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? Remove(this, <?= $rule['id'] ?>) : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Rules not found';
    }
    ?>
</body>
</html>