<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Import modules via network</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <style>
        form {
            display: inline-block;
            margin: 0 0 10px 0;
            padding: 0;
        }
        
        #modules > div {
            border: 1px solid #e3e3e3;
            margin-bottom: 10px;
            padding: 5px;
            width: 50%;
        }
        #modules > div.active {
            background: #fff5b0;
            border: 1px solid #ded384;
        }
        #modules > div.installed {
            background: #f1f1f1;
            border: 1px solid #d2d2d2;
        }
        
        #modules > div > a {
            font-size: 18px;
            margin-bottom: 5px;
            display: inline-block;
            font-weight: bold;
            color: black;
        }
        
        #modules > div > .dependencies {
            color: #bd2929;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
    <script src="<?=APP::$conf['location'][0] . '://' . APP::$conf['location'][1] . APP::$conf['location'][2] ?>public/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h1>Import modules via network</h1>
    <hr>
    <?
    switch ($data['action']) {
        case 'set_server':
            ?>
            <h3>Server</h3>
            <form method="post">
                <input type="hidden" name="action" value="set_server">
                <input type="text" name="server" value="http://phpshell.evildevel.com">
                <br><br>
                <input type="submit" value="Next">
            </form>
            <?
            break;
        case 'select_modules':
            ?>
            <form id="select_modules" method="post">
                <input type="hidden" name="action" value="select_modules">
                <input type="hidden" name="modules" value="">
                <input type="submit" value="Import modules">
            </form>
            
            <form id="reset_server" method="post">
                <input type="hidden" name="action" value="reset_server">
                <input type="submit" value="Server settings">
            </form>
            
            <div id="modules"></div>

            <script>
                var modules = {};
                var installed_modules = <?= json_encode($data['installed_modules']) ?>;
                
                function TogleModule(module) {
                    switch ($('#modules > [data-id="' + module[0] + '"]').attr('class')) {
                        case 'inactive':
                            $('#modules > [data-id="' + module[0] + '"]').removeClass('inactive').addClass('active');
                            $('#modules > [data-id="' + module[0] + '"] > button').html('Remove');
                            modules[module[0]][0] = true;

                            if (modules[module[0]][1]) {
                                $.each(modules[module[0]][1], function(key, value) {
                                    if ($.inArray(value, installed_modules) !== -1) return;
                                    $('#modules > [data-id="' + value + '"]').removeClass('inactive').addClass('active');
                                    $('#modules > [data-id="' + value + '"] > button').html('Remove');
                                    modules[value][0] = true;
                                });
                            }
                            break;
                        case 'active':
                            $('#modules > [data-id="' + module[0] + '"]').removeClass('active').addClass('inactive');
                            $('#modules > [data-id="' + module[0] + '"] > button').html('Add');
                            modules[module[0]][0] = false;
                            break;
                    }
                    
                    var selected_modules = [];
                    
                    $.each(modules, function(key, value) {
                        if (value[0]) selected_modules.push(key);
                    });
                    
                    $('#select_modules > [name="modules"]').val(selected_modules.join(' '));
                }
                
                function GetModulesList() {
                    $('#modules').html('Loading list of available modules. Please wait...');
                    
                    $.post('<?= $_SESSION['core']['import']['server'] ?>/api/modules/list', function(result) {
                        $('#modules').empty();
                        
                        $.each(result, function(key, module) {
                            modules[module[0]] = [false, module[2]];
                            
                            $('#modules')
                            .append(
                                $('<div/>', {
                                    'data-id': module[0],
                                    class: 'inactive'
                                })
                                .append(
                                    $('<a/>', {
                                        href: 'https://github.com/evildevel/php-shell/tree/master/protected/modules/' + module[0],
                                        target: '_blank'
                                    }).append(module[0])
                                )
                                .append(
                                    $('<div/>', {
                                        class: 'description'
                                    })
                                    .css('white-space', 'pre-wrap')
                                    .append(module[1])
                                )
                                .append(
                                    $('<div/>', {
                                        class: 'dependencies'
                                    })
                                    .append(module[2] ? 'Dependencies: ' + module[2].join(' / ') : '')
                                )
                                .append(
                                    $('<button/>', {
                                        type: 'button'
                                    })
                                    .append('Add')
                                    .on('click', function() {
                                        TogleModule(module);
                                    })
                                )
                            );
                    
                            if ($.inArray(module[0], installed_modules) !== -1) {
                                $('#modules > [data-id="' + module[0] + '"]').removeClass('inactive').addClass('installed');
                                $('#modules > [data-id="' + module[0] + '"] > button').html('Installed').attr('disabled', true);
                            }
                        });
                    });
                }
                
                $(function() {
                    GetModulesList();
                });
            </script>
            <?
            break;
        case 'selected_modules':
            if ($_SESSION['core']['import']['modules']) {
                ?>
                <h3>Do you want to import the selected modules?</h3>
                <p><?= $_SESSION['core']['import']['modules'] ?></p>
                <form method="post">
                    <input type="hidden" name="action" value="import_modules">
                    <input type="submit" value="Yes">
                </form>
                <form method="post">
                    <input type="hidden" name="action" value="reset_modules">
                    <input type="submit" value="No">
                </form>
                <?
            } else {
                ?>
                <h3>Modules not selected</h3>
                <form method="post">
                    <input type="hidden" name="action" value="reset_modules">
                    <input type="submit" value="Back">
                </form>
                <?
            }
            break;
        case 'import_modules':
            ?>
            <h3>Selected modules has been imported</h3>
            <p><?= $_SESSION['core']['import']['modules'] ?></p>
            <a href="<?=APP::$conf['location'][0] . '://' . APP::$conf['location'][1] . APP::$conf['location'][2] ?>install">Install imported modules</a>
            <?
            break;
    }
    ?>
</body>
</html>