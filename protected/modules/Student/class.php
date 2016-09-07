<?

class Student {
    
    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
    public function Index() {
        echo 'privet';
    }
    
}