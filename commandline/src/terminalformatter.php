<?php

class terminalFormatter
{
    // Foreground colors
    const FG_BLACK = '30';
    const FG_RED = '31';
    const FG_GREEN = '32';
    const FG_YELLOW = '33';
    const FG_BLUE = '34';
    const FG_MAGENTA = '35';
    const FG_CYAN = '36';
    const FG_WHITE = '37';
    
    // Background colors
    const BG_BLACK = '40';
    const BG_RED = '41';
    const BG_GREEN = '42';
    const BG_YELLOW = '43';
    const BG_BLUE = '44';
    const BG_MAGENTA = '45';
    const BG_CYAN = '46';
    const BG_WHITE = '47';
    
    // Text formatting
    const RESET = '0';
    const BOLD = '1';
    const DIM = '2';
    const ITALIC = '3';
    const UNDERLINE = '4';
    const BLINK = '5';
    const REVERSE = '7';
    const HIDDEN = '8';

    private $text;
    private $formats = [];

    // =============================================================================================
    public function __construct($text = '')
    {
        $this->text = $text;
    }

    // =============================================================================================
    public function apply()
    {
        if (empty($this->formats)) return $this->text;

        $formatString = implode(";", $this->formats);
        return "\033[{$formatString}m{$this->text}\033[0m";
    }

    // =============================================================================================
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    // =============================================================================================
    public function add(...$codes)
    {
        foreach($codes as $code)
        {
            $this->formats[] = $code;
        }
        
        return $this;
    }

    // =============================================================================================
    public function __toString()
    {
        return $this->apply();
    }

    // =============================================================================================
}