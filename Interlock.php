<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Interlock extends RpgWrapper
{
    /**
     * Undocumented function
     *
     * @param string $stat
     * @param string $skill
     * @return array
     */
    public function getData(string $stat = null, string $skill = null): array
    {
        $data = [];

        $data['yaxes'] = 30; 

        $data['message'] = '';

        if(($this->validate->validateNumeric($stat) == false) or ($this->validate->validateNumeric($stat) == false))
        {
            $data['error'] = 'Stat or skill fields are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $stat = (int)$stat;
        $skill = (int)$skill;

        if(($this->validate->validateInterval($stat, 1, 10) == false) or ($this->validate->validateInterval($skill, 1, 10) == false))
        {
            $data['error'] = 'The skill field or the stat field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $data['roll'] = [];

        for($i = 0; $i < 50; $i++)
        {
            $data['roll'][$i] = rand(1, 10) + $stat + $skill;
        }

        return $data;
    }
}