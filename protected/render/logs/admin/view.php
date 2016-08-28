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
    <script type="text/javascript">
    function toggle_visibility(id) {
        var e = document.getElementById(id);
        
        if (e.style.display == 'block') {
           e.style.display = 'none';
        } else {
           e.style.display = 'block';
        }
    }
    </script>
</head>
<body>
    <h1>Logs</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/logs">Logs</a> > <?= basename($data[0]) ?>
    <hr>
    <table>
        <thead>
            <tr>
                <th style="width: 10%">Date</th>
                <th style="width: 10%">Code</th>
                <th style="width: 80%">Error</th>
            </tr>
        </thead>
        <tbody>
            <?
            foreach (array_reverse($data[1]) as $index => $str) {
                $error = json_decode($str);
                ?>
                <tr>
                    <td><?= $error[0] ?></td>
                    <td><?= $error[1] ?></td>
                    <?
                    switch ($error[1]) {
                        case 0:
                            ?>
                            <td>
                                <a href="javascript:void(0)" onclick="toggle_visibility('error-<?= $index ?>');"><?= $error[2][1] ?></a>
                                <table id="error-<?= $index ?>" style="display: none; width: 100%; margin-top: 10px;">
                                    <tr>
                                        <td>Code</td>
                                        <td><?= $error[2][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td><?= $error[2][1] ?></td>
                                    </tr>
                                    <tr>
                                        <td>File</td>
                                        <td><?= $error[2][2] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Line</td>
                                        <td><?= $error[2][3] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Context</td>
                                        <td><pre><? print_r($error[2][4]) ?></pre></td>
                                    </tr>
                                    <tr>
                                        <td>Trace</td>
                                        <td><pre><? print_r($error[2][5]) ?></pre></td>
                                    </tr>
                                </table>
                            </td>
                            <?
                            break;
                        case 1:
                            ?>
                            <td>
                                <a href="javascript:void(0)" onclick="toggle_visibility('error-<?= $index ?>');"><?= $error[2][0] ?></a>
                                <table id="error-<?= $index ?>" style="display: none; width: 100%; margin-top: 10px;">
                                    <tr>
                                        <td>Message</td>
                                        <td><?= $error[2][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code</td>
                                        <td><?= $error[2][1] ?></td>
                                    </tr>
                                    <tr>
                                        <td>File</td>
                                        <td><?= $error[2][2] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Line</td>
                                        <td><?= $error[2][3] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Trace</td>
                                        <td><pre><? print_r($error[2][4]) ?></pre></td>
                                    </tr>
                                </table>
                            </td>
                            <?
                            break;
                        case 2:
                            ?>
                            <td>
                                <a href="javascript:void(0)" onclick="toggle_visibility('error-<?= $index ?>');"><?= $error[2]->message ?></a>
                                <table id="error-<?= $index ?>" style="display: none; width: 100%; margin-top: 10px;">
                                    <tr>
                                        <td>Type</td>
                                        <td><?= $error[2]->type ?></td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td><?= $error[2]->message ?></td>
                                    </tr>
                                    <tr>
                                        <td>File</td>
                                        <td><?= $error[2]->file ?></td>
                                    </tr>
                                    <tr>
                                        <td>Line</td>
                                        <td><?= $error[2]->type ?></td>
                                    </tr>
                                </table>
                            </td>
                            <?
                            break;
                        default: ?><td><pre><? print_r(json_decode($str)) ?></pre></td><? break;
                    }
                    ?>
                </tr>
                <?
            }
            ?>
        </tbody>
    </table>
</body>
</html>