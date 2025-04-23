<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date: 15/04/2025                                                                     │  *
 *  │  Project: Web framework                                                               │  *
 *  │  Goal: Default Header Element to inject into Page class                               │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/

namespace App\views\elements;

use App\views\elements\Element;

class DefaultHeader extends Element
{
    public function getContent() : string
    {
        return '<title>My website</title>' . PHP_EOL
              .'<meta charset="UTF-8">' . PHP_EOL
              .'<meta name="description" content="SPA">'. PHP_EOL
              .'<meta name="author" content="Rens van Eck">' . PHP_EOL
              .'<meta name="viewport" content="width=device-width, initial-scale=1.0">' . PHP_EOL;

    }
}