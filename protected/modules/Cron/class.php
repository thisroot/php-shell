<?
class Cron {

    private $file;

    function __construct($conf) {
        foreach ($conf['routes'] as $route) APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
        $this->file = APP::Module('Registry')->Get('module_cron_tmp_file');
    }

    
    public function Admin() {
        return APP::Render('cron/admin/nav', 'content');
    }

    
    public function Add($ssh, $job) {
        $cron_job = implode(' ', $job);
        
        if (!(int) APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
            ['id'], 'registry',
            [
                ['sub_id', '=', $ssh, PDO::PARAM_INT],
                ['item', '=', 'module_cron_job', PDO::PARAM_STR],
                ['value', '=', $cron_job, PDO::PARAM_STR]
            ]
        )) {
            $this->AddCronJob($ssh, $cron_job);
            return APP::Module('Registry')->Add('module_cron_job', $cron_job, $ssh);
        }
        
        return false;
    }
    
    public function Remove($ssh, $job) {
        $cron_job = implode(' ', $job);
        
        $where = [
            ['sub_id', '=', $ssh, PDO::PARAM_INT],
            ['item', '=', 'module_cron_job', PDO::PARAM_STR],
            ['value', '=', $cron_job, PDO::PARAM_STR]
        ];
        
        if ((int) APP::Module('DB')->Select(APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], ['id'], 'registry', $where)) {
            $this->RemoveCronJob($ssh, $cron_job);
            return APP::Module('Registry')->Delete($where);
        }
        
        return false;
    }
    
    
    private function AddCronJob($ssh, $job) {
        if (!file_exists($this->file)) {
            APP::Module('SSH')->Exec($ssh, 'crontab -l > ' . $this->file . ' && [ -f ' . $this->file . ' ] || > ' . $this->file);
        }

        APP::Module('SSH')->Exec($ssh, 'echo "' . $job . '" >> ' . $this->file);
        APP::Module('SSH')->Exec($ssh, 'crontab ' . $this->file);
        APP::Module('SSH')->Exec($ssh, 'rm ' . $this->file);
    }

    private function RemoveCronJob($ssh, $job) {
        if (!file_exists($this->file)) {
            APP::Module('SSH')->Exec($ssh, 'crontab -l > ' . $this->file . ' && [ -f ' . $this->file . ' ] || > ' . $this->file);
        }

        $cron_jobs = file($this->file, FILE_IGNORE_NEW_LINES);
        $up_jobs = preg_grep('/' . preg_quote($job, '/') . '/', $cron_jobs, PREG_GREP_INVERT);

        APP::Module('SSH')->Exec($ssh, 'rm ' . $this->file);
        
        if ((count($cron_jobs) !== count($up_jobs))) {
            APP::Module('SSH')->Exec($ssh, 'crontab -r');
            foreach ($up_jobs as $job) $this->AddCronJob($ssh, $job);
        }
    }

    
    public function SelectSSHConnection() {
        $connections = (array) APP::Module('Registry')->Get(['module_ssh_connection'], ['id', 'value']);
        APP::Render('cron/admin/index', 'include', $connections ? $connections['module_ssh_connection'] : []);
    }
    
    public function ManageJobs() {
        $ssh_id = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['ssh_id_hash']);
        $jobs = (array) APP::Module('Registry')->Get(['module_cron_job'], ['id', 'value'], $ssh_id);
        
        APP::Render('cron/admin/jobs', 'include', [
            'ssh' => json_decode(APP::Module('DB')->Select(
                APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
                ['value'], 'registry',
                [['id', '=', $ssh_id, PDO::PARAM_INT]]
            ), 1),
            'jobs' => $jobs ? $jobs['module_cron_job'] : []
        ]);
    }

    public function AddJob() {
        $ssh_id = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['ssh_id_hash']);

        APP::Render('cron/admin/add', 'include', [
            'ssh' => json_decode(APP::Module('DB')->Select(
                APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
                ['value'], 'registry',
                [['id', '=', $ssh_id, PDO::PARAM_INT]]
            ), 1)
        ]);
    }

    public function EditJob() {
        $job = APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetch', PDO::FETCH_ASSOC], 
            ['sub_id', 'value'], 'registry',
            [['id', '=', APP::Module('Crypt')->Decode(APP::Module('Routing')->get['job_id_hash']), PDO::PARAM_INT]]
        );
        
        $ssh = APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetch', PDO::FETCH_ASSOC], 
            ['id', 'value'], 'registry',
            [['id', '=', $job['sub_id'], PDO::PARAM_INT]]
        );

        APP::Render('cron/admin/edit', 'include', [
            'ssh' => [$ssh['id'], json_decode($ssh['value'])],
            'job' => explode(' ', $job['value'], 6)
        ]);
    }
    
    public function Settings() {
        APP::Render('cron/admin/settings', 'include', APP::Module('Registry')->Get('module_cron_tmp_file'));
    }

    
    public function APIAddJob() {
        $ssh_id = APP::Module('Crypt')->Decode($_POST['ssh_id_hash']);
        
        $out = [
            'status' => 'success',
            'errors' => []
        ];

        if (empty($_POST['job'][0])) {
            $out['status'] = 'error';
            $out['errors'][] = 1;
        }
        
        if (empty($_POST['job'][1])) {
            $out['status'] = 'error';
            $out['errors'][] = 2;
        }
        
        if (empty($_POST['job'][2])) {
            $out['status'] = 'error';
            $out['errors'][] = 3;
        }
        
        if (empty($_POST['job'][3])) {
            $out['status'] = 'error';
            $out['errors'][] = 4;
        }
        
        if (empty($_POST['job'][4])) {
            $out['status'] = 'error';
            $out['errors'][] = 5;
        }
        
        if (empty($_POST['job'][5])) {
            $out['status'] = 'error';
            $out['errors'][] = 6;
        }
        
        if (APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
            ['COUNT(id)'], 'registry',
            [
                ['sub_id', '=', $ssh_id, PDO::PARAM_INT],
                ['value', '=', implode(' ', $_POST['job']), PDO::PARAM_STR]
            ]
        )) {
            $out['status'] = 'error';
            $out['errors'][] = 7;
        }
        
        if ($out['status'] == 'success') {
            $out['job_id'] = $this->Add($ssh_id, $_POST['job']);
        }

        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }
    
    public function APIUpdateJob() {
        $job_id = APP::Module('Crypt')->Decode($_POST['job_id_hash']);

        $out = [
            'status' => 'success',
            'errors' => []
        ];
        
        if (!APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
            ['COUNT(id)'], 'registry',
            [['id', '=', $job_id, PDO::PARAM_INT]]
        )) {
            $out['status'] = 'error';
            $out['errors'][] = 1;
        }

        if (empty($_POST['job'][0])) {
            $out['status'] = 'error';
            $out['errors'][] = 2;
        }
        
        if (empty($_POST['job'][1])) {
            $out['status'] = 'error';
            $out['errors'][] = 3;
        }
        
        if (empty($_POST['job'][2])) {
            $out['status'] = 'error';
            $out['errors'][] = 4;
        }
        
        if (empty($_POST['job'][3])) {
            $out['status'] = 'error';
            $out['errors'][] = 5;
        }
        
        if (empty($_POST['job'][4])) {
            $out['status'] = 'error';
            $out['errors'][] = 6;
        }
        
        if (empty($_POST['job'][5])) {
            $out['status'] = 'error';
            $out['errors'][] = 7;
        }
        
        $job = APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetch', PDO::FETCH_ASSOC], 
            ['sub_id', 'value'], 'registry',
            [['id', '=', $job_id, PDO::PARAM_INT]]
        );

        if (APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
            ['COUNT(id)'], 'registry',
            [
                ['sub_id', '=', $job['sub_id'], PDO::PARAM_INT],
                ['value', '=', implode(' ', $_POST['job']), PDO::PARAM_STR]
            ]
        )) {
            $out['status'] = 'error';
            $out['errors'][] = 8;
        }
        
        if ($out['status'] == 'success') {
            $this->Remove($job['sub_id'], explode(' ', $job['value'], 6));
            $this->Add($job['sub_id'], $_POST['job']);
        }

        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }

    public function APIRemoveJob() {
        $job_id = APP::Module('Crypt')->Decode($_POST['job_id_hash']);
        
        $out = [
            'status' => 'success',
            'errors' => []
        ];

        if (!APP::Module('DB')->Select(
            APP::Module('Registry')->conf['connection'], ['fetchColumn', 0], 
            ['COUNT(id)'], 'registry',
            [['id', '=', $job_id, PDO::PARAM_INT]]
        )) {
            $out['status'] = 'error';
            $out['errors'][] = 1;
        }
        
        if ($out['status'] == 'success') {
            $job = APP::Module('DB')->Select(
                APP::Module('Registry')->conf['connection'], ['fetch', PDO::FETCH_ASSOC], 
                ['sub_id', 'value'], 'registry',
                [['id', '=', $job_id, PDO::PARAM_INT]]
            );
            
            $out['count'] = $this->Remove($job['sub_id'], explode(' ', $job['value'], 6));
        }

        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }
    
    public function APIUpdateSettings() {
        APP::Module('Registry')->Update(['value' => $_POST['module_cron_tmp_file']], [['item', '=', 'module_cron_tmp_file', PDO::PARAM_STR]]);

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