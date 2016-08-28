<?
$nav = [];
$nav_cnt = 0;

foreach ($data['path'] as $key => $value) {
    ++ $nav_cnt;
    $title = $key ? $value : 'Leters';
    
    if (count($data['path']) !== $nav_cnt) {
        $nav[] = '<a href="' . APP::Module('Routing')->root . 'admin/mail/letters/' . APP::Module('Crypt')->Encode($key) . '">' . $title . '</a>';
    } else {
        $nav[] = $title;
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Mail</title>
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
    function RemoveLetter(link, letter) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/mail/api/letters/remove.json', {
            id: letter
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>'; 
        });
    }
    
    function RemoveGroup(link, group) {
        $(link).replaceWith('Processing...');
        
        $.post('<?= APP::Module('Routing')->root ?>admin/mail/api/letters/groups/remove.json', {
            id: group
        }, function() { 
            window.location.href = '<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>'; 
        });
    }
    </script>
</head>
<body>
    <h1>Mail</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/mail">Mail</a> > <?= implode(' > ', $nav) ?>
    <hr>
    <a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>/add">Add letter</a> &middot; 
    <a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>/groups/add">Add group</a>
    
    <br><br>
    <?
    if (count($data['list'])) {
        ?>
        <table>
            <tbody>
                <?
                foreach ($data['list'] as $item) {
                    switch ($item[0]) {
                        case 'group':
                            ?>
                            <tr>
                                <td style="width: 70%">[ <a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= APP::Module('Crypt')->Encode($item[1]) ?>" style="font-weight: bold"><?= $item[2] ?></a> ]</td>
                                <td style="width: 15%"><a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>/groups/<?= APP::Module('Crypt')->Encode($item[1]) ?>/edit">Edit</a></td>
                                <td style="width: 15%"><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? RemoveGroup(this, <?= $item[1] ?>) : false;">Remove</a></td>
                            </tr>
                            <?
                            break;
                        case 'letter':
                            ?>
                            <tr>
                                <td style="width: 70%"><a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>/preview/<?= APP::Module('Crypt')->Encode($item[1]) ?>"><?= $item[2] ?></a></td>
                                <td style="width: 15%"><a href="<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= $data['group_sub_id'] ? APP::Module('Crypt')->Encode($data['group_sub_id']) : 0 ?>/edit/<?= APP::Module('Crypt')->Encode($item[1]) ?>">Edit</a></td>
                                <td style="width: 15%"><a href="javascript:void(0)" onclick="return confirm('Are you sure?') ? RemoveLetter(this, <?= $item[1] ?>) : false;">Remove</a></td>
                            </tr>
                            <?
                            break;
                    }
                }
                ?>
            </tbody>
        </table>
        <?
    } else {
        echo 'Letters not found';
    }
    ?>
</body>
</html>