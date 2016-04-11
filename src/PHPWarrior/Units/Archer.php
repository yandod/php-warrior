<?php

namespace PHPWarrior\Units;


/**
 * Class Archer
 * 
 * @package PHPWarrior\Units
 */
class Archer extends Base
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->add_abilities(['shoot', 'look']);
    }

    /**
     * Play turn.
     *
     * @param $turn
     */
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

    /**
     * Shooting power for the ranger.
     *
     * @return int
     */
    public function shoot_power()
    {
        return 3;
    }

    /**
     * Maximun health
     *
     * @return int
     */
    public function max_health()
    {
        return 7;
    }

    /**
     * Type of character.
     *
     * @return string
     */
    public function character()
    {
        return "a";
    }
}
