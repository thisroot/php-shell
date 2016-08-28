<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <style type="text/css">
        table {
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
    <h1>Admin</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Application
    <hr>
    <h3>Config</h3>
    <table>
        <tbody>
            <tr>
                <th>Base URL</th>
                <td><a href="<?= APP::$conf['location'][0] ?>://<?= APP::$conf['location'][1] . APP::$conf['location'][2] ?>" target="_blank"><?= APP::$conf['location'][0] ?>://<?= APP::$conf['location'][1] . APP::$conf['location'][2] ?></a></td>
            </tr>
            <tr>
                <th>Encoding</th>
                <td><?= APP::$conf['encoding'] ?></td>
            </tr>
            <tr>
                <th>Locale</th>
                <td><?= APP::$conf['locale'] ?></td>
            </tr>
            <tr>
                <th>Timezone</th>
                <td><?= APP::$conf['timezone'] ?></td>
            </tr>
            <tr>
                <th>Memory limit</th>
                <td><?= APP::$conf['memory_limit'] ?></td>
            </tr>
            <tr>
                <th>Debug mode</th>
                <td><?= APP::$conf['debug'] ?></td>
            </tr>
            <tr>
                <th>Logs</th>
                <td><?= APP::$conf['logs'] ?></td>
            </tr>
        </tbody>
    </table>
    <h3>Modules</h3>
    <table>
        <tbody>
            <?
            foreach (glob(ROOT . '/protected/modules/*') as $module) {
                ?>
                <tr>
                    <td><?= basename($module) ?></td>
                    <td><a href="<?= APP::Module('Routing')->root ?>admin/app/modules/export/<?= APP::Module('Crypt')->Encode(basename($module)) ?>">Export</a></td>
                    <td><a href="<?= APP::Module('Routing')->root ?>admin/app/modules/uninstall/<?= APP::Module('Crypt')->Encode(basename($module)) ?>">Uninstall</a></td>
                </tr>
                <?
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="<?= APP::Module('Routing')->root ?>admin/app/modules/import">Import local modules</a>
    <br>
    <a href="<?= APP::Module('Routing')->root ?>admin/app/modules/import/network">Import modules via network</a>
</body>
</html>