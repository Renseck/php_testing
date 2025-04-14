<?php

require_once "basecontroller.php";
require_once "pagecontroller.php";
require_once "ajaxcontroller.php";

// This really functions only as a router, not a true controller as evidenced by the empty methods
class multiController extends baseController
{
    protected $_isAjax;
    // =============================================================================================

    public function __construct()
    {
        $this->_isAjax = $this->_getVar("action") === "ajax";
    }
    // =============================================================================================

    public function handleRequest()
    {
        if ($this->_isAjax)
        {
            $controller = new ajaxController();
        }
        else
        {
            $controller = new pageController();
        }
        $controller->handleRequest();
    }

    // =============================================================================================
    protected function getData() { /* Not used in this implementation */ }
    protected function processRequest() { /* Not used in this implementation */ }
    protected function sendResponse() { /* Not used in this implementation */ }
}