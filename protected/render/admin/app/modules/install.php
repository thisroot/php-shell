<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
</head>
<body>
    <h1>Admin</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/app">Application</a> > <a href="<?= APP::Module('Routing')->root ?>admin/app/modules/import">Import modules</a> > Install
    <hr>
    <h3><?= $data ? 'Error: ' . $data : 'All modules have been installed'; ?></h3>
</body>
</html>