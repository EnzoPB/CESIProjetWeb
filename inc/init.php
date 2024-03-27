<?php
include_once('config.php');

if ($config['debug']) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

include_once('database.php');

$db = new Database($config['db']['host'], $config['db']['database'], $config['db']['username'], $config['db']['password']);
