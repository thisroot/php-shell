<?
class Logs {

    function __construct($conf) {
        foreach ($conf['routes'] as $route) APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
    public function Admin() {
        return APP::Render('logs/admin/nav', 'content');
    }

    public function Manage() {
        APP::Render('logs/admin/index', 'include', glob(APP::$conf['logs'] . '/*.log'));
    }
    
    public function View() {
        $file = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['file']);
        APP::Render('logs/admin/view', 'include', [$file, file($file)]);
    }
    
    public function Remove() {
        $file = APP::Module('Crypt')->Decode(APP::Module('Routing')->get['file']);
        APP::Render('logs/admin/remove', 'include', [$file, file_exists($file) ? unlink($file) : false]);
    }

}