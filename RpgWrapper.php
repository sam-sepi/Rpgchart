<?php

namespace Rpgchart;

use Rpgchart\Validation;

class RpgWrapper
{
    public function __construct(Validation $validation)
    {
        $this->validate = $validation;
    }
}