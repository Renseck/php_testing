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
 * Usage: php addbanner.php <file_path> [date] [project] [goal]
 */

// Check if file path is provided
if ($argc < 2) 
{
    echo "Usage: php addbanner.php <file_path> [date] [project] [goal]\n";
    echo "Example: php addbanner.php path/to/file.php \"April 22, 2025\" \"PHP Testing\" \"Add banner functionality\"\n";
    exit(1);
}

$filePath = $argv[1];

// Check if file exists
if (!file_exists($filePath)) 
{
    echo "Error: File '$filePath' not found\n";
    exit(1);
}

// Get optional parameters
$date = isset($argv[2]) ? $argv[2] : '';
$project = isset($argv[3]) ? $argv[3] : '';
$goal = isset($argv[4]) ? $argv[4] : '';

try 
{
    $bannerMaker = new bannerMaker();
    $bannerMaker->addBanner($filePath, $date, $project, $goal);
}
catch (Exception $e)
{
    echo $e->getMessage();
    exit(1);
}