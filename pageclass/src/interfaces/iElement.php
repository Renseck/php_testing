<?php

namespace App\interfaces;

interface iElement
{
    public function show(bool $addWrapper) : string|bool;
}