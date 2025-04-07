<?php

class inputCheckbox extends formElement
{
    // =============================================================================================
    public function render() : string
    {
        $html = '<input type="checkbox"' . $this->renderAttributes(["type"]) . '>';
        return $html . PHP_EOL;
    }
}