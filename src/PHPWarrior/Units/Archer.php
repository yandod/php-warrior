<?php

namespace PHPWarrior\Units;


class Archer extends Base
{
    public function __construct()
    {
        $this->add_abilities(['shoot', 'look']);
    }

    public function play_turn($turn)
    {
        $directions = ['forward', 'left', 'right'];
        foreach ($directions as $direction) {
            foreach ($turn->look($direction) as $space) {
                if ($space->is_player()) {
                    $turn->shoot($direction);
                    return;
                } elseif (!$space->is_empty()) {
                    break;
                }
            }
        }
    }

    public function shoot_power()
    {
        return 3;
    }

    public function max_health()
    {
        return 7;
    }

    public function character()
    {
        return "a";
    }
}
