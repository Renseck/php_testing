<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date:                                                                                │  *
 *  │  Project:                                                                             │  *
 *  │  Goal:                                                                                │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/

// Include the autoloader
require_once "src/autoloader.php";

// Use namespaced class
use App\controllers\multiController;

$multiController = new multiController();
$multiController->handleRequest();