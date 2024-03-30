<?php
include_once('inc/init.php');

$controller = 'index.php';
if (isset($_GET['_controller'])) {
    $controller = $_GET['_controller'] . '.php';
}

if (!file_exists('controllers/' . $controller)) {
    $controller = 'errors/404.php';
}

include('controllers/' . $controller);