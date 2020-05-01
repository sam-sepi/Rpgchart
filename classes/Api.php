<?php

namespace Rpgchart;

use Rpgchart\Basicrp;
use Rpgchart\Interlock;
use Rpgchart\Opend6;
use Rpgchart\Storyteller;

class Api
{
    protected $rpg;
    protected $rpgs = ['interlock', 'basicrp', 'opend6', 'storyteller', 'cypher'];
    public $error = FALSE;

    public function __construct(string $qstring = null)
    {
        if(in_array(strtolower($qstring), $this->rpgs))
        {
            switch($qstring)
            {
                case 'basicrp':
                    $this->rpg = new Basicrp;
                break;

                case 'interlock':
                    $this->rpg = new Interlock;
                break;

                case 'opend6':
                    $this->rpg = new Opend6;
                break;

                case 'storyteller':
                    $this->rpg = new Storyteller;
                break;

                case 'cypher':
                    $this->rpg = new Cypher;
                break;
            }
        }
        else
        {
            $this->error = TRUE;
        }
    }

    public function getData(string $first_var = null, string $sec_var = null): array
    {
        $array = $this->rpg->getData($first_var, $sec_var);

        return $array;
    }
}