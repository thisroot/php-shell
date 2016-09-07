<?
// delete users rule
$rule = APP::Module('Registry')->Get('module_backup_users_rule');
APP::Module('Registry')->Delete([['id', '=', $rule, PDO::PARAM_STR]]);

// delete cron job
$jobValue = APP::Module('DB')->Select(
                    APP::Module('BackUp')->conf['connection'], [ 'fetch', PDO::FETCH_ASSOC], ['id','value', 'sub_id'], 'registry', [
                ['value', 'LIKE', '%BackUp SendFile', PDO::PARAM_STR]
            ]);
APP::Module('Cron')->Remove($jobValue['sub_id'], [$jobValue['value']]);
APP::Module('Registry')->Delete([['id', '=', $jobValue['id'], PDO::PARAM_STR]]);


// delete all registry records
APP::Module('Registry')->Delete([[
                'item', 'IN', [
                    'module_backup_ssh_connection',
                    'module_backup_remote_host',
                    'module_backup_remote_email',
                    'module_backup_remote_pass',
                    'module_backup_cron_id',
                    'module_backup_server_mode',
		    'module_backup_segment_size',
		    'module_backup_max_saved_backups',
                    'module_backup_users_rule'
                ],
                 PDO::PARAM_STR]]);


// drop table				 
APP::Module('DB')->Open(APP::Module('BackUp')->conf['connection'])->query('DROP TABLE backups');

// drop triggers
APP::Module('DB')->Delete(
        APP::Module('BackUp')->conf['connection'], 'registry', [
    ['value', 'IN', [
            '[\"send_backup\", \"BackUp\", \"SendFile\"]',
            '[\"get_backup\", \"BackUp\", \"Make\"]',
            '[\"server_get_backup\", \"BackUp\", \"GetFile\"]',
            '[\"server_download_backup\", \"BackUp\", \"APIServerDownload\"]',
            '[\"server_remove_backup\", \"BackUp\", \"APIServerRemove\"]',
            '[\"get_backups_list\", \"BackUp\", \"APIClientList\"]',
            '[\"server_get_backups_list\", \"BackUp\", \"APIServerList\"]'
        ],PDO::PARAM_STR
        ]]
);
