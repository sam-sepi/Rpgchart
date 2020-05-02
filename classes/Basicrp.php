<?php

namespace Rpgchart;

use Rpgchart\Validation;

class Basicrp extends RpgWrapper
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

        //rpg
        $data['rpg'] = 'Basic Role Playing';

        if($this->validate->validateNumeric($input['skill']) == false)
        {
            $data['error'] = 'The Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //skill
        $data['skill'] = (int)$input['skill'];

        if($this->validate->validateInterval($data['skill'], 0, 100) == false)
        {
            $data['error'] = 'The Skill field is more than 100 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //difficulty
        $data['difficulty'] = $data['skill'];

        //rules
        $data['rules'] = nl2br($this->setRules());

        //yaxes
        $data['yaxes'] = 100;

        //test
        $data['roll'] = [];
        $data['test'] = [];

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 100);
        }

        return $data;
    }

     /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/basicrp.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}