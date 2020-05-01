<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Storyteller extends RpgWrapper
{   
    /**
     * Undocumented function
     *
     * @param string $pool
     * @param string $target
     * @return array
     */
    public function getData(string $pool = null, string $target = null): array
    {
        $data = [];

        $data['rpg'] = 'Storyteller System';

        $data['rules'] = nl2br('Actions are resolved in the Storyteller System by rolling a <b>pool</b> of ten-sided dice, with the number of dice determined by one or more of a character\'s traits. 
        
        <b>Each action has a number that each die must meet; this number is either called a difficulty (in the World of Darkness games and Street Fighter) or a target number (in the Revised Storyteller System)</b>. 
        
        This number is usually 7, although some World of Darkness games instead use a baseline difficulty of 6. 
        
        Any dice that come up as this number or higher are counted as successes; in some versions, each die showing a result of 1 actually subtracts a success. The more successes, the more favourable the result.');

        $data['yaxes'] = 10;

        if(($this->validate->validateNumeric($pool) == false) or ($this->validate->validateNumeric($target) == false))
        {
            $data['error'] = 'The Pool field or the Target field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $pool = (int)$pool;
        $target = (int)$target;

        if($this->validate->validateInterval($pool, 1, 10) == false)
        {
            $data['error'] = 'The Pool field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        if($this->validate->validateInterval($target, 1, 10) == false)
        {
            $data['error'] = 'The Target field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->countSuccess($pool, $target);
        }

        return $data;
    }

    /**
     * Undocumented function
     *
     * @param integer $pool
     * @param integer $target
     * @return integer
     */
    protected function countSuccess(int $pool, int $target): int
    {
        $dices = [];

        for($i = 0; $i < $pool; $i++)
        {
            $dices[$i] = rand(1, 10);
        }

        $newarr = [];

        for($i = 0; $i < count($dices); $i++)
        {
            if($dices[$i] >= $target)
            {
                $newarr[$i] = $dices[$i];
            }
        }

        return count($newarr);
    }
}