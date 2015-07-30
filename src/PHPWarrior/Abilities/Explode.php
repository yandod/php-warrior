<?php

namespace PHPWarrior\Abilities;

class Explode extends Base
{

    public $time;

    public function description()
    {
        return __("Kills you and all surrounding units. You probably don't want to do this intentionally.");
    }

    public function perform()
    {
        if ($this->unit->position) {
            $this->unit->say(__("explodes, collapsing the ceiling and damanging every unit."));
            foreach ($this->unit->position->floor->units() as $unit) {
                $unit->take_damage(100);
            }
        }
    }

    public function pass_turn()
    {
        if ($this->time && $this->unit->position) {
            $this->unit->say(__("is ticking"));
            $this->time -= 1;
            if ($this->time === 0) {
                $this->perform();
            }
        }
    }
}
