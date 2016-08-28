<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <title>Logs</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
</head>
<body>
    <h1>Logs</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/logs">Logs</a> > Remove log
    <hr>
    File <?= basename($data[0]) ?> <?= $data[1] ? 'has been removed' : 'not found' ?>
</body>
</html>