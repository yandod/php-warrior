<?php

namespace PHPWarrior\Abilities;

class DirectionOfStairs extends Base
{

    public $is_sense = true;

    public function description()
    {
        return __("Returns the direction (left, right, forward, backward) the stairs are from your location.");
    }

    public function perform()
    {
        return $this->unit->position->relative_direction_of_stairs();
    }
}
