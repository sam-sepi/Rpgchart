<?php

namespace Rpgchart;

use Rpgchart\Basicrp;
use Rpgchart\Interlock;
use Rpgchart\Opend6;
use Rpgchart\Storyteller;
use Rpgchart\Cypher;
use Rpgchart\Dand;
use Rpgchart\Gurps;
use Rpgchart\Sifrp;

class Api
{
    protected $rpg;
    protected $rpgs = ['interlock', 'basicrp', 'opend6', 'storyteller', 'cypher', 'gurps', 'dand', 'sifrp'];
    public $error = FALSE;

    /**
     * instance of RPG obj.
     *
     * @param string $qstring
     */
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

                case 'gurps':
                    $this->rpg = new Gurps;
                break;

                case 'dand':
                    $this->rpg = new Dand;
                break;

                case 'sifrp':
                    $this->rpg = new Sifrp;
                break;

                default:
                    $this->error = TRUE;
            }
        }
        else
        {
            $this->error = TRUE;
        }
    }

    /**
     * getData
     *
     * @param array $input
     * @return array
     */
    public function getData(array $input = null): array
    {
        $array = $this->rpg->getData($input);

        return $array;
    }
}