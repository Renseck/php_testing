# Banner maker
Implements a fun little script that creates banners based on a template. Run from the command line. If you already have a simple header in the file, this will turn it into a fun stylized banner. You can make your own banner template by editing the `banner.txt` file, and seperating the top and bottom portions with a line like `!---..----!`.

## Example usage
You can use this on single files, as below
```php
php addbanner.php path/to/file.php
```

Or you can use it on  directory:
```php
php addbanner.php path/to/directory/
```
The script will then recursively traverse the directory and add stylized banners to all `.php` files it finds.


The file might be outfitted with a simple header looking like
```php
// Author: <author name>
// Date: <Date of creation>
// Project: <Larger project name>
// Goal: <goal of the script>
```

## License

[MIT](https://choosealicense.com/licenses/mit/) license, Copyright © 2025 Rens van Eck.