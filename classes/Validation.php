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
        return (is_numeric($input)) ? true : false;
    }

    /**
     * validateAlpha
     *
     * @param string $input
     * @return boolean
     */
    public function validateAlpha(string $input = null): bool
    {
        return (ctype_alpha($input)) ? true : false;
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
        return (($stat <= $max) && ($stat >= $min)) ? true : false;
    }
}

