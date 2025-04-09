<?php

require_once 'src/formfactory.php';

$formFactory = new FormFactory();

// Generate a login form with additional attributes for the form tag.
$formFactory->createForm(
    page: 'login',
    action: 'index.php',
    method: 'POST',
    submit_caption: 'Login',
    attributes: ['class' => 'login-form']
);