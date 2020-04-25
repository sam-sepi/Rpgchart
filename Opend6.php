<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Opend6 extends RpgWrapper
{
    /**
     * Undocumented function
     *
     * @param string $pool
     * @param string $bonus
     * @return array
     */
    public function getData(string $pool = null, string $bonus = null): array
    {
        $data = [];

        $data['message'] = '';

        $data['yaxes'] = 30;

        if(($this->validate->validateNumeric($pool) == false) or ($this->validate->validateNumeric($bonus) == false))
        {
            $data['error'] = 'Stat or pool fields are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $pool = (int)$pool;
        $bonus = (int)$bonus;

        if(($this->validate->validateInterval($pool, 0, 8) == false) or ($this->validate->validateInterval($bonus, 0, 2) == false))
        {
            $data['error'] = 'The pool field is more than 8 or less than 0 or the bonus field is more than 2 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->getRoll($pool) + $bonus;
        }

        return $data;

    }

    /**
     * Undocumented function
     *
     * @param integer $pool
     * @return integer
     */
    protected function getRoll(int $pool): int
    {
        $roll = [];

        for($i=0; $i < count($pool); $i++)
        {
            $roll[$i] = rand(1, 6);
        }

        return array_sum($roll);
    }
}