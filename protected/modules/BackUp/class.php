<?

class BackUp {

    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }

    public function Admin() {
        return APP::Render('backup/admin/nav', 'content');
    }

    public function Make() {

        // clean and create directory
        $backupDir = ROOT . '/' . $this->conf['dir_backup_DB'];
        if (is_dir($backupDir)) {
            array_map('unlink', glob("$backupDir/*.*"));
            rmdir($backupDir);
        }

        mkdir($backupDir, 0750, true);

        APP::Module('SSH')->Open(APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'));

        //create all DB dumps;
        foreach (APP::Module('DB')->conf['connections'] as $key => $value) {

            $cmd = 'mysqldump '
                    . '--user=' . $value['username']
                    . ' --password=' . $value['password']
                    . ' --host=' . $value['host']
                    . ' --all-databases'
                    // .' --default-character-set=utf8'
                    // .' --set-charset=utf8'
                    . '>'
                    . $backupDir
                    . '/'
                    . $key
                    . '-' . $value['host']
                    . '-' . $value['database']
                    . '.sql';

            APP::Module('SSH')->Exec(APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'), $cmd);
        }

        // create ZIP archieve;
        $archiveName = date('YmdHi') . '-' . APP::$conf['location'][1] . '.zip';

        $zip = new ZipArchive;
        $zip->open($archiveName, ZIPARCHIVE::CREATE);

        // create recursive directory iterator
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ROOT), RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($files as $name => $file) {
            $filePath = $file->getRealPath();
            $localPath = explode(ROOT, $filePath);

            if ((strpos($filePath, ROOT . '/logs') !== false) || (strpos($filePath, ROOT . '/tmp') !== false)) {
                continue;
            } else {
                if (is_file($filePath)) {
                    $zip->addFile(mb_substr($localPath[1], 1));
                }
            }
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-Length: ' . filesize($archiveName));
        header('Content-Disposition: attachment; filename="' . $archiveName . '"');

        readfile($archiveName);
        unlink($archiveName);
        array_map('unlink', glob("$backupDir/*.*"));
        rmdir($backupDir);
        exit;
    }

    public function BackupList() {
        echo "privet";
    }

    public function Settings() {

        $backup_ssh_connection_name = APP::Module('DB')->Select(
                'auto', ['fetchAll', PDO::FETCH_ASSOC], ['value'], 'registry', [
            ['id', '=', APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'), PDO::PARAM_INT]
                ]
        );

        $data = [
            '0' => APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value']),
            '1' => $backup_ssh_connection_name
        ];

        APP::Render('backup/admin/settings', 'include', $data);
    }

    public function APIUpdateSettings() {
        APP::Module('Registry')->Update(['value' => $_POST['module_backup_ssh_connection']], [['item', '=', 'module_backup_ssh_connection', PDO::PARAM_STR]]);

        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');

        echo json_encode([
            'status' => 'success',
            'errors' => []
        ]);
        exit;
    }

}
