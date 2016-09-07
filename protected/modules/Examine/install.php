<?
$error = false;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'examine_set_connection':
            $_SESSION['core']['install']['examine']['connection'] = $_POST['connection'];
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Install Registry</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
</head>
<body>
    <h1>Install Test</h1>
    <?
    if (!$error) {
        if (!isset($_SESSION['core']['install']['examine']['connection'])) {
            $error = true;
            ?>
            <h3>Select connection</h3>
            <form method="post">
                <input type="hidden" name="action" value="examine_set_connection">
                <select name="connection">
                    <? foreach (array_keys(APP::Module('DB')->conf['connections']) as $connection) { ?><option value="<?= $connection ?>"><?= $connection ?></option><? } ?>
                </select>
                <br><br>
                <input type="submit" value="Next">
            </form>
            <?
        }
    }
    ?>
</body>
</html>
<?
$content = ob_get_contents();
ob_end_clean();

if ($error) {
    echo $content;
    exit;
}

// Install module

$data->extractTo(ROOT);

APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('SET time_zone = "+00:00";');

if (!APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('SHOW TABLES LIKE "examine"')->rowCount()) {
    APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('CREATE TABLE shell.examine ( id int(6) NOT NULL AUTO_INCREMENT, text mediumtext DEFAULT NULL, theme text DEFAULT NULL, descriptions longtext DEFAULT NULL, PRIMARY KEY (id)) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci');
   // APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('ALTER TABLE `registry` ADD PRIMARY KEY (`id`), ADD KEY `group_id` (`item`);');
  //  APP::Module('DB')->Open($_SESSION['core']['install']['examine']['connection'])->query('ALTER TABLE `registry` MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;');
}

$registry_conf_file = ROOT . '/protected/modules/Examine/conf.php';
$registry_conf = preg_replace('/\'connection\' => \'auto\'/', '\'connection\' => \'' . $_SESSION['core']['install']['examine']['connection']. '\'', file_get_contents($registry_conf_file));
file_put_contents($registry_conf_file, $registry_conf);