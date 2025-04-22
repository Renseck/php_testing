<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date:                                                                                │  *
 *  │  Project:                                                                             │  *
 *  │  Goal:                                                                                │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/


class bannerMaker
{
    private $bannerTemplate;
    
    // =============================================================================================
    public function __construct()
    {
        $this->bannerTemplate = $this->readFile(__DIR__ . "/banner.txt");
        if (!$this->bannerTemplate) 
        {
            throw new Exception("Banner file not found", 1);
        }
    }

    // =============================================================================================
    public function addBanner(string $filePath, string $date = '', string $project = '', string $goal = '')
    {        
        // Check if file exists - if yes, read the file content
        $content = $this->readFile($filePath);
        if ($content === false) return false;
        
        // Check if the file starts with <?php
        if (strpos($content, '<?php') !== 0) return false;

        // If there's already a proper header, quit
        if ($this->findRealHeader($content)) return false;

        // Check if there is already a simple header present
        $simpleHeader = $this->findSimpleHeader($content);
        if (!$simpleHeader)
        {
            // Generate new banner
            $banner = $this->generateBanner($date, $project, $goal);

            $success = $this->writeBannerToFile($filePath, $content, $banner);
            
            return $success;
        }
        else
        {
            // There is a header - read its content and put them in the nice banner
            $existingDate = $this->extractValue($simpleHeader, "Date:");
            $existingProject = $this->extractValue($simpleHeader, "Project:");
            $existingGoal = $this->extractValue($simpleHeader, "Goal:");

            // If none are provided, use the existing values
            $date = (!empty($date)) ? $date : 
                (!empty($existingDate) ? $existingDate : 'Unknown');
            $project = (!empty($project)) ? $project : 
                (!empty($existingProject) ? $existingProject : 'Unknown');
            $goal = (!empty($goal)) ? $goal : 
                (!empty($existingGoal) ? $existingGoal : 'Unknown');

            $banner = $this->generateBanner($date, $project, $goal);

            $content = $this->removeSimpleHeader($content);

            $success = $this->writeBannerToFile($filePath, $content, $banner);

            return $success;
        }
    }

    // =============================================================================================
    /**
     * Read file contents
     * @param string $filePath Path/to/file
     * 
     * @return string File contents, false if not found
     */
    private function readFile(string $filePath) : string|bool
    {
        // If file doesnt exist, return false
        if (!file_exists($filePath)) return false;

        // Read the file content
        $content = file_get_contents($filePath);
        return $content;
    }

    // =============================================================================================
    /**
     * Find the existing simple banner in the first 10 rows
     * @param string $content File content
     * 
     * @return string|bool Simple header strings, false if not found
     */
    private function findSimpleHeader(string $content) : string|bool
    {
        $lines = explode("\n", $content);
        
        $startIndex = (trim($lines[0]) === '<?php') ? 1 : 0;

        $headerLines = [];
        $inHeader = false;

        for ($i = $startIndex; $i < 10; $i++)
        {
            if (empty($lines[$i])) continue;

            $line = trim($lines[$i]);

            if (empty($line)) continue;

            // If it matches regex, put it in the headerLines array
            if (preg_match('/^\/\/\s*([A-Za-z]+):\s*(.+)$/', $line))
            {
                $headerLines[] = $line;
                $inHeader = true;
            }
            // If we were in a header block but found something not matching, break
            else if ($inHeader) break;
            else break;
        }

        if (!empty($headerLines))
        {
            return implode("\n", $headerLines);
        }

        return false;
    }

    // =============================================================================================
    /**
     * See if a proper header is already present
     * @param mixed $content The file contents
     * 
     * @return bool Whether the header is there or not
     */
    private function findRealHeader($content) : bool
    {
        $lines = explode("\n" , $content);

        $startIndex = (trim($lines[0]) === '<?php') ? 1 : 0;

        // Allow for some wiggle room
        for ($i = $startIndex; $i < 3; $i++)
        {
            if (empty($lines[$i])) continue;
        
            $line = trim($lines[$i]);

            if (empty($line)) continue;

            // We found the real header! Boot out
            if (str_starts_with($line, "/*@**")) return true;
        }

        return false;
    }

