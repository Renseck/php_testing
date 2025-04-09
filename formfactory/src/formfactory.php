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
                    "email" => ["type" => "email", "label" => "Email:"],
                    "password" => ["type" => "password", "label" => "Password:"]
                ];
                break;
            
            case 'registration':
                $fields = [
                    "name" => ["type" => "text", "label" => "Name:"],
                    "email" => ["type" => "email", "label" => "Email:"],
                    "password" => ["type" => "password", "label" => "Password:"],
                    "password_repeat" => ["type" => "password", "label" => "Repeat password:"]
                ];
                break;

            case 'contact':
                $fields = [
                    "name" => ["type" => "text", "label" => "Name:"],
                    "email" => ["type" => "email", "label" => "Email:"],
                    "message" => ["type" => "textarea", "label" => "Message:"]
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