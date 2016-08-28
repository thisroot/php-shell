<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Cron</title>
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
    <h1>Cron</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > Cron
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/cron/settings">Settngs</a>
    <br><br>
    <?
    if (count($data)) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 100%">Select SSH connection</th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data as $con) {
                    $connection = json_decode($con['value'], 1);
                    ?>
                    <tr>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/cron/jobs/<?= APP::Module('Crypt')->Encode($con['id']) ?>"><?= $connection[2] ?>@<?= $connection[0] ?>:<?= $connection[1] ?></a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'SSH connections not found';
    }
    ?>
</body>
</html>