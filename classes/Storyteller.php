<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Storyteller extends RpgWrapper
{   
    /**
     * getData
     *
     * @param string $pool
     * @param string $target
     * @return array
     */
    public function getData(array $input = null): array
    {
        $data = [];

        //rpg
        $data['rpg'] = 'Storyteller System';

        if(($this->validate->validateNumeric($input['pool']) == false) or ($this->validate->validateNumeric($input['target']) == false))
        {
            $data['error'] = 'The Pool field or the Target field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //pool & target
        $data['pool'] = (int)$input['pool'];
        $data['target'] = (int)$input['target'];

        if($this->validate->validateInterval($data['pool'], 1, 10) == false)
        {
            $data['error'] = 'The Pool field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        if($this->validate->validateInterval($data['target'], 1, 10) == false)
        {
            $data['error'] = 'The Target field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        //rules
        $data['rules'] = nl2br($this->setRules());

        //yaxes
        $data['yaxes'] = 10;

        //test
        $data['roll'] = [];
        $data['test'] = [];
        
        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->countSuccess($data['pool'], $data['target']);
        }

        return $data;
    }

    /**
     * countSuccess
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

    /**
     * setRules
     */
    protected function setRules(): string
    {
        $filename = 'ruleset/storyteller.txt';
        $handle = fopen($filename, 'r');

        return fread($handle, filesize($filename));
    }
}