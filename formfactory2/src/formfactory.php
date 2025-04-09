<?php

require_once "form.php";

class formFactory
{
    // =============================================================================================
    public function createForm(string $page, string $action, string $method, string $submit_caption, array $attributes = [])
    {
        $form = new Form();

        switch ($page)
        {
            case 'login':
                $fields = [
                    "email" => "email",
                    "password" => "password"
                ];
                break;
            
            case 'registration':
                $fields = [
                    "name" => "text",
                    "email" => "email",
                    "password" => "password",
                    "password_repeat" => "password"
                ];
                break;

            case 'contact':
                $fields = [
                    "name" => "text",
                    "email" => "email",
                    "message" => "textarea"
                ];
                break;

            default:
                $fields = [];
                break;
        }
        
        $form->showForm($page, $action, $method, $fields, $submit_caption, $attributes);
    }
}

$formFactory = new FormFactory();

// Generate a login form with additional attributes for the form tag.
$formFactory->createForm(
    page: 'login',
    action: 'index.php',
    method: 'POST',
    submit_caption: 'Login',
    attributes: ['class' => 'login-form']
);