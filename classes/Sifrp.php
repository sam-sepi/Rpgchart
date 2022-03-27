<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Sifrp extends RpgWrapper
{
    /**
     * getData
     *
     * @param string $dice
     * @return array
     */
    public function getData(array $input = null): array
    {
        $data = [];

        //rpg
        $data['rpg'] = 'Sifrp';

        if($this->validate->validateNumeric($input['dice']) == false)
        {
            $data['error'] = 'The Dice field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $data['dice'] = (int)$input['dice'];

        if($this->validate->validateInterval($data['dice'], 1, 7) == false)
        {
            $data['error'] = 'The Dice field is more than 7 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //ruleset
        $data['rules'] = nl2br($this->setRules());

        //yaxes
        $data['yaxes'] = 42;
        
        //test
        $data['roll'] = [];
        $data['test'] = [];
        
        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->getRoll($data['dice']);
        }

        return $data;

    }

    /**
     * getRoll
     *
     * @param integer $dice
     * @return integer
     */
    protected function getRoll(int $dice): int
    {
        $roll = [];

        for($i=0; $i < $dice; $i++)
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
        $filename = 'ruleset/sifrp.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}