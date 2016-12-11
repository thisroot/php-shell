<?
$card = 'Logs';
$hash = md5($card);

return [[
    [$card],
    [
        APP::Render('logs/admin/dashboard/html', 'content', compact('hash')),
        APP::Render('logs/admin/dashboard/css', 'content', compact('hash')),
        APP::Render('logs/admin/dashboard/js', 'content', compact('hash'))
    ]
]];