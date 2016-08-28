<?
$jobs = json_decode(APP::Module('Registry')->Get('module_backup_cron_id'));
var_dump($jobs);

foreach ($jobs as $job) {
             APP::Module('Registry')->Delete([['id','=', $job, PDO::PARAM_STR]]);
        }

APP::Module('Registry')->Delete([[
                                    'item', 'IN', [
                                                'module_backup_ssh_connection', 
                                                'module_backup_remote_host',
                                                'module_backup_remote_email',
                                                'module_backup_remote_pass',
                                                'module_backup_cron_id'
                                                ], 
                                    PDO::PARAM_STR]]);