    // =============================================================================================
    /**
     * Extract values from strings
     * @param string $content The string to extract from
     * @param string $key The key value to search for
     * 
     * @return string The value associated with the key
     */
    private function extractValue(string $content, $key) : string
    {
        if (preg_match('/' . preg_quote($key) . '\s*([^\n\r]*)/i', $content, $matches)) 
        {
            return trim($matches[1]);
        }
        return '';
    }

    // =============================================================================================
    private function generateBanner(string $date, string $project, string $goal) : string
    {
        $maxLength = 85;
        $author = str_pad("Author: Rens van Eck", $maxLength, ' ', STR_PAD_RIGHT);
        $date = str_pad("Date: " . $date, $maxLength, ' ', STR_PAD_RIGHT);
        $project = str_pad("Project: " . $project, $maxLength, ' ', STR_PAD_RIGHT);
        $goal = str_pad("Goal: " . $goal, $maxLength, ' ', STR_PAD_RIGHT);

        $lines = [$author, $date, $project, $goal];

        $bannerStart = $this->getBannerStart();

        $bannerBody = $this->generateBannerLines($lines);

        $bannerEnd =   $this->getBannerEnd();

        $banner = $bannerStart . $bannerBody . $bannerEnd;
        
        return $banner;
    }

    // =============================================================================================
    private function generateBannerLines(array $lines) : string
    {
        $result = "";
        $lastIndex = count($lines) - 1;
        
        foreach ($lines as $index => $line)
        {
            $result .= " *  │  " . $line . "│  *";
            // Only add newline if not the last item
            if ($index !== $lastIndex) {
                $result .= PHP_EOL;
            }
        }
    
        return $result;
    }
    
    // =============================================================================================
    private function writeBannerToFile(string $filePath, string $content, string $banner) : bool
    {
        $parts = explode('<?php', $content, 2);

        if (count($parts) !== 2) return false;

        $newContent = '<?php' . PHP_EOL . $banner . $parts[1];
        $result = file_put_contents($filePath, $newContent);

        return $result !== false;
    }

    // =============================================================================================
    /**
     * Remove the existing simple header from the file
     * @param string $content The file content
     * 
     * @return string|bool The modified file content or false if none is found
     */
    private function removeSimpleHeader(string $content) : string|bool
    {
        $lines = explode("\n", $content);
        $resultLines = [];
        $simpleHeader = $this->findSimpleHeader($content);
        if (!$simpleHeader) return $content; // Nothing to remove

        // Remove the simple header from the file
        $headerLines = explode("\n", $simpleHeader);
        $skipLines = [];

        $startIndex = (trim($lines[0]) === '<?php') ? 1 : 0;

        // Find the lines to skip
        $j = 0;
        for ($i = $startIndex; $i < count($lines) && $j < count($headerLines); $i++) {
            if (trim($lines[$i]) === trim($headerLines[$j])) {
                $skipLines[] = $i;
                $j++;
            }
        }
        
        // Reconstruct file without header lines
        for ($i = 0; $i < count($lines); $i++) {
            if (!in_array($i, $skipLines)) {
                $resultLines[] = $lines[$i];
            }
        }
        
        return implode("\n", $resultLines);
    }

    // =============================================================================================
    private function getBannerStart() : string 
    {
        $lineCount = substr_count($this->bannerTemplate, "\n") + 1;
        $lines = explode("\r", $this->bannerTemplate, $lineCount);

        $bannerStart = "";

        for ($i = 0; $i < $lineCount; $i ++)
        {
            if (str_starts_with(trim($lines[$i]), "!--")) break;
            $bannerStart .= $lines[$i];
        }
        
        return $bannerStart . PHP_EOL;
    }

    // =============================================================================================
    private function getBannerEnd() : string
    {
        $lineCount = substr_count($this->bannerTemplate, "\n") + 1;
        $lines = explode("\r", $this->bannerTemplate, $lineCount);

        $bannerEnd = "";
        $endPortion = false;

        for ($i = 0; $i < $lineCount; $i++)
        {
            if ($endPortion) $bannerEnd .= $lines[$i];
            if (str_starts_with(trim($lines[$i]), "!--")) $endPortion = true;
        }

        return $bannerEnd . PHP_EOL;
    }
}