<?

class Student {
    
    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
    public function Index() {
        return APP::Render('student/index');
    }
    
    public function AddLection() {
        return APP::Render('student/user/lectures/add');
    }
    
    // API VK
    public function GetCountry() {
        
        echo json_encode(
                [
                    ['id'=>1,'name'=>'russia'],
                    ['id'=>2,'name'=>'greec'],
                    ['id'=>3,'name'=>'china'],
                    ['id'=>4,'name'=>'china'],
                    ['id'=>5,'name'=>'drefad'],
                    ['id'=>6,'name'=>'chisdsaddsadna'],
                    ['id'=>7,'name'=>'chidsdasdna'],
                    ['id'=>8,'name'=>'chdsadsaina'],
                    ['id'=>9,'name'=>'dasasdsa'],
                    ['id'=>10,'name'=>'dasda'],
                    ['id'=>11,'name'=>'chasdasdsina'],
                    ['id'=>12,'name'=>'dfsafasd'],
                    ['id'=>13,'name'=>'cancda']
                ]
                );
    }

}