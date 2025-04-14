<?php

abstract class baseController
{
    /**
     * Here, *you* handle this request
     */
    abstract public function handleRequest();

    /**
     * Alright, let's see what you want from me
     */
    abstract protected function getData();

    /**
     * Let's process the request in case it makes sense
     */
    abstract protected function processRequest();

    /**
     * Here's the result
     */
    abstract protected function sendResponse();

    protected function _getVar($name, $default = "NOTFOUND")
    {
        return $_GET[$name] ?? $default;
    }
}