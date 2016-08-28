<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Activate</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
</head>
<body>
    <h1>Activate</h1>
    <?
    switch ($data) {
        case 'success': ?>Activation successful<? break;
        case 'error': ?>Activation failed<? break;
    }
    ?>
</body>
</html>