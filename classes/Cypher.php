<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Cypher extends RpgWrapper
{
    public function getData(string $difficulty = null, string $effort = null)
    {
        $data = [];

        $data['rpg'] = 'Cypher System';

        $data['yaxes'] = 30;

        $data['rules'] = nl2br('Cypher System gameplay involves a simple die roll to determines success or failure in any kind of action. <b>The GM assigns a difficulty on a scale of 1 to 10—a 1 is extremely simple, while a 10 represents a herculean task beyond the means of most mortals</b>. 
        
        Once the GM has assigned this difficulty, the rest is up to the players. Players apply their skills and experience, tools or other advantages, aid from one another, and other assets to reduce this difficulty. 
        
        They can also focus a limited resource called <b>Effort</b> to further lower the difficulty of actions really important to them.
        
        Once a player has reduced the difficulty as much as they are able, they roll a d20. The target number is equal to three times the difficulty.');

        if(($this->validate->validateNumeric($difficulty) == false) or ($this->validate->validateNumeric($effort) == false))
        {
            $data['error'] = 'The Difficulty field or the Effort field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $difficulty = (int)$difficulty;
        $effort = (int)$effort;

        if($this->validate->validateInterval($difficulty, 1, 10) == false)
        {
            $data['error'] = 'The Difficulty field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        if($this->validate->validateInterval($effort, 0, 6) == false)
        {
            $data['error'] = 'The Effort field is more than 6 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $data['difficulty'] = ($difficulty - $effort) * 3;

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 20);
        }

        return $data;
    }
}