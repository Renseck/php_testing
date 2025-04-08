<?php

class contactForm extends Form
{
    public function __construct(array $attributes = [])
    {
        $defaultAttributes = [
            "id" => "contact-form",
            "class" => "form-contact",
            "method" => "post",
            "action" => "index.php"
        ];

        parent::__construct(array_merge($defaultAttributes, $attributes));
        $this->buildForm();
    }

    // =============================================================================================
    protected function buildForm() 
    {
         // Add name field
         $this->addElement([
            'type' => 'text',
            'name' => 'name',
            'id' => 'contact-name',
            'class' => 'form-control',
            'placeholder' => 'Enter your name',
            'required' => 'required',
            'label' => 'Name'
        ]);

        // Add email field
        $this->addElement([
            'type' => 'email',
            'name' => 'email',
            'id' => 'contact-email',
            'class' => 'form-control',
            'placeholder' => 'Enter your email',
            'required' => 'required',
            'label' => 'Email'
        ]);

        // Add message textarea
        $this->addElement([
            'type' => 'textarea',
            'name' => 'message',
            'id' => 'contact-message',
            'class' => 'form-control',
            'placeholder' => 'Enter your message',
            'required' => 'required',
            'rows' => '5',
            'label' => 'Message'
        ]);
        
        // Add submit button
        $this->addElement([
            'type' => 'submit',
            'value' => 'Send message',
            'class' => 'btn btn-primary'
        ]);
    }
}