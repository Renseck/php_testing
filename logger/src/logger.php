<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date: 02/04/2025                                                                     │  *
 *  │  Project: Logger                                                                      │  *
 *  │  Goal: Implement a simple Logger that logs to terminal and/or file based on loglevel  │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/

require_once __DIR__ . '/../../commandline/src/terminalformatter.php';
class Logger
{
    const INFO = 1;
    const WARNING = 2;
    const ERROR = 3;
    const CRITICAL = 4;
    const DEBUG = 5;

    private $levelNames = [
        self::INFO => "INFO",
        self::WARNING => "WARNING",
        self::ERROR => "ERROR",
        self::CRITICAL => "CRITICAL",
        self::DEBUG => "DEBUG"
    ];

    private $levelColors = [
        self::INFO => [terminalFormatter::FG_GREEN],
        self::WARNING => [terminalFormatter::FG_YELLOW],
        self::ERROR => [terminalFormatter::FG_RED],
        self::CRITICAL => [terminalFormatter::FG_WHITE, terminalFormatter::BG_RED],
        self::DEBUG => [terminalFormatter::FG_BLUE]
    ];

    // Logger configs
    private $minLevel = self::INFO;
    private int $logLevel;
    private bool $logToTerminal = true;
    private bool $logToFile = false;
    private string $logFilePath = "";
    private bool $useTerminalFormatter = true;
    private Object $terminalFormatter;

    // =============================================================================================
    public function __construct($options = [])
    {
        $this->logLevel = $options["logLevel"] ?? $this->minLevel;
        $this->logToTerminal = $options["logToTerminal"] ?? true;
        $this->logFilePath = $options["logFilePath"] ?? "";
        $this->logToFile = $options["logToFile"] ?? isset($logFilePath);
        $this->useTerminalFormatter = $options["useTerminalFormatter"] ?? true;
        
    }

    // =============================================================================================
    /**
     * @param int $level Log level
     * @param string $message Log message with placeholders
     * @param array $context Message data
     * @return void
     */
    public function log(int $level, string $message, array $context = []) : void
    {
        if ($level < $this->logLevel) return;

        $timestamp = date("Y-m-d H:i:s");
        $levelName = $this->levelNames[$level];

        $message = $this->format($timestamp, $message, $context, $levelName);

        if ($this->logToTerminal) 
        {
            if ($this->useTerminalFormatter) {
                $terminalMessage = $this->formatForTerminal($message, $level);
                $this->logToTerminal($terminalMessage);
            }
            else {
                $this->logToTerminal($message);
            }
            
        }
        if ($this->logToFile) $this->logToFile($message);
    }

    // =============================================================================================
    private function interpolate(string $message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val)
        {
            if (is_string($val) || method_exists($val, '__toString') || is_numeric($val))
            {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }

    // =============================================================================================
    private function format(string $timestamp, string $message, array $context = [], string $levelName)
    {
        return "[$timestamp] $levelName >> " . $this->interpolate($message, $context);

    }

    // =============================================================================================
    private function formatForTerminal(string $message, int $level)
    {
        if (isset($this->levelColors[$level]))
        {
            $parts = explode("] ", $message, 2);
            $timestampPart = $parts[0] . "] ";
            $messagePart = $parts[1];

            $this->terminalFormatter = new terminalFormatter($messagePart);
            foreach ($this->levelColors[$level] as $format)
            {
                $this->terminalFormatter->add($format);
            }
            
            return $timestampPart . $this->terminalFormatter->apply() . PHP_EOL;
        }

        return $message;
        
    }

    // =============================================================================================
    private function logToTerminal(string $message)
    {
        echo $message . PHP_EOL;
    }

    // =============================================================================================
    private function logToFile(string $message)
    {
        file_put_contents($this->logFilePath, $message, FILE_APPEND);
    }
}