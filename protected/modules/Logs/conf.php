<?
return Array(
    'routes' => [
        ['admin\/logs', 'Logs', 'Manage'],
        ['admin\/logs\/view\/(?P<file>.*)', 'Logs', 'View'],
        ['admin\/logs\/remove\/(?P<file>.*)', 'Logs', 'Remove']
    ]
);