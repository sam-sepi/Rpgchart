<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Interlock extends RpgWrapper
{
    /**
     * getData
     *
     * @param string $stat
     * @param string $skill
     * @return array
     */
    public function getData(array $input = null): array
    {
        $data = [];

        //Rpg
        $data['rpg'] = 'Interlock System';

        if(($this->validate->validateNumeric($input['stat']) == false) or ($this->validate->validateNumeric($input['skill']) == false))
        {
            $data['error'] = 'The Stat field or the Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //stat & skill
        $data['stat'] = (int)$input['stat'];
        $data['skill'] = (int)$input['skill'];

        if(($this->validate->validateInterval($data['stat'], 0, 10) == false) or ($this->validate->validateInterval($data['skill'], 0, 10) == false))
        {
            $data['error'] = 'The Skill field or the Stat field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //yaxes
        $data['yaxes'] = 30; 

        //rules
        $data['rules'] = nl2br($this->setRules());

        //test
        $data['roll'] = [];
        $data['test'] = [];

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 10) + $data['stat'] + $data['skill'];
        }

        return $data;
    }

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/interlock.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}