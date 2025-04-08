<?php

class formFactory
{
    const TYPE_LOGIN = "login";
    const TYPE_CONTACT = "contact";
    const TYPE_REGISTER = "register";
    const TYPE_CUSTOM = "custom";

    protected $formTypes = [];

    // =============================================================================================
    public function __construct()
    {
        $this->registerFormType(self::TYPE_LOGIN, "loginForm");
        $this->registerFormType(self::TYPE_CONTACT, "contactForm");
        $this->registerFormType(self::TYPE_REGISTER, "registerForm");
        $this->registerFormType(self::TYPE_CUSTOM, "Form");
        
    }

    // =============================================================================================
    public function create(string $type = self::TYPE_CUSTOM, array $attributes = []) : Form
    {
        if (!$this->canCreate($type))
        {
            throw new \InvalidArgumentException("Unsupported form type: $type");
        }

        return new $this->formTypes[$type]($attributes);
    }
    
    // =============================================================================================
    public function canCreate(string $type) : bool
    {
        return isset($this->formTypes[$type]);
    }

    // =============================================================================================
    public function registerFormType(string $type, string $className) : formFactory
    {
        $this->formTypes[$type] = $className;
        return $this;
    }
}