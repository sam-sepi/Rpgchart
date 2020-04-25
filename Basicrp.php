<?php

namespace Rpgchart;

use Rpgchart\Validation;

class Basicrp extends RpgWrapper
{
    public function getData(string $skill = null): array
    {
        $data = [];

        $data['message'] = '';

        $data['yaxes'] = 100;

        if($this->validate->validateNumeric($skill) == false)
        {
            $data['error'] = 'Skill fields are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $skill = (int)$skill;

        $data['skill'] = $skill;

        if($this->validate->validateInterval($skill, 0, 100) == false)
        {
            $data['error'] = 'The skill field is more than 100 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 100);
        }

        return $data;
    }

}