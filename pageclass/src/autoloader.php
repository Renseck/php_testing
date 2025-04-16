<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            // Project-specific namespace prefix
            $prefix = 'App\\';
            
            // Base directory for the namespace prefix
            $base_dir = dirname(__FILE__) . '/';
            
            // Check if the class uses the namespace prefix
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                // No, move to the next registered autoloader
                return;
            }
            
            // Get the relative class name
            $relative_class = substr($class, $len);
            
            // Custom mapping for view namespace
            if (strpos($relative_class, 'view\\pages\\') === 0) {
                $relative_class = str_replace('view\\pages\\', 'page\\', $relative_class);
            } elseif (strpos($relative_class, 'view\\elements\\') === 0) {
                $relative_class = str_replace('view\\elements\\', 'elements\\', $relative_class);
            }
            
            // Convert namespace separators to directory separators
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            
            // Make sure the file name is case sensitive
            $file = str_ireplace('basepage.php', 'basepage.php', $file);
            
            // If the file exists, require it
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}

// Register the autoloader
Autoloader::register();