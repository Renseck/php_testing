<?php

// Include the autoloader
require_once "src/autoloader.php";

// Use namespaced class
use App\controllers\multiController;

$multiController = new multiController();
$multiController->handleRequest();