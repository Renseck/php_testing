<?php
namespace App\controllers;

use App\interfaces\iController;

abstract class baseController implements iController
{
    /**
     * Here, *you* handle this request
     */
    final public function handleRequest() : bool
    {
        $result = false;

        try
        {
            ob_start();
            if ($this->processRequest())
            {
                // Success, send the response
                echo ob_get_clean();
                $result = true;
            }
        }
        catch (\Throwable $ex)
        {
            ob_end_clean();
            $this->reportError($ex);
        }

        return $result;
    }

    /**
     * Let's process the request and generate a response
     */
    abstract protected function processRequest() : bool;

    /**
     * Oops, an error has occurred
     */
    abstract protected function reportError(\Throwable $ex) : void;

    protected function _getVar($name, $default = "NOTFOUND") : string
    {
        return $_GET[$name] ?? $default;
    }
}