<?php
include_once('config.php');

if ($config['debug']) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

include_once('database.php');
