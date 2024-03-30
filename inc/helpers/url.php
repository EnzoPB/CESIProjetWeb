<?php

function rediriger($url) {
    header('location: ' . $url);
    exit();
}