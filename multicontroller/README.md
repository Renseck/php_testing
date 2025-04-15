# Multicontroller
Implements a controller (or technically a router) that takes incoming requests and delegates them to either an `ajaxController` or a `pageController` as needed. These then handle the requests in their own way. The `baseController` prescribes a final `handleRequest()` method, while leaving it open to any child classes how they wish to process the requests (generate an output) and throw an error if needed. As such, the `multiController` is the only entrance point to handling any request and the only code that needs to be used in `index.php`:

## Example usage
```php
use App\controllers\multiController;

$multiController = new multiController();
$multiController->handleRequest();
```

## License

[MIT](https://choosealicense.com/licenses/mit/) license, Copyright © 2025 Rens van Eck.