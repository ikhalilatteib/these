<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class CommandOutputHelper
{
    public static function trimCommandOutput(string $output): string
    
    {
        $output = htmlentities($output, ENT_QUOTES, 'UTF-8');
        $output = Str::replace("\r\n", "\n", $output);
        $output = Str::replace("\r", "\n", $output);
        $output = Str::replace("\n", "<br>", $output);
        return $output;
    }
    
}