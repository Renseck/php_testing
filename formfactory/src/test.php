<?php

// Simple autoloader
spl_autoload_register(function($class) {
    // Try in elements directory
    $file = __DIR__ . '/fields/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // Also try in the factory directory
    $file = __DIR__ . '/factory/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});

require_once "factory/formFactory.php";

$formFactory = new formFactory();

$form = $formFactory->create(formFactory::TYPE_LOGIN);
echo $form->render();