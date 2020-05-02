<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Cypher extends RpgWrapper
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

        //Rpg
        $data['rpg'] = 'Cypher System';

        if(($this->validate->validateNumeric($input['difficulty']) == false) or ($this->validate->validateNumeric($input['effort']) == false))
        {
            $data['error'] = 'The Difficulty field or the Effort field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //Diff & effort
        $data['difficulty'] = (int)$input['difficulty'];
        $data['effort'] = (int)$input['effort'];

        if($this->validate->validateInterval($data['difficulty'], 1, 10) == false)
        {
            $data['error'] = 'The Difficulty field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        if($this->validate->validateInterval($input['effort'], 0, 6) == false)
        {
            $data['error'] = 'The Effort field is more than 6 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //yaxes
        $data['yaxes'] = 30;

        //rules
        $data['rules'] = nl2br($this->setRules());

        //difficulty
        $data['difficulty'] = ($data['difficulty'] - $input['effort']) * 3;

        //test
        $data['roll'] = [];
        $data['test'] = [];
        
        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 20);
        }

        return $data;
    }

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/cypher.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}