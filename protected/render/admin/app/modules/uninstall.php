<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h1>Admin</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/app">Application</a> > Uninstall module
    <hr>
    <?
    if (count($data[1])) {
        ?>
        Module <b><?= $data[0] ?></b> is used in the modules:
        <ul>
            <?
            foreach ($data[1] as $value) {
                ?><li><?= $value ?></li><?
            }
            ?>
        </ul>
        Are you sure you want to delete all these modules?
        <?
    } else {
        ?>Are you sure you want to delete <b><?= $data[0] ?></b> module?<?
    }
    ?>
    <br><br>
    <button id="confirm-uninstall">Uninstall</button>
    
    <script>
        $('#confirm-uninstall').on('click', function() {
            $.post('<?= APP::Module('Routing')->root ?>admin/app/api/modules/uninstall/<?= APP::Module('Crypt')->Encode($data[0]) ?>', function(result) {
                alert('Modules has been removed');
                window.location.href = '<?= APP::Module('Routing')->root ?>admin/app';
            });
        });
    </script>
</body>
</html>