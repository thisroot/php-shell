<?
class Admin {

    function __construct($conf) {
        foreach ($conf['routes'] as $route) APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }

    public function Manage() {
        $modules = [];
        
        foreach (APP::$modules as $key => $value) {
            if (method_exists($value, 'Admin')) {
                $modules[$key] = $value->Admin();
            }
        }
        
        APP::Render('admin/index', 'include', $modules);
    }
    
    public function System() {
        $df = null;
        exec('df -h', $df);
        $top = sys_getloadavg();
        $free = null;
        exec('free', $free);
        $df_data = [];
        
        foreach ($df as $v1) {
            $line = [];
            foreach (explode(" ", $v1) as $v2) if ($v2) $line[] = $v2;
            $df_data[] = $line;
        }
        
        $free_data = [];
        
        foreach ($free as $v3) {
            $line = [];
            foreach (explode(" ", $v3) as $v4) if ($v4) $line[] = $v4;
            $free_data[] = $line;
        }

        APP::Render('admin/system', 'include', [$top, $df_data, $free_data]);
    }
    
    public function App() {
        APP::Render('admin/app/index');
    }
    
    public function ImportModules() {
        if (isset($_FILES['modules'])) {
            foreach ($_FILES['modules']['name'] as $key => $value) {
                if ($value) move_uploaded_file($_FILES['modules']['tmp_name'][$key], ROOT . '/protected/import/' . basename($value));
            }
        }
        
        APP::Render('admin/app/modules/import');
    }
    
    public function NetworkImportModules() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        APP::Import('admin/app/modules/network_import');
    }
    
    public function RemoveImportedModule() {
        $module = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['module_path']);
        unlink($module);
        header('Location: ' . APP::Module('Routing')->root . 'admin/app/modules/import');
        exit;
    }
    
    public function InstallImportedModules() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        APP::Install('admin/app/modules/install');
    }
    
    public function ExportModule() {
        APP::ExportModule(APP::Module('Crypt')->Decode(APP::Module('Routing')->get['module_hash']));
    }
    
    public function UninstallModule() {   
        $module = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['module_hash']);
        APP::Render('admin/app/modules/uninstall', 'include',[$module, APP::InstalledModuleDependencies($module)]);
    }
    
    public function APIUninstallModule() {   
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode(APP::UninstallModule(APP::Module('Crypt')->Decode(APP::Module('Routing')->get['module_hash'])));
        exit;
    }

}