<?php
$pdo = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['database'],
    $config['db']['username'], $config['db']['password']);

if ($config['debug']) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
