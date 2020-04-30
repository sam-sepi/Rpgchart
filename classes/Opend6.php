<?php

namespace Rpgchart;

use Rpgchart\RpgWrapper;

class Opend6 extends RpgWrapper
{
    /**
     * Undocumented function
     *
     * @param string $increment
     * @param string $partial_die
     * @return array
     */
    public function getData(string $increment = null, string $partial_die = null): array
    {
        $data = [];

        $data['rpg'] = 'OpenD6';

        $data['rules'] = nl2br('In the standard rules, traits are rated by whole and partial increments of six-sided dice. <b>A whole die increment is written as “1D”, where the integer denotes a number of dice to be rolled and totaled. Partial die increments are written as “1D+1”, where the primary identity denotes a number of dice to be rolled and totaled, and the secondary identity denotes an absolute value to be added to the sum total.</b>

        Conflict resolution in OpenD6 is based on a standardized difficulty scale that is adjusted for the mathematical mean of a given trait score.
        
        On this difficulty scale, a “Moderate” difficulty is defined as a number approximating the mean roll of a trait score totaling between 3D and 4D, so that the sum total of a trait roll will equal or exceed the difficulty on approximately 50% of a given set of iterations. Difficulties are then derived mathematically in multiples of 3.5, where the corresponding descriptive value is derived in multiples of 5.');

        $data['yaxes'] = 30;

        if(($this->validate->validateNumeric($increment) == false) or ($this->validate->validateNumeric($partial_die) == false))
        {
            $data['error'] = 'The Increment field or the Partial Die field are not numeric';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        $increment = (int)$increment;
        $partial_die = (int)$partial_die;

        if(($this->validate->validateInterval($increment, 1, 8) == false) or ($this->validate->validateInterval($partial_die, 0, 2) == false))
        {
            $data['error'] = 'The Increment field is more than 8 or less than 1 or the Partial Die field is more than 2 or less than 0';
            $data['http_error'] = '400 Bad Request';

            return $data;
        }

        for($i = 0; $i < 50; $i++)
        {
            $data['test'][$i] = 'Test no.: ' . $i;
            $data['roll'][$i] = $this->getRoll($increment) + $partial_die;
        }

        return $data;

    }

    /**
     * Undocumented function
     *
     * @param integer $increment
     * @return integer
     */
    protected function getRoll(int $increment): int
    {
        $roll = [];

        for($i=0; $i < $increment; $i++)
        {
            $roll[$i] = rand(1, 6);
        }

        return array_sum($roll);
    }
}