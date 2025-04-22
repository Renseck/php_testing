<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date: 22/04/2025                                                                     │  *
 *  │  Project: Bits and bobs                                                               │  *
 *  │  Goal: Add nice-looking banner to existing PHP files.                                 │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/


require_once __DIR__ . "/src/bannermaker.php";

/**
 * Add Banner CLI Script
 * 
 * This script adds or updates a banner in a PHP file using the bannerMaker class
 * 
 * Usage: php addbanner.php <file_path_or_directory> [date] [project] [goal]
 */

// Function to recursively find all PHP files in a directory
function findPhpFiles($directory) {
    $phpFiles = [];
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
            $phpFiles[] = $file->getPathname();
        }
    }
    
    return $phpFiles;
}

// Function to process a single file
function processSingleFile($filePath, $bannerMaker, $date, $project, $goal) {
    try {
        echo "Processing: $filePath ... ";
        $result = $bannerMaker->addBanner($filePath, $date, $project, $goal);
        
        if ($result !== false) {
            echo "✓ Done\n";
        } else {
            echo "⚠ Skipped (already has banner or not a valid PHP file)\n";
        }
    } catch (Exception $e) {
        echo "✗ Error: " . $e->getMessage() . "\n";
    }
}

// Check if file path is provided
if ($argc < 2) 
{
    echo "Usage: php addbanner.php <file_path_or_directory> [date] [project] [goal]\n";
    echo "Example: php addbanner.php path/to/file.php \"April 22, 2025\" \"PHP Testing\" \"Add banner functionality\"\n";
    echo "         php addbanner.php path/to/directory \"April 22, 2025\" \"PHP Testing\" \"Add banner functionality\"\n";
    exit(1);
}

$path = $argv[1];

// Check if path exists
if (!file_exists($path)) 
{
    echo "Error: Path '$path' not found\n";
    exit(1);
}

// Get optional parameters
$date = isset($argv[2]) ? $argv[2] : '';
$project = isset($argv[3]) ? $argv[3] : '';
$goal = isset($argv[4]) ? $argv[4] : '';

try 
{
    $bannerMaker = new bannerMaker();
    
    // Check if the path is a file or directory
    if (is_file($path)) {
        // Process a single file
        processSingleFile($path, $bannerMaker, $date, $project, $goal);
    } else {
        // It's a directory - find all PHP files and process each one
        echo "Searching for PHP files in '$path'...\n";
        $phpFiles = findPhpFiles($path);
        
        if (empty($phpFiles)) {
            echo "No PHP files found in the directory.\n";
            exit(0);
        }
        
        echo "Found " . count($phpFiles) . " PHP files. Processing...\n";
        
        $successCount = 0;
        $skipCount = 0;
        $errorCount = 0;
        
        foreach ($phpFiles as $phpFile) {
            try {
                echo "Processing: $phpFile ... ";
                $result = $bannerMaker->addBanner($phpFile, $date, $project, $goal);
                
                if ($result !== false) {
                    echo "✓ Done\n";
                    $successCount++;
                } else {
                    echo "⚠ Skipped (already has banner or not a valid PHP file)\n";
                    $skipCount++;
                }
            } catch (Exception $e) {
                echo "✗ Error: " . $e->getMessage() . "\n";
                $errorCount++;
            }
        }
        
        // Print summary
        echo "\nSummary:\n";
        echo "  Processed: " . count($phpFiles) . " files\n";
        echo "  Success: $successCount\n";
        echo "  Skipped: $skipCount\n";
        echo "  Errors: $errorCount\n";
    }
}
catch (Exception $e)
{
    echo "Fatal Error: " . $e->getMessage() . "\n";
    exit(1);
}