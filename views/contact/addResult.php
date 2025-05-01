<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span>
        <?php if (isset($message) && !empty($message)) : ?>
        <?php print_r($message); ?>
        <?php endif; ?>
    </span>
    <span><a href="<?=site_url()?>"><h1>back</h1></a></span>
</body>
</html>