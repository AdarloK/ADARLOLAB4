<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$ssl_ca = getenv('DB_SSL_CA') ?: '';
if ($ssl_ca !== '' && !preg_match('/^(?:[A-Za-z]:[\\\\\/]|[\\\\\/])/', $ssl_ca)) {
    $ssl_ca = ROOT_DIR . ltrim($ssl_ca, '\\/');
}

$database['main'] = array(
    'driver'    => 'mysql',
    'hostname'  => getenv('DB_HOST') ?: 'localhost',
    'port'      => getenv('DB_PORT') ?: '3306',
    'username'  => getenv('DB_USERNAME') ?: 'root',
    'password'  => getenv('DB_PASSWORD') ?: '',
    'database'  => getenv('DB_DATABASE') ?: (getenv('DB_NAME') ?: 'mydb'),
    'charset'   => 'utf8mb4',
    'dbprefix'  => '',
    'path'      => '',
    'ssl_ca'    => $ssl_ca,
    'ssl_verify' => getenv('DB_SSL_VERIFY') === '1'
);
