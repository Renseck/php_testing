<?php

require_once "basecontroller.php";

class ajaxController extends baseController
{
    protected array $response;
    protected string $function;

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
        $this->function = $this->_getVar("function");
    }

    // =============================================================================================
    protected function processRequest()
    {
        switch ($this->function)
        {
            case "populate":
                $code = file_get_contents("https://baconipsum.com/api/?type=all-meat&paras=1&start-with-lorem=1");

                $data = array();
                $data[] = array("target" => "div#top", "content" => "<h1>Multi Element Test</h1>");
                $data[] = array("target" => "div#mid", "content" => "<code>" . $code . "</code>");
                $data[] = array("target" => "div#bot", "content" => "<footer class='footer'>&copy;&nbsp;".date("Y")."&nbsp;Rens van Eck</footer>");

                $this->response = $data;
                break;

            default:
                echo "<h1>NNNNOPE. No action defined for [$this->function]</h1>";
                break;
        }
        
    }
    
    // =============================================================================================
    protected function sendResponse()
    {
        header("Content-Type: application/json");
        echo json_encode($this->response);
    }
    
    // =============================================================================================
}