<?php

require_once "src/logger.php";

$logger = new Logger([
    "logLevel" => 1,
    "logToTerminal" => true,
    "useTerminalFormatter" => true
]);

$logger->log(1, "Test log message: {reason}", ["reason" => "LogReason"]);