<?php

namespace Rpgchart;

class Validation
{
    /**
     * validateNumeric
     *
     * @param string $input
     * @return boolean
     */
    public function validateNumeric(string $input = null): bool
    {
        if(is_numeric($input)) return true;

        return false;
    }

    /**
     * validateAlpha
     *
     * @param string $input
     * @return boolean
     */
    public function validateAlpha(string $input = null): bool
    {
        if(ctype_alpha($input)) return true;

        return false;
    }

    /**
     * validateInterval
     *
     * @param integer $stat
     * @param integer $min
     * @param integer $max
     * @return boolean
     */
    public function validateInterval(int $stat, int $min, int $max): bool
    {
        if(($stat <= $max) && ($stat >= $min))
        {
            return true;
        }

        return false;
    }
}

