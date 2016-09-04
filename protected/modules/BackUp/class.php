<?
     
class BackUp {
    
    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
 
    public function Admin() {
        return APP::Render('backup/admin/nav', 'content');
    }
    
    public function APIClientList() {
        
        $APIServer = '/backup/user/api/server/list.json';
        $APILogin = '/users/api/login.json';
        
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');
          
             $setings = [
            'url_auth' => APP::Module('Registry')->Get('module_backup_remote_host').$APILogin,
            'url' => APP::Module('Registry')->Get('module_backup_remote_host').$APIServer,
            'email' => APP::Module('Registry')->Get('module_backup_remote_email'),
            'pass' => APP::Module('Crypt')->Decode(APP::Module('Registry')->Get('module_backup_remote_pass')),
        ];
             
             $ch = curl_init();
        // if https connetion
        if (strtolower((substr($setings['url_auth'], 0, 5)) == 'https')) { 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        
        curl_setopt($ch, CURLOPT_URL, $setings['url_auth']);
        curl_setopt($ch, CURLOPT_REFERER, APP::Module('Routing')->root);
        // cURL будет выводить подробные сообщения о всех производимых действиях
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $setings['email'] . "&password=" . $setings['pass']. "&remember-me=");
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //save COOKIE in file
        curl_setopt($ch, CURLOPT_COOKIEJAR, ROOT. '/protected/modules/BackUp/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE,ROOT. '/protected/modules/BackUp/cookie.txt');
        $result = curl_exec($ch);
        
        // Then, after your curl_exec call:
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        
        
        if(json_decode($body)->status == 'success') {
            
            curl_setopt($ch, CURLOPT_URL, $setings['url']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_COOKIEFILE, ROOT. '/protected/modules/BackUp/cookie.txt');
            $result = curl_exec($ch);
            // Then, after your curl_exec call:
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_size);
            $body = substr($result, $header_size);
            echo $body;
        }
    }
    
    public function SendFile(){
       
        $status = 'false';
        
        // перечислить в гет и одним запросом
        
        $setings = [
            'url_auth' => APP::Module('Registry')->Get('module_backup_remote_host').'/users/api/login.json',
            'url' => APP::Module('Registry')->Get('module_backup_remote_host').'/backup/user/server/upload',
            'email' => APP::Module('Registry')->Get('module_backup_remote_email'),
            'pass' => APP::Module('Crypt')->Decode(APP::Module('Registry')->Get('module_backup_remote_pass')),
        ];
                
        $ch = curl_init();
        // if https connetion
        if (strtolower((substr($setings['url_auth'], 0, 5)) == 'https')) { 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        
        curl_setopt($ch, CURLOPT_URL, $setings['url_auth']);
        curl_setopt($ch, CURLOPT_REFERER, APP::Module('Routing')->root);
        // cURL будет выводить подробные сообщения о всех производимых действиях
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $setings['email'] . "&password=" . $setings['pass']. "&remember-me=true");
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-SHELL');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //save COOKIE in file
        curl_setopt($ch, CURLOPT_COOKIEJAR, ROOT. '/protected/modules/BackUp/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE,ROOT. '/protected/modules/BackUp/cookie.txt');
        $result = curl_exec($ch);
        
        // Then, after your curl_exec call:
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        
        
        if(json_decode($body)->status == 'success') {
            $status = 'success';
            
           
            curl_setopt($ch, CURLOPT_URL, $setings['url']);
            curl_setopt($ch, CURLOPT_COOKIEFILE, ROOT. '/protected/modules/BackUp/cookie.txt');
            
        // make archeve
        $backupDir = ROOT . '/'.$this->conf['dir_backup_DB'];
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

        $archiveName = APP::$conf['location'][1] . '.zip';
        $archiveFolder = date('YmdHi').'-'.APP::$conf['location'][1];

/*        
        $zip = new ZipArchive;
        $zip->open($archiveName, ZIPARCHIVE::CREATE);

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
*/
        
 if(!shell_exec('cd '.ROOT.'/ ;mkdir /tmp/'.$archiveFolder.'; zip -r -s 20  /tmp/'.$archiveFolder.'/'.$archiveName.' .* -x logs\*')) {
    echo json_encode(['status'=>'error', 'message' => 'error creating archive']);            exit();
 } 
 

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/tmp/'.$archiveFolder), RecursiveIteratorIterator::LEAVES_ONLY);
foreach ($files as $name => $file) {
                $filePath = $file->getRealPath();
                $localPath = explode(ROOT, $filePath);
 
                $cfile = new CURLFile($filePath, 'application/zip, application/octet-stream');
                $data = array('file' => $cfile, 'folder'=>$archiveFolder);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_exec($ch);
                
            }
            
            curl_close($ch);
            array_map('unlink', glob("/tmp/$archiveFolder/*.*"));
            rmdir("/tmp/$archiveFolder");
            array_map('unlink', glob("$backupDir/*.*"));
            rmdir($backupDir);
            exit();
        }
    }
    
     public function APIServerDownload() {
        
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');
        
         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
            echo json_encode(['status' => 'service works is not server mode']); exit();
        }
        
        
        if (empty($_POST['id_hash'])) {
            echo json_encode(['status' => 'error', 'message' => 'POST array does not have id_hash']); exit();
        }
        
        $path = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['backup_path','id_archive'], 'backups',
                    [
                        ['id', '=',APP::Module('Crypt')->Decode($_POST['id_hash']), PDO::PARAM_INT]
                    ]);
 
        if(!$path) {
            json_encode(['status'=>'file not exist']);            exit();
        }
        
