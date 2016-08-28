<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>SSH</title>
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
    function Remove(link, connection) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/ssh/api/remove.json', {
            id: connection
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/ssh'; 
        });
    }
    </script>
</head>
<body>
    <h1>SSH</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > SSH
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/ssh/add">Add connection</a>
    <br><br>
    <?
    if (count($data)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 70%">Connection</th>
                    <th style="width: 15%"></th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data as $con) {
                    $connection = json_decode($con['value'], 1);
                    ?>
                    <tr>
                        <td><?= $connection[2] ?>@<?= $connection[0] ?>:<?= $connection[1] ?></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/ssh/edit/<?= APP::Module('Crypt')->Encode($con['id']) ?>">Edit</a></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? Remove(this, <?= $con['id'] ?>) : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Connections not found';
    }
    ?>
</body>
</html>