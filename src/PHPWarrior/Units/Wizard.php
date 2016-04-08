<?php

namespace PHPWarrior\Units;

/**
 * Class Wizard
 * 
 * @package PHPWarrior\Units
 */
class Wizard extends Base
{
    /**
     * Class constructor
     */
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

    /**
     * Shooting power for the wizard.
     *
     * @return int
     */
    public function shoot_power()
    {
        return 11;
    }

    /**
     * Maximun health for the wizard.
     *
     * @return int
     */
    public function max_health()
    {
        return 3;
    }

    /**
     * The character.
     *
     * @return string
     */
    public function character()
    {
        return "w";
    }
}
