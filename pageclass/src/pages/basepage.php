<?php

namespace App\views\pages;

class BasePage
{
    protected string $title = "<notitle>";
    protected array $cssFiles = [];
    protected array $jsFiles = [];
    protected array $headerElements = [];
    protected array $bodyElements = [];
    
    // ==============================================================================================
	public function beginDoc()
	{
		echo '<!DOCTYPE html>' . PHP_EOL
			. '<html>' . PHP_EOL;
	}

	// ==============================================================================================
	public function beginHeader()
	{
		echo '<head>' . PHP_EOL;
	}

	// ==============================================================================================
	public function showHeader(bool $addWrapper = false)
	{
		// Loop through array of header elements supplied by Elements class
        $this->showElements($this->headerElements, $addWrapper);

        // Then add in things like CSS and JS links
        foreach ($this->cssFiles as $cssFile)
		{
			echo '<link rel="stylesheet" type="text/css" href="' . $cssFile . '">'
				. PHP_EOL;
		}

		foreach ($this->jsFiles as $jsFile)
		{
			echo '<script src="' . $jsFile . '"></script>'
				. PHP_EOL;
		}
	}

    // =============================================================================================
    public function endHeader()
    {
        echo '</head>' . PHP_EOL;
    }

    // =============================================================================================
    public function beginBody()
    {
        echo '<body>' . PHP_EOL;
    }

    // =============================================================================================
    public function showBody(bool $addWrapper = true)
    {
        echo '<div id="main-content">' . PHP_EOL;

        // Loop through array of body elements supplied by Elements class
        $this->showElements($this->bodyElements, $addWrapper);

        echo '</div>' . PHP_EOL;
    }

    // =============================================================================================
    public function showFooter()
    {
        echo '<br>' . PHP_EOL
            .'<footer class="footer">&copy;&nbsp;' . date("Y") . '&nbsp;Rens van Eck</footer>' . PHP_EOL;
    }

    // =============================================================================================
    public function endBody()
    {
        echo '</body>' . PHP_EOL;
    }

    // =============================================================================================
    public function endDoc()
    {
        echo '</html>' . PHP_EOL;
    }

    // =============================================================================================
    /**
     * Echo the contents of an array of HTML elements
     * @param array $elements Array of HTML elements
     * @param bool $addWrapper Add div wrapper or not
     * 
     * @return void
     */
    protected function showElements(array $elements, bool $addWrapper) : void
    {
        foreach ($elements as $element)
        {
            $element->show($addWrapper);
        }
    }

    // =============================================================================================
    /**
     * Add header elements to a page
     * @param array $elements Array of Element objects
     * 
     * @return void
     */
    public function addHeaderElements(array $elements) : void
    {
        foreach ($elements as $element)
        {
            $this->headerElements[] = $element;
        }
        
    }

    // =============================================================================================
    /**
     * Add body elements to a page
     * @param array $elements Array of Element objects
     * 
     * @return void
     */
    public function addBodyElements(array $elements) : void
    {
        foreach ($elements as $element)
        {
            $this->bodyElements[] = $element;
        }
        
    }

    // =============================================================================================
    public function addCss(string $cssFile) : void
    {
        $this->cssFiles[] = $cssFile;
    }

    // =============================================================================================
    public function addJs(string $jsFile) : void
    {
        $this->jsFiles[] = $jsFile;
    }
}