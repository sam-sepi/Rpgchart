<?php

namespace Rpgchart;

use Rpgchart\Validation;

class Basicrp extends RpgWrapper
{
    public function getData(string $skill = null): array
    {
        $data = [];

        $data['rpg'] = 'Basic Role Playing';

        $data['rules'] = nl2br('Player characters and NPCs alike have skills <b>a rating of 00% (no chance of success) to 100+% (almost always succeeding)</b>. A character’s skill points are added to the skill’s base chance for a chance of success. 
        
        The process is simple: the player or GM announces that a character (PC or NPC) will attempt a skill. A percentage dice roll is made. <b>If the roll is equal to or less than the chance of success, the skill succeeds (with appropriate results). If the roll is over the chance of success, the skill fails</b>.
        
        <b>Difficulty</b>: 
        
        <b>Normal</b>: This is the standard, meaning that any conditions, circumstances, etc. are negligible and won’t affect the chance to use the skill.

        <b>Difficult</b>: If a skill would be made more difficult by some circumstance, condition, or other situation, divide the skill chance in half (rounding up). 

        <b>Impossible</b>: If it’s simply impossible for the skill to succeed, such as a normal human attempting to leap 100 meters into the air unaided, or solve a crossword puzzle in absolute darkness, no roll should be allowed. The skill attempt just fails, with any appropriate consequences. The GM may either declare no roll is needed, or allow a roll and present the chance of a fumble.
    
        <b>Special Success</b>: Not all successes are equal. Sometimes a skill use is “just right,” and the result is better than normal. In this case, the result is called a special success. A special success is equal to one-fifth (1/5) the chance of success, rounded up (use the final chance if modified by a difficulty). For example, a skill of 60% means that any roll of 01 through 12 is a special success, as 12 is 1/5 of 60%).');

        $data['yaxes'] = 100;

        if($this->validate->validateNumeric($skill) == false)
        {
            $data['error'] = 'The Skill field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $skill = (int)$skill;

        $data['skill'] = $skill;

        if($this->validate->validateInterval($skill, 0, 100) == false)
        {
            $data['error'] = 'The Skill field is more than 100 or less than 0';
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