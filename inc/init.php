<?php
global $config, $bdd, $session;

include_once('config.php');

if ($config['debug']) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

include_once('BaseDeDonnees.php');
$bdd = new BaseDeDonnees($config['db']['host'], $config['db']['database'], $config['db']['username'], $config['db']['password']);

include_once('session.php');
$session = new Session();