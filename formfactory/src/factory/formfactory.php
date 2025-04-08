<?php

class formFactory
{
    // =============================================================================================
    public function createForm(array $attributes = [])
    {
        $form = new Form();

        foreach ($attributes as $name => $value)
        {
            $form->setAttribute($name, $value);
        }

        return $form;
    }
}