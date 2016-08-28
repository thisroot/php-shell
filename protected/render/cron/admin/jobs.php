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
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
    <script>
    function Remove(link, id) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/cron/api/jobs/remove.json', {
            job_id_hash: id
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/cron/jobs/<?= APP::Module('Routing')->get['ssh_id_hash'] ?>'; 
        });
    }
    </script>
</head>
<body>
    <h1>Cron</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/cron">Cron</a> > <?= $data['ssh'][2] ?>@<?= $data['ssh'][0] ?>:<?= $data['ssh'][1] ?>
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/cron/jobs/<?= APP::Module('Routing')->get['ssh_id_hash'] ?>/add">Add job</a>
    <br><br>
    <?
    if (count($data['jobs'])) {
        ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 7%">Minute</th>
                    <th style="width: 7%">Hour</th>
                    <th style="width: 7%">Day of month</th>
                    <th style="width: 7%">Month</th>
                    <th style="width: 7%">Day of week</th>
                    <th style="width: 51%">CMD</th>
                    <th style="width: 7%"></th>
                    <th style="width: 7%"></th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach ($data['jobs'] as $job) {
                    $cronjob = explode(' ', $job['value'], 6);
                    ?>
                    <tr>
                        <td><?= $cronjob[0] ?></td>
                        <td><?= $cronjob[1] ?></td>
                        <td><?= $cronjob[2] ?></td>
                        <td><?= $cronjob[3] ?></td>
                        <td><?= $cronjob[4] ?></td>
                        <td><?= htmlspecialchars($cronjob[5]) ?></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/cron/jobs/edit/<?= APP::Module('Crypt')->Encode($job['id']) ?>">Edit</a></td>
                        <td><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? Remove(this, '<?= APP::Module('Crypt')->Encode($job['id']) ?>') : false;">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Jobs not found';
    }
    ?>
</body>
</html>