<?
class Examine {

    public function Init() {
       foreach ($this->conf['routes'] as $route) {
            APP::Module('Routing')->Add($route[0], $route[1], $route[2], isset($route[3]) ? $route[3] : null);
        }
    }
    
    public function Index() {
          APP::Render('examine/index');
    }
    
    public function itemsAdd() {
      APP::Render('examine/add');
    }
    
    public function APIItems($settings) {

        
        if(isset($_POST['count_items'])) {
            $settings['count_items'] = $_POST['count_items'];
        }
        
        if(isset($_POST['themeblock'])) {
            $settings['theme'] = $_POST['themeblock'];
        }
        
        
        $out = APP::Module('DB')->Select(
                'auto', ['fetchAll', PDO::FETCH_ASSOC], 
                ['id','text','theme','descriptions'],
                'examine',
               [
                   ['theme', 'IN', $settings['theme']]
                ]
                , false, false, false,
                ['RAND()']
                ,[$settings['count_items']]
            );
               
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }
    
    public function APIItemsAdd($settings) {
        $out = [];
        
        if(!isset($_POST['text']) && !isset($_POST['descriptions'])) {
            $out = 'empty data';
        } else {
            
            $request = APP::Module('DB')->Insert(
                    'auto', 'examine', [
                'id' => 'NULL',
                'text' => [$_POST['text'], PDO::PARAM_STR],
                'theme' => [$_POST['theme'], PDO::PARAM_STR],
                'descriptions' => [$_POST['descriptions'], PDO::PARAM_STR]
                    ]
            );
            
            $out = $request?'success':'error insert to DB';
        }
        
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }
    
    public function APIItemsEdit($data) {
         $out = [];
        
        if(!isset($_POST['descriptions'])) {
            $out = 'empty data';
        } else {
            
            $request = APP::Module('DB')->Update(
                'auto', 'examine', [
                'descriptions' => $_POST['descriptions'],
                    ], [
                ['id', '=', $_POST['id'], PDO::PARAM_INT]
                    ]);
            $out = $request?'success':'error insert to DB';
        }
        
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        header('Access-Control-Allow-Origin: ' . APP::$conf['location'][1]);
        header('Content-Type: application/json');
        
        echo json_encode($out);
        exit;
    }
    
}