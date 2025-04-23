<?php
/*@*******************************************************************************************@*
 *                                                               |\_/,|   (`\                  *
 *                                                             _.|o o |_   ) )                 *
 *  ╭─────────────────────────────────────────────────────────(((───(((─────────────────────╮  *
 *  │  Author: Rens van Eck                                                                 │  *
 *  │  Date: 15/04/2025                                                                     │  *
 *  │  Project: Web framework                                                               │  *
 *  │  Goal: Simple 404 Element to inject into Page class                               │  *
 *  ╰───────────────────────────────────────────────────────────────────────────────────────╯  *
 *@*******************************************************************************************@*/

namespace App\views\elements;

use App\views\elements\Element;

class PageNotFound extends ELement
{
    public function getContent() : string
    {
        return '<h1>Page 404</h1>' . PHP_EOL
              .'<p>Page not found. Return home <a href="index.php?page=home" class="ajax-link">here</a>.</p>' . PHP_EOL;
    }
}