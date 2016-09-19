<?

class Student {
    
    function __construct($conf) {
        foreach ($conf['routes'] as $route)
            APP::Module('Routing')->Add($route[0], $route[1], $route[2]);
    }
    
    public function Index() {
        return APP::Render('student/index', 'include',  APP::Module('Users')->user);
    }
    
    public function AddUser($id, $data) {
           
        APP::Module('DB')->Insert(
                            'auto', 'student_user_perfences', [
                        'id' => $data['user_id']
                            ]
                    );
        APP::Module('User')->Logout();
        return 1;
    }
     
    public function UserSettings() {
        
        $data = [
            'user' => APP::Module('Users')->user,
            'user_settings' =>  APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['*'], 'student_user_settings',
                    [
                        ['id', '=', APP::Module('Users')->user['id'], PDO::PARAM_INT]
                    ]),
            'user_template' => APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['*'], 'student_user_templates',
                    [
                        ['id_user', '=', APP::Module('Users')->user['id'], PDO::PARAM_INT],
                        ['type', '=', 'uni', PDO::PARAM_STR]
                    ])
            ];
        
        return APP::Render('student/user/settings', 'include', $data );
    }

    protected function SetHeader() {
        $ref = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : false;
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN']: '';
        $domain = is_array($ref) ? $ref['scheme'] . '://' . $ref['host'] : $origin;

        header('Access-Control-Allow-Origin: ' . ($domain ? $domain : '*'));
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Content-Type: application/json');
    }
    
    public function LectureAdd() {
        return APP::Render('student/user/lectures/add');
    }
    
    public function APILectureAdd() {
        $this->SetHeader();
        
        if (empty($_POST)) {
            echo json_encode(['status' => 'error', 'message' => 'does not have post data']); exit();
        }
        
        if (!APP::Module('DB')->Insert(
                            'auto', 'student_lectures', Array(
                        'id' => 'NULL',
                        'id_user' => Array(APP::Module('Users')->user['id'], PDO::PARAM_INT),
                        'private' => Array(0, PDO::PARAM_INT),
                        'name' =>Array($_POST['lecture'],  PDO::PARAM_STR),       
                        'country' =>Array($_POST['country'],  PDO::PARAM_STR),       
                        'city' =>Array($_POST['city'],  PDO::PARAM_STR),       
                        'university' =>Array($_POST['university'],  PDO::PARAM_STR),       
                        'faculty' =>Array($_POST['faculty'],  PDO::PARAM_STR),       
                        'chair' =>Array($_POST['chair'],  PDO::PARAM_STR),       
                        'date' => 'NOW()',
                        'date_last_update' => 'NOW()',
                            )
                    )) {
                echo json_encode(['status' => 'error', 'message' => 'error inseet to DB']); 
                throw new Exception('error inseet to DB');
            }
            $id = APP::Module('DB')->Open('auto')->lastinsertid();
            echo json_encode(
                ['status' => 'success',
                    'hash' => APP::Module('Crypt')->Encode($id)]
        );
    }
    
    public function LectureFind() {
        return APP::Render('student/find_lectures');
    }
    
    
    public function LectureView() {
        
        return APP::Render('student/user/lectures/view', 'include', 
            
           APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['id','id_user','private', 'name', 'country', 'city', 'university', 'faculty', 'chair','date','date_last_update'], 'student_lectures',
                    [
                        ['id', '=', APP::Module('Crypt')->Decode(APP::Module('Routing')->get['hash']), PDO::PARAM_INT]
                    ])
        );
    }

        public function APILectureFind() {
        $this->SetHeader();
        
        if (empty($_POST)) {
            echo json_encode(['status' => 'error', 'message' => 'does not have post data']); exit();
        }
         
        
        $list =   APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    [$_POST['set']], 'student_lectures',[],[], [$_POST['set']]);  
          $out = [] ;

            foreach ($list as $item => $value) {
              
            if (($_POST['search']) && (preg_match('/^.*' . $_POST['search'] . '.*/', $value[$_POST['set']]) === 0)) continue;    
            
            array_push($out, [
                'id' => $item + 1,
                'name' => $value[$_POST['set']],  
            ]);
        }
        echo json_encode($out); exit();
    }

    public function LectureList() {
        
        return APP::Render('student/user/lectures/list', 'include',
                ['id_hash' => APP::Module('Crypt')->Encode(APP::Module('Users')->user['id'])]);
    }
    
    public function APILectureList() {
        
        $this->SetHeader();
              
         
          $list =   APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    ['id','id_user','private', 'name', 'country', 'city', 'university', 'faculty', 'chair','date','date_last_update'], 'student_lectures',
                    [
                        ['id_user', '=', APP::Module('Users')->user['id'], PDO::PARAM_INT]
                    ]);
                
        $out = [];
        $rows = [];
        
        foreach ($list as $item) {
            
            $list_name = $item['name'];
            $university = $item['university'];
            $faculty = $item['faculty'];
            $chair = $item['chair'];
            
            if (($_POST['searchPhrase']) && (preg_match('/^.*' . $_POST['searchPhrase'] . '.*/', $list_name) === 0)) continue;
           
            array_push($out, [
                'id' => $item['id'],
                'id_hash' => APP::Module('Crypt')->Encode($item['id']),
                'country' => $item['country'],
                'city' => $item['city'],
                'university' => $item['university'],
                'faculty' => $item['faculty'],
                'chair' => $item['chair'],
                'name' => $item['name'],
                'date' => $item['date']    
            ]);
        }
        
          // sort desc
        rsort($out);
        
        for ($x = ($_POST['current'] - 1) * $_POST['rowCount']; $x < $_POST['rowCount'] * $_POST['current']; $x ++) {
            if (!isset($out[$x])) continue;
            array_push($rows, $out[$x]);
        }
        
      
        
        echo json_encode([
            'current' => $_POST['current'],
            'rowCount' => $_POST['rowCount'],
            'rows' => $rows,
            'total' => count($out)
        ]);
        exit;
    }
    
    public function APILectureOpenList() {
        
        $this->SetHeader();
        
          $list =   APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    ['id','id_user','private', 'name', 'country', 'city', 'university', 'faculty', 'chair','date','date_last_update'], 'student_lectures',
                    [
                        ['private', 'IN', [0,-1], PDO::PARAM_INT]
                       
                    ]);
                
        $out = [];
        $rows = [];
        
       
       
        foreach ($list as $item) {
              
            $list_name = $item['name'];
            
            if($_POST['searchPhrase'] != '') { if (($_POST['searchPhrase']) && (preg_match('/^.*' . $_POST['searchPhrase'] . '.*/', $list_name) === 0)) continue;}
            if($_POST['university'] != '') { if (($_POST['university']) && (preg_match('/^.*' . $_POST['university'] . '.*/', $item['university']) === 0)) continue;}
            if($_POST['faculty'] != '') { if (($_POST['faculty']) && (preg_match('/^.*' . $_POST['faculty'] . '.*/', $item['faculty']) === 0)) continue;}
            if($_POST['chair'] != '') { if (($_POST['chair']) && (preg_match('/^.*' . $_POST['chair'] . '.*/', $item['chair']) === 0)) continue; }
           
            array_push($out, [
                'id' => $item['id'],
                'id_hash' => APP::Module('Crypt')->Encode($item['id']),
                'country' => $item['country'],
                'city' => $item['city'],
                'university' => $item['university'],
                'faculty' => $item['faculty'],
                'chair' => $item['chair'],
                'name' => $item['name'],
                'date' => $item['date']    
            ]);
        }
        
          // sort desc
        rsort($out);
        
        for ($x = ($_POST['current'] - 1) * $_POST['rowCount']; $x < $_POST['rowCount'] * $_POST['current']; $x ++) {
            if (!isset($out[$x])) continue;
            array_push($rows, $out[$x]);
        }
        
      
        
        echo json_encode([
            'current' => $_POST['current'],
            'rowCount' => $_POST['rowCount'],
            'rows' => $rows,
            'total' => count($out)
        ]);
        exit;
    }
    
    public function LectureEdit() {
        return APP::Render('student/user/lectures/edit', 'include', 
            
           APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['id','id_user','private', 'name', 'country', 'city', 'university', 'faculty', 'chair','date','date_last_update'], 'student_lectures',
                    [
                        ['id', '=', APP::Module('Crypt')->Decode(APP::Module('Routing')->get['hash']), PDO::PARAM_INT]
                    ])
        );
    }
    
    public function APIBlockDelete() {
        $this->SetHeader();
        
         if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
        APP::Module('DB')->Delete(
        'auto', 'student_lecture_blocks',
        [
             ['id_block', '=', $_POST['item'], PDO::PARAM_INT]
         ]
        );
        
        echo   json_encode(['status'=> 'success']); exit(); 
    }
    
    public function APILectureDelete() {
        $this->SetHeader();
        
         if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
        $id = APP::Module('Crypt')->Decode($_POST['id_hash']);

        APP::Module('DB')->Delete(
        'auto', 'student_lectures',
        [
             ['id', '=', $id, PDO::PARAM_INT]
         ]
        ); 
        
        APP::Module('DB')->Delete(
        'auto', 'student_lecture_blocks',
        [
             ['id_lecture', '=', $id, PDO::PARAM_INT]
         ]
        ); 
        
        APP::Module('DB')->Delete(
        'auto', 'student_struct_blocks',
        [
             ['id_lecture', '=', $id, PDO::PARAM_INT]
         ]
        ); 
        
        echo   json_encode(['status'=> $_POST]); exit(); 
    }

        public function APIBlockEdit() {
        $this->SetHeader();
        
         if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }

        $id = APP::Module('Crypt')->Decode($_POST['pk']);
        
        switch ($_POST['name']) {
            case 'update-index':

                $index = (isset($_POST['index'])) ? $_POST['index'] : [""];
                $id = APP::Module('Crypt')->Decode($_POST['pk']);
                $now = (new \DateTime())->format('Y-m-d H:i:s');

                if (APP::Module('DB')->Select(
                                'auto', [ 'fetch', PDO::FETCH_COLUMN], ['id_lecture'], 'student_struct_blocks', [
                            ['id_lecture', '=', $id, PDO::PARAM_INT]
                        ]) == $id) {

                    APP::Module('DB')->Update(
                            'auto', 'student_struct_blocks', [
                        'struct' => json_encode($index),
                        'date' => $now
                            ], [
                        ['id_lecture', '=', $id, PDO::PARAM_INT]
                            ]
                    );
                } else {
                    APP::Module('DB')->Insert(
                            'auto', ' student_struct_blocks', [
                        'id' => 'NULL',
                        'id_lecture' => [$id, PDO::PARAM_INT],
                        'struct' => [json_encode($index), PDO::PARAM_STR],
                        'date' => 'NOW()'
                    ]);
                }
                echo json_encode(['status' => 'success']);
                exit();


            case 'block-edit-name':
                $now = (new \DateTime())->format('Y-m-d H:i:s');
                $id_lecture = APP::Module('Crypt')->Decode($_POST['lecture']);

                if (APP::Module('DB')->Select(
                                'auto', [ 'fetch', PDO::FETCH_COLUMN], ['id_block'], 'student_lecture_blocks', [
                            ['id_lecture', '=', $id_lecture, PDO::PARAM_INT],
                            ['id_block', '=', $_POST['pk'], PDO::PARAM_INT]
                        ]) == $_POST['pk']) {

                    APP::Module('DB')->Update(
                            'auto', 'student_lecture_blocks', [
                        'name' => $_POST['value'],
                        'date' => $now
                            ], [
                        ['id_lecture', '=', $id_lecture, PDO::PARAM_INT],
                        ['id_block', '=', $_POST['pk'], PDO::PARAM_INT]
                            ]
                    );
                } else {
                    APP::Module('DB')->Insert(
                            'auto', ' student_lecture_blocks', [
                        'id' => 'NULL',
                        'id_lecture' => [$id_lecture, PDO::PARAM_INT],
                        'id_block' => [$_POST['pk'], PDO::PARAM_INT],
                        'name' => [$_POST['value'], PDO::PARAM_STR],
                        'private' => [0, PDO::PARAM_INT],
                        'body' => ["", PDO::PARAM_STR],
                        'date' => 'NOW()'
                    ]);
                }
                
                echo json_encode(['status' => 'success']);
                exit();

            case 'block-edit-body':

                $id_lecture = APP::Module('Crypt')->Decode($_POST['pk']);
                $now = (new \DateTime())->format('Y-m-d H:i:s');

                if (APP::Module('DB')->Select(
                                'auto', [ 'fetch', PDO::FETCH_COLUMN], ['id_block'], 'student_lecture_blocks', [
                            ['id_lecture', '=', $id_lecture, PDO::PARAM_INT],
                            ['id_block', '=', $_POST['id_block'], PDO::PARAM_INT]
                        ]) == $_POST['id_block']) {

                    APP::Module('DB')->Update(
                            'auto', 'student_lecture_blocks', [
                        'body' => $_POST['data'],
                        'date' => $now
                            ], [
                        ['id_lecture', '=', $id_lecture, PDO::PARAM_INT],
                        ['id_block', '=', $_POST['id_block'], PDO::PARAM_INT]
                            ]
                    );
                } else {

                    APP::Module('DB')->Insert(
                            'auto', ' student_lecture_blocks', [
                        'id' => 'NULL',
                        'id_lecture' => [$id_lecture, PDO::PARAM_INT],
                        'id_block' => [$_POST['id_block'], PDO::PARAM_INT],
                        'name' => [$_POST['block_name'], PDO::PARAM_STR],
                        'private' => [0, PDO::PARAM_INT],
                        'body' => [$_POST['data'], PDO::PARAM_STR],
                        'date' => 'NOW()'
                    ]);
                }
                echo json_encode(['status' => 'success']);
                exit();
        }
    }
    
    public function APIBlockList() {
        $this->SetHeader();
        
        if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
         $struct =  APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetch', PDO::FETCH_ASSOC],
                    ['struct','date'], 'student_struct_blocks',
                    [
                        ['id_lecture', '=', APP::Module('Crypt')->Decode($_POST['pk']), PDO::PARAM_INT]
                    ]);
         
        $blocks = APP::Module('DB')->Select(
                    'auto', 
                    [ 'fetchAll', PDO::FETCH_ASSOC],
                    ['id_block','name','private','body'], 'student_lecture_blocks',
                    [
                        ['id_lecture', '=', APP::Module('Crypt')->Decode($_POST['pk']), PDO::PARAM_INT]
                    ]);
        $sort = json_decode($struct['struct']);
        
        usort($blocks, function($a, $b) use ($sort) {
            $sort = array_flip($sort);

            return $sort[$a['id_block']] > $sort[$b['id_block']];
        });
        
        echo json_encode($blocks);        exit();
    }


    public function APIBlockAdd() {
        $this->SetHeader();
        
         if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        $id = APP::Module('Crypt')->Decode($_POST['pk']);
        echo json_encode($_POST);        exit();
    }
    
    public function APIUserSettingsEdit() {
        $this->SetHeader();
        
         if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
        $user_id = APP::Module('Crypt')->Decode($_POST['id_hash']);
        
        switch ($_POST['action']) {
            case 'image-crop':
                APP::Module('DB')->Update(
                        'auto', 'student_user_settings', [
                    'img_crop' => $_POST['data']
                        ], [
                    ['id', '=', $user_id, PDO::PARAM_INT]
                        ]
                );

                echo json_encode(['status' => 'success']);
                exit();

            case 'image-full':
                APP::Module('DB')->Update(
                        'auto', 'student_user_settings', [
                    'img_full' => $_POST['data']
                        ], [
                    ['id', '=', $user_id, PDO::PARAM_INT]
                        ]
                );

                echo json_encode(['status' => 'success']);
                exit();
                
            case 'main-info':
                
                foreach ($_POST as &$item) {
                    if($item  == 'NULL') {
                        $item = NULL;
                    }
                }
               
                $result = APP::Module('DB')->Update(
                        'auto', 'student_user_settings', [
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'privacy_view' => $_POST['priv_view'],
                    'privacy_edit' => $_POST['priv_edit'],
                    'about' => $_POST['about'],
                    'lang' => $_POST['lang']
                        ], 
                        
                        [
                    ['id', '=', $user_id, PDO::PARAM_INT]
                        ]
                );
                
                
               $result = APP::Module('DB')->Update(
                        'auto', 'student_user_templates', [

                    'country' => $_POST['country'],
                    'id_country' => $_POST['id_country'],                      
                    'city' => $_POST['city'],
                    'id_city' => $_POST['id_city'],
                    'university' => $_POST['university'],
                    'id_university' => $_POST['id_university'],
                    'faculty' => $_POST['faculty'],
                    'id_faculty' => $_POST['id_faculty'],
                    'chair' => $_POST['chair'],
                    'id_chair' => $_POST['id_chair'],                           
                    'name' => $_POST['lecture']
                        ], [
                    ['id', '=', $user_id, PDO::PARAM_INT],
                    ['type', '=', 'uni', PDO::PARAM_STR]
                        ]
                );
                
                echo json_encode(['status' => $result]);
                exit();
        }



        echo   json_encode(['status'=> 'error', 'message' => 'action not exist']); exit();
        
    }

    public function APILectureEdit() {
        
        $this->SetHeader();
        
        if(!isset($_POST)) {
         echo   json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
        $id = APP::Module('Crypt')->Decode($_POST['pk']);

        switch ($_POST['name']) {
            case 'lecture':
                
                if (!APP::Module('DB')->Update(
                    'auto', 'student_lectures', 
                    ['name' => $_POST['value']], 
                    [
                        ['id', '=', $id, PDO::PARAM_INT],
                    ]
                )) {
                   echo json_encode(['status'=> 'error', 'error'=> 'error update DB']); exit();
                }
                echo  json_encode(['status'=> 'success', 'message'=> 'lecture name has been updated']); exit();          
        }
        
      echo  json_encode(['status'=> 'success', 'message'=> 'lecture name has been updated']); exit();
        
    }

    // API VK
    public function APIGetVkData() {
        // 8919b4888383d4c95fe1d40c117085911a5925901da1c469f082d05b486f45fcc29cbbaf86b4ca8c7d425
        
        if(!isset($_POST)) {
            json_encode(['status'=> 'error', 'error'=> 'does not have post data']); exit();
        }
        
       // if(APP::Module('Registry')->Get('module_student'))
        
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        
        $baseUrl = 'https://api.vk.com/method/';
        
        if($_POST['set'] == 'country') {
            $url = $baseUrl.'database.getCountries?need_all=1&count=236&lang=RU';
            $respond = json_decode(file_get_contents($url),true);
            
            $out = [] ;
            
            foreach ($respond['response'] as $item) {
                
            if (($_POST['search']) && (preg_match('/^' . $_POST['search'] . '/i', $item['title']) === 0)) continue;
            
            array_push($out, [
                'id' => $item['cid'],
                'name' => $item['title'],  
            ]);
        }
            
           echo json_encode($out); exit();
        }
        
        if($_POST['set'] == 'city') {
            
            $url = $baseUrl.'database.getCities?need_all=1&count=1000&country_id='.$_POST['id_country'].'&q='.$_POST['search'];
            $respond = json_decode(file_get_contents($url),true);
            
            $out = [] ;
            
            foreach ($respond['response'] as $item) {
              
            if (($_POST['search']) && (preg_match('/^' . $_POST['search'] . '/i', $item['title']) === 0)) continue;    
            
            array_push($out, [
                'id' => $item['cid'],
                'name' => $item['title'],  
            ]);
        }
            
           echo json_encode($out); exit();
        }
        
        if($_POST['set'] == 'university') {
            
            // https://oauth.vk.com/blank.html#access_token=d0e0fac62d036ee96976aafbde310260a60d7da8c2c4bf2ad30c2e6ed73275815105f06a2d4f064b9c55a&expires_in=0&user_id=382123010&secret=d347e095991f6de90b
            
 
            $url = $baseUrl.'database.getUniversities?&country_id='.$_POST['id_country'].'&city_id='.$_POST['id_city'].'&q='.$_POST['search'];      
            $respond = json_decode(file_get_contents($url),true);
            
            $out = [] ;
            
            foreach ($respond['response'] as $item) {
                
          //  if (($_POST['search']) && (preg_match('/^' . $_POST['search'] . '/i', $item['title']) === 0)) continue;
                
            array_push($out, [
                'id' => $item['id'],
                'name' => $item['title'],  
            ]);
        }
            
           echo json_encode($out); exit();
        }
        
        if($_POST['set'] == 'faculty') {
            
            $url = $baseUrl.'database.getFaculties?university_id='.$_POST['id_university'].'&count=100';
            $respond = json_decode(file_get_contents($url),true);
            
            $out = [] ;
            
            foreach ($respond['response'] as $item) {
             
            if (($_POST['search']) && (preg_match('/^' . $_POST['search'] . '/i', $item['title']) === 0)) continue;    
            
            array_push($out, [
                'id' => $item['id'],
                'name' => $item['title'],  
            ]);
        }
            
           echo json_encode($out); exit();
        }
        
        if($_POST['set'] == 'chair') {
            
            $url = $baseUrl.'database.getChairs?faculty_id='.$_POST['id_faculty'].'&count=100';
            $respond = json_decode(file_get_contents($url),true);
            
            $out = [] ;
            
            foreach ($respond['response'] as $item) {
            
          //  if (($_POST['search']) && (preg_match('/^' . $_POST['search'] . '/i', $item['title']) === 0)) continue;    
                
            array_push($out, [
                'id' => $item['id'],
                'name' => $item['title'],  
            ]);
        }
            
           echo json_encode($out); exit();
        }
        
    }

}
