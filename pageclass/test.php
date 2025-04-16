<?php

// Include the autoloader
require_once "src/autoloader.php";

// Make sure these use statements match the actual namespaces in the files
use App\view\pages\basePage;
use App\view\elements\DefaultHeader;

class tester
{
    private $page;

    // =============================================================================================
    public function __construct()
    {
        $this->page = new basePage();
    }

    // =============================================================================================
    public function show()
    {
        $this->page->beginDoc();
        $this->page->beginHeader();

        $this->page->addCss("assets/css/stylesheet.css");
        $this->page->addJs("assets/js/ajax.js");
        $headerContent = (new DefaultHeader(true));
        $this->page->addHeaderElements($headerContent);

        $this->page->showHeader();
        $this->page->endHeader();
        $this->page->beginBody();
        $this->page->showBody();
        $this->page->showFooter();
        $this->page->endBody();
        $this->page->endDoc();
    }
}

$test = new tester();

$test->show();
