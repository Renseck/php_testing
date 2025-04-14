<?php

require_once "basecontroller.php";

class pageController extends baseController
{
    protected string $response;
    protected string $page;

    // =============================================================================================
    public function handleRequest()
    {
        $this->getData();
        $this->processRequest();
        $this->sendResponse();
    }

    // =============================================================================================

    protected function getData()
    {
        // This is just a silly placeholder for now but in reality this would probably check which page is requested
        $this->page = $this->_getVar("page");
    }

    // =============================================================================================
    protected function processRequest()
    {
        $this->response = <<<EOD
        <!DOCTYPE html>
        <html>
        <head>
        <title>Test page</title>
        <meta name="author" content="Rens"/>
        <style>
        div.fullscreen { border : 1px solid black;  margin : 10px; padding : 10px; font-size:12px; }
        div#top {background-color : #b0b0b0;  min-height : 50px;}
        div#mid {background-color : #e0e0e0;  min-height : 100px;}
        div#bot {background-color : #a0a0a0;  min-height : 50px;}
        </style>
        </head>
        <body> 
        <div class="fullscreen" id="top">Placeholder TOP</div>
        <div class="fullscreen" id="mid">Placeholder MID<button id="populate">Populate divs</button></div>
        <div class="fullscreen" id="bot">Placeholder BOT</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="_src/js/ajax.js"></script> 
        </body>
        </html>
        EOD;
    }
    
    // =============================================================================================
    protected function sendResponse()
    {
        echo $this->response;
    }
    
    // =============================================================================================
}