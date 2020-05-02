<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Opend6 extends RpgWrapper
{
    /**
     * getData
     *
     * @param string $increment
     * @param string $partial_die
     * @return array
     */
    public function getData(array $input = null): array
    {
        $data = [];

        //rpg
        $data['rpg'] = 'OpenD6';

        if(($this->validate->validateNumeric($input['increment']) == false) or ($this->validate->validateNumeric($input['partial_die']) == false))
        {
            $data['error'] = 'The Increment field or the Partial Die field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //increment & partial die
        $data['increment'] = (int)$input['increment'];
        $data['partial_die'] = (int)$input['partial_die'];

        if(($this->validate->validateInterval($data['increment'], 1, 8) == false) or ($this->validate->validateInterval($data['partial_die'], 0, 2) == false))
        {
            $data['error'] = 'The Increment field is more than 8 or less than 1 or the Partial Die field is more than 2 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //ruleset
        $data['rules'] = nl2br($this->setRules());

        //yaxes
        $data['yaxes'] = 30;
        
        //test
        $data['roll'] = [];
        $data['test'] = [];
        
        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->getRoll($data['increment']) + $data['partial_die'];
        }

        return $data;

    }

    /**
     * getRoll
     *
     * @param integer $increment
     * @return integer
     */
    protected function getRoll(int $increment): int
    {
        $roll = [];

        for($i=0; $i < $increment; $i++)
        {
            $roll[$i] = rand(1, 6);
        }

        return array_sum($roll);
    }

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/opend6.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}