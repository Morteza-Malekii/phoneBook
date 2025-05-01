<?php


function site_url($route='')
{
    return rtrim($_ENV['HOST'], '/') . '/' . ltrim($route, '/');
}

function asset_url(string $asset = ''): string
{
    $host = $_ENV['HOST'] ?? ($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
    return rtrim($host, '/') . '/assets/' . ltrim($asset, '/');
}

function view($path,$data=[])
{
    extract($data);
    $view_full_path = str_replace('.','/',$path);
    include_once BASEPATH . "views/$view_full_path.php";
}

function strContain($str, $needle, $case_sensitive = 0)
{
    if ($case_sensitive)
        $pos = strpos($str, $needle);
    else
        $pos = stripos($str, $needle);
    return ($str !== false) ? true : false;
}

function nice_dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '<pre>';
}

function nice_dd($var)
{
    nice_dump($var);
    die();
}

function xss_clean($str)
{
    return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
