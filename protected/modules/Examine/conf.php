<?
return [
    'routes' => [
       // ['(\?.*)?','Examine', 'Index'], // Base index method 
        ['examine','Examine', 'Index'], // Base index method 
        [
            'api\/examine\/items\.json',
            'Examine', 
            'APIItems', 
            [
                'count_items' => 5, 
                'theme' => ["Архитектура компьютера"]
            ]
        ],
        ['examine\/add', 'Examine','ItemsAdd'],
        ['api\/examine\/add\.json','Examine', 'APIItemsAdd'],
        ['api\/examine\/edit\.json','Examine', 'APIItemsEdit']
    ],
    'init'  => true,
    'connection' => 'auto'
];