# formFactory
Implements a simple form factory, working in unison with the `Form` class. `Form` handles the creation of HTML forms based on arguments such as `$fields`. The `formFactory` class functions as a simple point of contact, and contains a few pre-made form configurations that I use commonly. This project is likely to keep developing.

## Example usage
Taken from `test.php`:
```php
$formFactory = new FormFactory();

// Generate a login form with additional attributes for the form tag.
$formFactory->createForm(
    page: 'login',
    action: 'index.php',
    method: 'POST',
    submit_caption: 'Login',
    attributes: ['class' => 'login-form']
);
```

## License

[MIT](https://choosealicense.com/licenses/mit/) license, Copyright © 2025 Rens van Eck.