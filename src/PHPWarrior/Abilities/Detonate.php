<?php

namespace PHPWarrior\Abilities;

class Detonate extends Base
{
    public function description()
    {
        return __("Detonate a bomb in a given direction (forward by default) which damages that space and surrounding 4 spaces (including yourself).");
    }

    public function perform($direction = 'forward')
    {
        $direction = \PHPWarrior\Position::normalize_direction($direction);
        $this->verify_direction($direction);
        if ($this->unit->position) {
            $this->unit->say(sprintf(
                __("detonates a bomb %s launching a deadly explosion."),
                $direction
            ));
            $this->bomb($direction, 1, 0, 8);
            foreach ([[1, 1], [1, -1], [2, 0], [0, 0]] as list($x, $y)) {
                $this->bomb($direction, $x, $y, 4);
            }
        }
    }

    public function bomb($direction, $x, $y, $damage_amount)
    {
        if ($this->unit->position) {
            $receiver = $this->space($direction, $x, $y)->unit();
            if ($receiver) {
                if (isset($receiver->abilities['explode'])) {
                    $receiver->say(__("caught in bomb's flames which detonates ticking explosive"));
                    $receiver->abilities['explode']->perform();
                } else {
                    $this->damage($receiver, $damage_amount);
                }
            }
        }
    }
}
