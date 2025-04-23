<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date: 15/04/2025                                                                     │  *
 *  │  Project: Web framework                                                               │  *
 *  │  Goal: Showcase Page + Element (Factory) usage                                        │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/

// Include the autoloader
require_once "src/autoloader.php";

// Correct namespace imports based on the actual class definitions
use App\views\pages\BasePage;
use App\views\elements\ElementFactory;

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
        $elementFactory = new ElementFactory();

        $this->page->beginDoc();
        $this->page->beginHeader();

        $this->page->addCss("assets/css/stylesheet.css");
        $this->page->addJs("assets/js/ajax.js");
        $headerContent = [$elementFactory->createElement("header", true), "lalala not an ELement"];
        $this->page->addHeaderElements($headerContent);

        $this->page->showHeader();
        $this->page->endHeader();
        $this->page->beginBody();

        // Using the createElementS method to create arrays directly.
        $bodyContent = $elementFactory->createElements([
            ["type" => "navmenu", "directOutput" => true, "wrapperClass" => "nav-menu"],
            ["type" => "404", "directOutput" => true]
        ]);

        $this->page->addBodyElements($bodyContent);

        $this->page->showBody();
        $this->page->showFooter();
        $this->page->endBody();
        $this->page->endDoc();
    }
}

$test = new tester();

$test->show();
