<?php

// Simple autoloader
spl_autoload_register(function($class) {
    // Try in elements directory
    $file = __DIR__ . '/elements/' . $class . '.php';
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

$factory = new formFactory();

$textareaInput = $factory->create([
    'type' => 'textarea',
    'name' => 'message',
    'id' => 'message',
    'class' => 'contactform'
]);

$countrySelect = $factory->create([
    'type' => 'select',
    'name' => 'country',
    'id' => 'country',
    'options' => [
        'us' => 'United States',
        'ca' => 'Canada',
        'uk' => 'United Kingdom'
    ],
    'value' => 'us'
]);

echo $textareaInput->render();
echo $countrySelect->render();