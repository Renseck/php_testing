# Terminal formatter
Implements a simple terminal formatter. Works by adding the escape codes of the various styling options to the strings fed into the formatter, and the returning the formatted string by using `apply()`. Also has a magic method implemented to allow for direct `echo`ing of any formatted text held within the formatter.

## Example usage
```php
$formatter = new terminalFormatter();
echo $formatter->setText("Hello world!")->add(terminalFormatter::FG_CYAN,
                                              terminalFormatter::UNDERLINE,
                                              terminalFormatter::BG_WHITE);
```

## License

[MIT](https://choosealicense.com/licenses/mit/) license, Copyright © 2025 Rens van Eck.