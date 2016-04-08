<?php

namespace PHPWarrior\Units;

/**
 * Class Sludge
 * 
 * @package PHPWarrior\Units
 */
class Sludge extends Base
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->add_abilities(['attack', 'feel']);
    }

    /**
     * Play your turn.
     *
     * @param $turn
     */
    public function play_turn($turn)
    {
        $directions = ['forward', 'left', 'right', 'backward'];
        foreach ($directions as $direction) {
            if ($turn->feel($direction)->is_player()) {
                $turn->attack($direction);
                return;
            }
        }
    }

    /**
     * Your attack power.
     *
     * @return int
     */
    public function attack_power()
    {
        return 3;
    }

    /**
     * Maximun health.
     *
     * @return int
     */
    public function max_health()
    {
        return 12;
    }

    /**
     * Your character.
     *
     * @return string
     */
    public function character()
    {
        return "s";
    }
}
