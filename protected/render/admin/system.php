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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > System
    <hr>
    <h3>CPU</h3>
    LA <?= implode(' / ', $data[0]) ?>
    
    <h3>HDD</h3>
    <table>
        <thead>
            <tr>
                <th>Filesystem</th>
                <th>Size</th>
                <th>Used</th>
            </tr>
        </thead>
        <tbody>
            <?
            foreach ($data[1] as $key => $value) {
                if ($key === 0) continue;
                ?>
                <tr>
                    <td><?= $value[0] ?></td>
                    <td><?= $value[1] ?></td>
                    <td><?= $value[2] ?></td>
                </tr>
                <?
            }
            ?>
        </tbody>
    </table>
    
    <h3>Memory</h3>
    <table>
        <tbody>
            <tr>
                <th>Total</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][1] * 1024) ?></td>
            </tr>
            <tr>
                <th>Used</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][2] * 1024) ?></td>
            </tr>
            <tr>
                <th>Free</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][3] * 1024) ?></td>
            </tr>
            <tr>
                <th>Shared</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][4] * 1024) ?></td>
            </tr>
            <tr>
                <th>Buffers</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][5] * 1024) ?></td>
            </tr>
            <tr>
                <th>Cached</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][1][6] * 1024) ?></td>
            </tr>
            <tr>
                <th>Buffers/cache</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][2][2] * 1024) ?> / <?= APP::Module('Utils')->SizeConvert($data[2][2][3] * 1024) ?></td>
            </tr>
            <tr>
                <th>Swap</th>
                <td><?= APP::Module('Utils')->SizeConvert($data[2][3][1] * 1024) ?> / <?= APP::Module('Utils')->SizeConvert($data[2][3][2] * 1024) ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>