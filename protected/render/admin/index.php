<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
</head>
<body>
    <h1>Admin</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin/system">System</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/app">Application</a>
    <hr>
    <?
    foreach ($data as $key => $value) {
        ?>
        <h2><?= $key ?></h2>
        <?
        echo $value;
    }
    ?>
</body>
</html>