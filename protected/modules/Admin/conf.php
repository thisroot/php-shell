<?
return [
    'routes' => [
        ['admin(\?.*)?',                                                'Admin', 'Manage'],
        ['admin\/system(\?.*)?',                                        'Admin', 'System'],
        ['admin\/app(\?.*)?',                                           'Admin', 'App'],
        ['admin\/app\/modules\/export\/(?P<module_hash>.*)',            'Admin', 'ExportModule'],
        ['admin\/app\/modules\/import',                                 'Admin', 'ImportModules'],
        ['admin\/app\/modules\/import\/network',                        'Admin', 'NetworkImportModules'],
        ['admin\/app\/modules\/import\/remove\/(?P<module_path>.*)',    'Admin', 'RemoveImportedModule'],
        ['admin\/app\/modules\/import\/install',                        'Admin', 'InstallImportedModules'],
        ['admin\/app\/modules\/uninstall\/(?P<module_hash>.*)',         'Admin', 'UninstallModule'],
        
        ['admin\/app\/api\/modules\/uninstall\/(?P<module_hash>.*)',    'Admin', 'APIUninstallModule'],
    ]
];