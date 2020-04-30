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

        $data['rpg'] = 'Interlock System';

        $data['yaxes'] = 30; 

        $data['rules'] = nl2br('When making a Skill Check, first, determine which of your stats is the most appropriate to use to perform the action. 
        
        For example, i you were trying to stand on your head, REF would be best. If you were deciphering a code INT would be most appropriate. Next, if you have any one Skill directly relating to the task at hand, add that skill to the stat. You may apply only one Skill to a task at any time. 
        
        Finally, <b>roll 1D10 and add the combined total of your die roll, your Stat and your selected Skill</b>. 
        
        Compare your total with the <b>Task\'s Difficulty (10 Easy - 30 Nearly Impossible)</b>. If your total is equal or higher, you have succeeded; on a lower roll, you have failed.');

        if(($this->validate->validateNumeric($stat) == false) or ($this->validate->validateNumeric($skill) == false))
        {
            $data['error'] = 'The Stat field or the Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $stat = (int)$stat;
        $skill = (int)$skill;

        if(($this->validate->validateInterval($stat, 0, 10) == false) or ($this->validate->validateInterval($skill, 0, 10) == false))
        {
            $data['error'] = 'The Skill field or the Stat field is more than 10 or less than 1';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $data['roll'] = [];

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = rand(1, 10) + $stat + $skill;
        }

        return $data;
    }
}