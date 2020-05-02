<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Gurps extends RpgWrapper
{
    public function getData(array $input = null): array
    {
        $data = [];

        //Rpg
        $data['rpg'] = 'Gurps';

        if($this->validate->validateNumeric($input['skill']) == false)
        {
            $data['error'] = 'The Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //skill
        $data['skill'] = (int)$input['skill'];

        if($this->validate->validateInterval($data['skill'], 0, 18) == false)
        {
            $data['error'] = 'The Skill field is more than 18 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //yaxes
        $data['yaxes'] = 18;

        //rules
        $data['rules'] = nl2br($this->setRules());

        //difficulty
        $data['difficulty'] = $data['skill'];

        //test
        $data['roll'] = [];
        $data['test'] = [];

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 6) + rand(1, 6) + rand(1, 6);
        }

        return $data;
    }

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/gurps.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}