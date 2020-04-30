<?php

namespace Rpgchart;

use Rpgchart\Validation;

class RpgWrapper
{
    public function __construct()
    {
        $this->validate = new Validation;
    }
}