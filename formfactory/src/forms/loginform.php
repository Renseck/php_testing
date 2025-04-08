<?php

class loginForm extends Form
{   
    public function __construct(array $attributes = [])
    {
        $defaultAttributes = [
            "id" => "login-form",
            "class" => "form-login",
            "method" => "post",
            "action" => "index.php"
        ];

        parent::__construct(array_merge($defaultAttributes, $attributes));
        $this->buildForm();
    }

    // =============================================================================================
    protected function buildForm() : void
    {
        // Add email field
        $this->addElement([
            'type' => 'email',
            'name' => 'email',
            'id' => 'login-email',
            'class' => 'form-control',
            'placeholder' => 'Enter your email',
            'required' => 'required',
            'label' => 'Email'
        ]);
        
        // Add password field
        $this->addElement([
            'type' => 'password',
            'name' => 'password',
            'id' => 'login-password',
            'class' => 'form-control',
            'placeholder' => 'Enter your password',
            'required' => 'required',
            'label' => 'Password'
        ]);
        
        // Add submit button
        $this->addElement([
            'type' => 'submit',
            'value' => 'Login',
            'class' => 'btn btn-primary'
        ]);
    }
}