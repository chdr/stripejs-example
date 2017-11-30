<?php

/*
Router for the example application

See http://php.net/manual/en/features.commandline.webserver.php
*/

if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css|html|php)$/', $_SERVER["REQUEST_URI"])) {
    // serve the requested resource as-is
    return false;
} else {
    define('BASE', __DIR__ . '/../');

    require BASE . 'vendor/autoload.php';

    $config = require(BASE . 'config/config.php');

    $currentPage = basename($_SERVER['PHP_SELF']);

    $currentPage = $currentPage !== '' ? $currentPage : 'index.php';

    require BASE . 'public/' . $currentPage;
}
