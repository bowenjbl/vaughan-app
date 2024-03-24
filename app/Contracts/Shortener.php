<?php

namespace App\Contracts;

interface Shortener
{
    public function generate(string $url): string;
}
