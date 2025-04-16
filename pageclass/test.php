<?php

// Include the autoloader
require_once "src/autoloader.php";

// Correct namespace imports based on the actual class definitions
use App\views\pages\BasePage;
use App\views\elements\DefaultHeader;
use App\views\elements\WelcomeMessage;

class tester
{
    private $page;

    // =============================================================================================
    public function __construct()
    {
        $this->page = new BasePage();
    }

    // =============================================================================================
    public function show()
    {
        $this->page->beginDoc();
        $this->page->beginHeader();

        $this->page->addCss("assets/css/stylesheet.css");
        $this->page->addJs("assets/js/ajax.js");
        $headerContent = [new DefaultHeader(true)];
        $this->page->addHeaderElements($headerContent);

        $this->page->showHeader();
        $this->page->endHeader();
        $this->page->beginBody();

        $welcomemsg = new WelcomeMessage(true);
        $welcomemsg->setWrapperClass("main-msg");
        $bodyContent = [$welcomemsg];
        $this->page->addBodyElements($bodyContent);

        $this->page->showBody();
        $this->page->showFooter();
        $this->page->endBody();
        $this->page->endDoc();
    }
}

$test = new tester();

$test->show();
