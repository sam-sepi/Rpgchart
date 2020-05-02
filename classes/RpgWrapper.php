<?php

namespace Rpgchart;

use Rpgchart\Validation;

//Interface

abstract class RpgWrapper
{
    public function __construct()
    {
        $this->validate = new Validation;
    }

    abstract public function getData(array $input = null): array;

    abstract protected function setRules(): string;
}