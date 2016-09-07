<?
     
class BackUp {
    
    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
    public function Admin() {
        return APP::Render('backup/admin/nav', 'content');
    }
    
    public function Install() {
        
        return APP::Render('backup/admin/install');
    }
    
    public function Installold() {
        return APP::Render('backup/admin/install_1', 'content');
    }
    
    protected function APIHeader() {
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');
    }
    
    private function Auth($AuthUrl,$login,$pass) {
       
       // SAMPLE: $AuthUrl = '/users/api/login.json';
        
        $this->APIHeader();
          
             $ch = curl_init();
        // if https connetion
        if (strtolower((substr($AuthUrl, 0, 5)) == 'https')) { 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        
        curl_setopt($ch, CURLOPT_URL, $AuthUrl);
        curl_setopt($ch, CURLOPT_REFERER, APP::Module('Routing')->root);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $login . "&password=" . $pass. "&remember-me=true");
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
        
        
        if(!json_decode($body)->status == 'success') {
            return FALSE;
        }
        
        return TRUE;
    }
    
    private function PostRequest($data) {
        
        // SAMPLE: $data['url'] = '/users/api/login.json';
        //         $data['referer'] = 
        //         $data['cookie_path'] = 
        //         $data['referer'] = 
        //         $data['post'] = 
      
        $ch = curl_init();
        if (strtolower((substr($data['url'], 0, 5)) == 'https')) { 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        
        curl_setopt($ch, CURLOPT_REFERER,$data['referer']);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-SHELL');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $data['url']);
        curl_setopt($ch, CURLOPT_COOKIEFILE,$data['cookie_path']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data['post']);
        
        $result = curl_exec($ch);
        // Then, after your curl_exec call:
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        return $body;
    }

    public function APIClientList() {
        
        $APIServer = '/backup/user/api/server/list.json';
        $APILogin = '/users/api/login.json';
        
        $this->APIHeader();
          
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
        }
        
        $backups = [];
        $rows = [];
        $tmp_connections = APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value']);
        $tmp_backups = json_decode($body, true);
        
       
        foreach ($tmp_backups as $backup) {
            
            $backup_name = $backup['id_archive'];
            if (($_POST['searchPhrase']) && (preg_match('/^' . $_POST['searchPhrase'] . '/', $backup_name) === 0)) continue;
            
            array_push($backups, [
                'id' => $backup['id'],
                'value' => $backup_name,
                'token' => $backup['id_hash'],
                'date' => $backup['date']    
            ]);
        }
        
          // sort desc
        rsort($backups);
        
        for ($x = ($_POST['current'] - 1) * $_POST['rowCount']; $x < $_POST['rowCount'] * $_POST['current']; $x ++) {
            if (!isset($backups[$x])) continue;
            array_push($rows, $backups[$x]);
        }
        
      
        
        echo json_encode([
            'current' => $_POST['current'],
            'rowCount' => $_POST['rowCount'],
            'rows' => $rows,
            'total' => count($backups)
        ]);
        exit;
           
    }
    
    
    