        $file = ROOT . '/protected/modules/BackUp/Uploads/' . $path['backup_path'];
        header('Content-Type: application/zip');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename="' . $path['id_archive'].'.zip' . '"');
        readfile($file);
    }
    
    public function APIServerRemove() {
        
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');
        
         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
            echo json_encode(['status' => 'error', 'message' => 'service works is not server mode']); exit();
        }
               
        if (empty($_POST['id_hash'])) {
            echo json_encode(['status' => 'error', 'message' => 'POST array does not have id_hash']); exit();
        }
        
        $id_archive = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetch', PDO::FETCH_COLUMN],
                    ['id_archive'], 'backups',
                    [
                        ['id', '=',APP::Module('Crypt')->Decode($_POST['id_hash']), PDO::PARAM_INT]
                    ]);
        
        $files = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    ['id','backup_path'], 'backups',
                    [
                        ['id_archive', '=', $id_archive, PDO::PARAM_STR]
                    ]);
        
        
        if(!$files) {
            json_encode(['status'=>'file not exist']);       exit();
        }
        
        $pathtofile =  ROOT . '/protected/modules/BackUp/MANIFEST';
        
        foreach ($files as $file) {
            
        $manifest = file($pathtofile);
       
        for($i=0; $i != count($manifest); $i++) {
            preg_match('/\[file\](protected\/modules\/BackUp\/Uploads\/'.str_replace("/", "\/", preg_quote($file['backup_path'])).')\[\/file\]/ismU', $manifest[$i], $manifest_files);
           
            if (!empty($manifest_files)) {
                unset($manifest[$i]); break;
            }
        }
        unlink(ROOT.'/protected/modules/BackUp/Uploads/'.$file['backup_path']);
        file_put_contents($pathtofile, $manifest, LOCK_EX);
        }
        
        
          APP::Module('DB')->Delete(
                $this->conf['connection'], 'backups', Array(
            Array('id_archive', '=', $id_archive, PDO::PARAM_INT)
                )
        );
       
        rmdir(ROOT.'/protected/modules/BackUp/Uploads/'.explode($id_archive, $files[0]['backup_path'])[0].$id_archive);  
        echo json_encode(['status'=>'success']);            exit();
          
    }
    
    public function APIServerList() {
        
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');

        // client mode
         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
             echo json_encode(['status' => 'service works is not server mode']); exit();
        }
        
        $list = APP::Module('DB')->Select(
                    $this->conf['connection'], [
                'fetchAll',
                PDO::FETCH_ASSOC
                    ], [
                'id',
                'id_archive',       
                'backup_path',
                'date'
                    ], 'backups', [
                ['id_user', '=', APP::Module('Users')->user['id'], PDO::PARAM_INT],
                ['backup_path', 'LIKE','%.zip', PDO::PARAM_STR]       
            ]);
        
        if(empty($list)) {
            echo json_encode(['status' => 'success', 'message' => 'files are not exists']); exit();
        }
           
            foreach ($list as &$el) {
               $el['id_hash'] = APP::Module('Crypt')->Encode($el['id']);
               unset($el['backup_path']);
            }
            
            echo json_encode($list); exit();
    }

    public function GetFile() {
        
        $ref = $_SERVER['HTTP_REFERER'] ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $_SERVER['HTTP_ORIGIN'];

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');

         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
            echo json_encode(['status' => 'service works is not server mode']); exit();
        }

        if (isset($_FILES['file'])) {

            $user = APP::Module('Users')->user;
            preg_match_all('/([0-9]*)-([0-9]*)/ismU', $user['reg_date'], $user['temp']);
            $dir = 'protected/modules/BackUp/Uploads/' . $user['temp'][1][0] . '/' . $user['temp'][1][1] . '/' . $user['id'] . '/'.$_POST['folder'].'/';

            if (!file_exists(ROOT . '/' . $dir)) {
                mkdir(ROOT . '/' . $dir, 0750, true);
            }

            $uploadfile = $dir . basename($_FILES['file']['name']);
            
            if(file_exists($uploadfile)) {
                echo json_encode(['status' => 'error', 'message' => 'file with this name is exist']); exit();
            }

            move_uploaded_file($_FILES['file']['tmp_name'], ROOT . '/' . $uploadfile);


            if (!APP::Module('DB')->Insert(
                            $this->conf['connection'], 'backups', Array(
                        'id' => 'NULL',
                        'id_user' => Array($user['id'], PDO::PARAM_INT),
                        'id_archive' => Array($_POST['folder'], PDO::PARAM_STR),       
                        'backup_path' => Array($user['temp'][1][0] . '/' . $user['temp'][1][1] . '/' . $user['id'] . '/'.$_POST['folder']. '/'. basename($_FILES['file']['name']), PDO::PARAM_STR),
                        'date' => 'NOW()'
                            )
                    )) {
                echo json_encode(['status' => 'error', 'message' => 'error input file not exist']); exit();
            }

            $id = APP::Module('DB')->Open($this->conf['connection'])->lastinsertid();

            file_put_contents(ROOT . '/protected/modules/BackUp/MANIFEST', "\n" . '[file]' . $uploadfile . '[/file]', FILE_APPEND | LOCK_EX);

            echo json_encode(['status' => 'success', 'id' => $id]); exit();
        } else {
            echo json_encode(['status' => 'error', 'message'=>'input file not exist']); exit();
        }
    }
    
    public function Make() {
       
        ini_set('post_max_size', '2049');
        ini_set('upload_max_filesize', '2048M');

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

    public function Settings() {

        $backup_ssh_connection_name = APP::Module('DB')->Select(
                $this->conf['connection'], ['fetchAll', PDO::FETCH_ASSOC], ['value'], 'registry', [
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
