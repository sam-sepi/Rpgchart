<?php

namespace Rpgchart;

class Validation
{
    public function validateNumeric(string $input = null): bool
    {
        if(is_numeric($input)) return true;

        return false;
    }

    public function validateAlpha(string $input = null): bool
    {
        if(ctype_alpha($input)) return true;

        return false;
    }

    public function validateInterval(int $stat, int $min, int $max): bool
    {
        if(($stat <= $max) && ($stat >= $min))
        {
            return true;
        }

        return false;
    }
}

