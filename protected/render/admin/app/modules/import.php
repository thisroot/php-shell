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
        #imported-modules {
            margin-bottom: 10px;
        }
        #import .module {
            margin-bottom: 10px;
        }
    </style>
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h1>Admin</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/app">Application</a> > Import local modules
    <hr>
    <?
    $imported_modules = glob(ROOT . '/protected/import/*.zip');
    
    if (count($imported_modules)) {
        ?>
        <table id="imported-modules">
            <tbody>
                <?
                foreach ($imported_modules as $module) {
                    ?>
                    <tr>
                        <td><?= basename($module, '.zip') ?></td>
                        <td><a href="<?= APP::Module('Routing')->root ?>admin/app/modules/import/remove/<?= APP::Module('Crypt')->Encode($module) ?>">Remove</a></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
         </table>
        <a href="<?= APP::Module('Routing')->root ?>admin/app/modules/import/install" class="remove">Install imported modules</a>
        <br><br>
        <?
    }
    ?>
    
    <form id="import" action="<?= APP::Module('Routing')->SelfURL() ?>" method="post" enctype="multipart/form-data">
        <div id="new-modules"></div>
        <a href="javascript:void(0)" id="add-file">Add file</a>
        <br><br>
        <input type="submit" value="Import">
    </form>
    
    <script>
        $('#import > #add-file').on('click', function() {
            $('#new-modules').append('<div class="module"><input name="modules[]" type="file"><a href="javascript:void(0)" class="remove">Remove</a></div>');
        });

        $(document).on('click', '#import .module > .remove', function(event) {
            $(this).closest('.module').remove();
        });
    </script>
</body>
</html>