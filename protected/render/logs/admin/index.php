<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <title>Logs</title>
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
</head>
<body>
    <h1>Logs</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Logs
    <hr>
    <?
    if (count($data)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 70%">File</th>
                    <th style="width: 15%">Size</th>
                    <th style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data as $file) {
                    ?>
                    <tr>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/logs/view/<?= APP::Module('Crypt')->Encode($file) ?>"><?= basename($file) ?></a></td>
                        <td><?= APP::Module('Utils')->SizeConvert(filesize($file)) ?></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? window.location.href = '<?= APP::Module('Routing')->root ?>admin/logs/remove/<?= APP::Module('Crypt')->Encode($file) ?>' : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Files not found';
    }
    ?>
</body>
</html>