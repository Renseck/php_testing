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

$formFactory = new formFactory();

$form = $formFactory->createForm([
    'id' => 'contact-form',
    'class' => 'form-horizontal'
]);


$form->addElement([
    'type' => 'email',
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'placeholder' => 'Enter email',
    'label' => 'Email Address' // Custom label text
]);

// Add a text input without an explicit label (will generate "First Name")
$form->addElement([
    'type' => 'text',
    'name' => 'firstName',
    'id' => 'first-name',
    'class' => 'form-control'
]);

// Render the complete form
echo $form->render();