    public function SendFile(){
        
        $status = 'false';
        
        $setings = [
            'url_auth' => APP::Module('Registry')->Get('module_backup_remote_host').'/users/api/login.json',
            'url' => APP::Module('Registry')->Get('module_backup_remote_host').'/backup/user/server/upload',
            'email' => APP::Module('Registry')->Get('module_backup_remote_email'),
            'pass' => APP::Module('Crypt')->Decode(APP::Module('Registry')->Get('module_backup_remote_pass')),
            'cookie_path' => ROOT. '/protected/modules/BackUp/cookie.txt',
            'referer' => APP::Module('Routing')->root
        ];
        
        // Authentification
        if(!$this->Auth($setings['url_auth'],$setings['email'],$setings['pass'])) {
            echo json_encode(['status'=>'error', 'message' => 'authentification failed']); exit();
        }
        
        // GetParams
        $setings['url'] = APP::Module('Registry')->Get('module_backup_remote_host').'/backup/api/server/params.json';
        $setings['post'] = "";
        $params = json_decode($this->PostRequest($setings));
        $setings['url'] =APP::Module('Registry')->Get('module_backup_remote_host').'/backup/user/server/upload';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $setings['url']);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $setings['cookie_path'] );
            
            
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
        
 if(!shell_exec('cd '.ROOT.'/ ;mkdir /tmp/'.$archiveFolder.'; zip -r -s '.$params->module_backup_segment_size.'  /tmp/'.$archiveFolder.'/'.$archiveName.' .* -x logs\* ..\*')) {
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
    
    public function APIServerParams() {
        $this->APIHeader();
        echo json_encode(APP::Module('Registry')->Get(['module_backup_segment_size', 'module_backup_max_saved_backups' ]));   
    }
    
    public function APIServerDownload() {
        
        $this->APIHeader();
        
         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
            echo json_encode(['status' => 'service works is not server mode']); exit();
        }
        
        
        if (empty(APP::Module('Routing')->get['id_hash'])) {
           
            echo json_encode(['status' => 'error', 'message' => 'Get array does not have id_hash']); exit();
        }
        
        $path = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['backup_path','id_archive'], 'backups',
                    [
                        ['id', '=',APP::Module('Crypt')->Decode(APP::Module('Routing')->get['id_hash']), PDO::PARAM_INT]
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
        
        $this->APIHeader();
        
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
        
        $this->APIHeader();

        // client mode
         if(APP::Module('Registry')->Get('module_backup_server_mode') === '0') {
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
    
   
    
    public function APIClientUpdateSettings() {
        
      $this->APIHeader();
      
     // echo json_encode($_POST);      exit();
      
      if(!$this->Auth($_POST['host'].'/users/api/login.json', $_POST['email'], $_POST['pass'])) {
          echo json_encode(['status' => 'error', 'errors' => [0]]); exit;
      }
      
      APP::Module('Registry')->Update(['value' => $_POST['ssh_connection']], [['item', '=', 'module_backup_ssh_connection', PDO::PARAM_STR]]);
      APP::Module('Registry')->Update(['value' => $_POST['host']], [['item', '=', 'module_backup_remote_host', PDO::PARAM_STR]]);
      APP::Module('Registry')->Update(['value' => $_POST['email']], [['item', '=', 'module_backup_remote_email', PDO::PARAM_STR]]);
      APP::Module('Registry')->Update(['value' => APP::Module('Crypt')->Encode($_POST['pass'])], [['item', '=','module_backup_remote_pass', PDO::PARAM_STR]]);
      
      if(isset($_POST['server_mode'])) {
          
          APP::Module('Registry')->Update(['value' => 1], [['item', '=', 'module_backup_server_mode', PDO::PARAM_STR]]);
          APP::Module('Registry')->Update(['value' => $_POST['max_backups']], [['item', '=', 'module_backup_max_saved_backups', PDO::PARAM_STR]]);
          APP::Module('Registry')->Update(['value' => $_POST['size_segment']], [['item', '=', 'module_backup_segment_size', PDO::PARAM_STR]]);
      } else {
          APP::Module('Registry')->Update(['value' => 0], [['item', '=', 'module_backup_server_mode', PDO::PARAM_STR]]);
      }
      
      if(isset($_POST['jobs_every'])) {
          $CMD = 'php ' . ROOT . '/init.php BackUp SendFile';
          
           switch ($_POST['jobs_every'][0]) {
            case 'day': // 0 0 * * *
                $flag = true;
                $job = ['0', '0', '*', '*', '*', $CMD];
               // array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '*', '*', '*', $CMD]));
                break;
            case 'week': // 0 0 * * 0
                $flag = true;
                $job = ['0', '0', '*', '*', '0', $CMD]; 
               // array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '*', '*', '0', $CMD]));
                break;
            case 'month': // 0 0 1 * *
                $flag = true;
                $job = ['0', '0', '1', '*', '*', $CMD];
              //  array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '1', '*', '*', $CMD]));
                break;
            case 'year': // 0 0 1 1 *
                $flag = true;
                $job = ['0', '0', '1', '1', '*', $CMD];
              //  array_push($result, APP::Module('Cron')->Add($SSH, ['0', '0', '1', '1', '*', $CMD]));
                break;
        }
        
        if(isset($flag)) {
            $jobValue = APP::Module('DB')->Select(
                    APP::Module('BackUp')->conf['connection'], [ 'fetch', PDO::FETCH_ASSOC], ['id','value', 'sub_id'], 'registry', [
                ['value', 'LIKE', '%BackUp SendFile', PDO::PARAM_STR]
            ]);
             APP::Module('Cron')->Remove($jobValue['sub_id'], [$jobValue['value']]);
             APP::Module('Registry')->Delete([['id', '=', $jobValue['id'], PDO::PARAM_STR]]);
             APP::Module('Cron')->Add($_POST['ssh_connection'], $job);
        }
      }
      
        echo json_encode([
            'status' => 'success',
            'errors' => []
        ]);
        exit;
    }
    
    public function APIClientAddBackUp() {
        
      $this->APIHeader();
      
        // Authentification
        if(!$this->Auth(
                APP::Module('Routing')->root.'users/api/login.json',
                APP::Module('Users')->user['email'],
                APP::Module('Crypt')->Decode( APP::Module('Users')->user['password'])
                )) {
            echo json_encode(['status'=>'error', 'message' => 'authentification failed']); exit();
        }
        
        $setings = [
            'url' => APP::Module('Routing')->root.'admin/backup/send',
            'cookie_path' => ROOT. '/protected/modules/BackUp/cookie.txt',
            'referer' => APP::Module('Routing')->root,
            'post' => ""
        ];
        
        // GetParams
        echo $this->PostRequest($setings);

    }

    public function GetFile() {
      
        $this->APIHeader();

         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
            echo json_encode(['status' => 'service works is not server mode']); exit();
        }
        
 
        $backups = APP::Module('DB')->Select(
                APP::Module('BackUp')->conf['connection'], [ 'fetchAll', PDO::FETCH_ASSOC], ['id', 'id_archive'], 'backups', [
            ['id_user', '=', APP::Module('Users')->user['id'], PDO::PARAM_STR],
            ['backup_path', 'LIKE', '%.zip', PDO::PARAM_STR]
        ]);
        
        $max_backups = APP::Module('Registry')->Get('module_backup_max_saved_backups');
  
        if(count($backups) == $max_backups ) {
            $this->Remove($backups[0]['id']);
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
            
            // Inspection on backup limits
            
            

            echo json_encode(['status' => 'success', 'id' => $id]); exit();
        } else {
            echo json_encode(['status' => 'error', 'message'=>'input file not exist']); exit();
        }
    }
    
    private function Remove($id) {
        
         if(APP::Module('Registry')->Get('module_backup_server_mode') === 'false') {
             return (['status' => 'error', 'message' => 'service works is not server mode']);
        }
               
        
        $id_archive = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetch', PDO::FETCH_COLUMN],
                    ['id_archive'], 'backups',
                    [
                        ['id', '=',$id, PDO::PARAM_INT]
                    ]);
        
        $files = APP::Module('DB')->Select(
                    $this->conf['connection'], 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    ['id','backup_path'], 'backups',
                    [
                        ['id_archive', '=', $id_archive, PDO::PARAM_STR]
                    ]);
        
        
        if(!$files) {
            return (['status'=>'file not exist']);
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
        return (['status'=>'success']);
          
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
        
        $jobs = json_decode(APP::Module('Registry')->Get('module_backup_cron_id'));
        
        foreach ($jobs as $job) {
            $jobValue = APP::Module('DB')->Select(
                    APP::Module('BackUp')->conf['connection'], [ 'fetch', PDO::FETCH_ASSOC], ['id','value', 'sub_id'], 'registry', [
                ['value', 'LIKE', '%BackUp SendFile', PDO::PARAM_STR]
            ]);
            
            preg_match_all('/(.*) php/ismU', $jobValue['value'], $tmp);
       
            switch ($tmp[1][0]){
                case '0 0 * * *':
                    $every = 'day';
                    break;
                case '0 0 * * 0':
                    $every = 'week';
                    break;
                case '0 0 1 * *':
                    $every = 'month';
                    break;
                case '0 0 1 1 *':
                    $every = 'year';
                    break;
                default :
                    $every = 'notset';
            }

        }

        $data = [
            0 => APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value']),
            1 => $backup_ssh_connection_name,
            'host'  => APP::Module('Registry')->Get('module_backup_remote_host'),
            'email'  => APP::Module('Registry')->Get('module_backup_remote_email'),
            'pass'  => APP::Module('Crypt')->Decode(APP::Module('Registry')->Get('module_backup_remote_pass')),
            'mode'  => APP::Module('Registry')->Get('module_backup_server_mode'),
            'module_backup_segment_size' => APP::Module('Registry')->Get('module_backup_segment_size'),
            'module_backup_max_saved_backups' => APP::Module('Registry')->Get('module_backup_max_saved_backups'),
            'every_job' => $every   
        ];
        
        APP::Render('backup/admin/index', 'include', $data);
    }

    public function BackupList() {
        APP::Render('backup/admin/list');
    }
    
    public function APIClientRestore() {
        
        
        ini_set('max_execution_time', 900);
        
        $this->APIHeader();
        
           
         if (empty($_POST['id_hash'])) {
            echo json_encode(['status' => 'error', 'message' => 'Get array does not have id_hash']); exit();
        }
        
        // download archive into /tmp directory
        if(!shell_exec('cd /tmp ; wget '.APP::Module('Registry')->Get('module_backup_remote_host').'/backup/api/server/download.json?id_hash='.$_POST['id_hash'].' -O archive.zip && echo true || echo false')) {
             echo json_encode(['status' => 'error', 'message' => 'failure archive download']); exit();
        }
        
        // unzip archive
        if(!shell_exec('cd /tmp ; rm -rf '.ROOT.'; unzip archive.zip -d '.ROOT.'/ && echo true || echo false')) {
             echo json_encode(['status' => 'error', 'message' => 'failure archive download']); exit();
        }
        
        
        // change DB
        //  'mysql -u shell -pprf34NAZ6AwP -e \'drop database shell\'';
        //   'mysql -u shell -pprf34NAZ6AwP -e \'drop create shell\'';
        //   'mysql -ushell -pprf34NAZ6AwP shell < /var/www/adminus/data/www/aurus.me/shell/db/auto-localhost-shell.sql';
        
       //create all DB dumps;
        foreach (APP::Module('DB')->conf['connections'] as $key => $value) {

            $cmd = 'mysql '
                    . '--user=' . $value['username']
                    . ' --password=' . $value['password']
                    . ' --host=' . $value['host']
                    . ' -e \'drop database '
                    . $value['database'].'\'';
                    
           
            APP::Module('SSH')->Exec(APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'), $cmd);
            
            $cmd = 'mysql '
                    . '--user=' . $value['username']
                    . ' --password=' . $value['password']
                    . ' --host=' . $value['host']
                    . ' -e \'create database '
                    . $value['database'].'\'';
                    
           

            APP::Module('SSH')->Exec(APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'), $cmd);
            
            $cmd = 'mysql '
                    . '--user=' . $value['username']
                    . ' --password=' . $value['password']
                    . ' --host=' . $value['host']
                    . ' '.$value['database']
                    . ' < '.ROOT.'/db/'
                    . $key
                    . '-' . $value['host']
                    . '-' . $value['database']
                    . '.sql';
           
        shell_exec($cmd);
        //   APP::Module('SSH')->Exec(APP::Module('Registry')->Get('module_backup_ssh_connection', 'value'), $cmd);
            
        }
            
        array_map('unlink', glob(ROOT.'/db/*.*'));
        rmdir(ROOT.'/db');
        unlink("/tmp/archive.zip");

        
        echo json_encode(['status' => 'success', 'message' => 'archive has been download']); exit();
        exit();
      
    }
    
}


