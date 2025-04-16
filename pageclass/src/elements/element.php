<?php

namespace App\view\elements;

/**
 * Elements are taken to mean things like login forms, navigation menus etc
 */
abstract class Element
{
    private bool $directOutput;
    private string $wrapperClass = "defaultClass";

    // =============================================================================================
    public function __construct(bool $directOutput = false)
    {
        $this->directOutput = $directOutput;
    }
    /**
     * Add a <div class="..."> wrapper around the elements
     * @param bool $addWrapper Set wrapper true|false
     * 
     * @return string|bool Returns the HTML string with a div wrapper or false and echos directly
     */
    final public function show(bool $addWrapper) : string|bool
    {
        $content = $this->getContent();

        if ($addWrapper)
        {
            $content = '<div class="' . $this->wrapperClass . '">' . PHP_EOL
                      .$content
                      .'</div>' . PHP_EOL;
        }

        if ($this->directOutput) {
            echo $content;
            return false;
        }

        return $content;
    }

    // =============================================================================================
    /**
     * Set the wrapper class
     * @param string $className Div class name
     * 
     * @return Element
     */
    final public function setWrapperClass(string $className) : Element
    {
        $this->wrapperClass = $className;
        return $this;
    }

    // =============================================================================================
    /**
     * @return string HTML string of the element
     */
    abstract public function getContent() : string;

    // =============================================================================================
}