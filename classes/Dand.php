<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Dand extends Rpgwrapper
{
    /**
     * getData
     *
     * @param array $input
     * @return array
     */
    public function getData(array $input = null): array
    {
        $data = [];

        $data['rpg'] = 'Dungeons and Dragons';

        if(($this->validate->validateNumeric($input['stat']) == false) or ($this->validate->validateNumeric($input['skill']) == false))
        {
            $data['error'] = 'The Stat field or the Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //stat & skill
        $data['stat'] = (int)$input['stat'];
        $data['skill'] = (int)$input['skill'];
        $data['cd'] = (int)$input['cd'];

        if(($this->validate->validateInterval($data['stat'], 6, 24) == false) or ($this->validate->validateInterval($data['skill'], 1, 24) == false))
        {
            $data['error'] = 'The Stat field is more than 24 or less than 6 or the Skill field is more than 20 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        if($this->validate->validateInterval($data['cd'], 1, 40) == false)
        {
            $data['error'] = 'The CD field is more than 40 or less than 1';
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
            $data['roll'][$i] = rand(1, 20) + floor(($data['stat'] - 10)/2) + $data['skill'];
        }

        return $data;
    }

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/dand.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}