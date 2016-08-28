<?
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 10');

// Error codes
switch ($data[0]) {
    case 'db_connect':  $title = ['Could not connect to database']; break;
    default:            $title = ['Unknown error']; break;
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Error</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <style>
        #circle {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: red;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }
    </style>
</head>	
<body>
    <?
    if (APP::$conf['debug']) {
        ?>
        <h1><div id="circle"></div> <?= $title[0] ?></h1>
        <hr>
        <pre><? print_r($data); ?></pre>
        <?
    } else {
        ?>
        <h1>Service Temporarily Unavailable</h1>
        <hr>
        Please try again later
        <?
    }
    ?>
</body>
</html>
<?
exit;