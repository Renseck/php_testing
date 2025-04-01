<?php

class logger
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
        self::INFO => "INFO",
        self::WARNING => "WARNING",
        self::ERROR => "ERROR",
        self::CRITICAL => "CRITICAL",
        self::DEBUG => "DEBUG"
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

        if ($this->useTerminalFormatter)
        {
            require_once __DIR__ . '/../../commandline/src/terminalformatter.php';
            $this->terminalFormatter = new terminalFormatter();
        }
        
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
        $levelName = "Minor";
        
        $message = $this->format($timestamp, $message, $context, $levelName);

        if ($this->logToTerminal) $this->logToTerminal($message);
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
    private function logToTerminal(string $message)
    {
        echo $message;
    }

    // =============================================================================================
    private function logToFile(string $message)
    {
        file_put_contents($this->logFilePath, $message, FILE_APPEND);
    }
}

$loggr = new logger([
            "logLevel" => 1,
            "logToTerminal" => true
        ]);

$loggr->log(1, "Test log message: {reason}", ["reason" => "LogReason"]);