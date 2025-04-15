# Logger
Implements a simple logger that is capable of writing messages directly to terminal (via `echo`), to an output `.log` file, or both simultaneously. Create the `Logger` instance and set its log level (1-5). Any messages can also be perscribed a log level, such that only those messages with a level at most that of the `Logger` instance. This allows for easy filtering by only changing the `Logger`'s own level.

## Example usage
Taken from `test.php`:
```php
$logger = new Logger([
    "logLevel" => 1,
    "logToTerminal" => true,
    "useTerminalFormatter" => true
]);

$logger->log(1, "Test log message: {reason}", ["reason" => "LogReason"]);
```

## Note
This logger also stylizes messages based on their log level when printing to terminal. To that end, it binds the code from my [terminal formatter](../commandline/). Take care that the `require_once` statement (or similar) is correct. 


## License

[MIT](https://choosealicense.com/licenses/mit/) license, Copyright © 2025 Rens van Eck.