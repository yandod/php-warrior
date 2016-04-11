<?php

namespace PHPWarrior\Units;

/**
 * Class Warrior
 * 
 * @package PHPWarrior\Units
 */
class Warrior extends Base
{

    /**
     * Class constructor.
     *
     * @todo make score dynamic
     */
    public function __construct()
    {
        $this->score = 0;
        $this->golem_abilities = [];
    }

    /**
     * Play the turn.
     *
     * @param $turn
     */
    public function play_turn($turn)
    {
        $this->player()->play_turn($turn);
    }

    /**
     * Player.
     *
     * @return \Player
     */
    public function player()
    {
        if (!isset($this->player)) {
            $this->player = new \Player();
        }
        return $this->player;
    }

    /**
     * Earn points.
     *
     * @param $points
     */
    public function earn_points($points)
    {
        $this->score += $points;
        $this->say(sprintf(
            __("earns %s points"),
            $points
        ));
    }

    public function attack_power()
    {
        return 5;
    }

    /**
     * Set the shooting power.
     *
     * @return int
     */
    public function shoot_power()
    {
        return 3;
    }

    /**
     * Set the maximum health.
     *
     * @return int
     */
    public function max_health()
    {
        return 20;
    }

    /**
     * Return the character name.
     *
     * @return mixed
     */
    public function name()
    {
        if ($this->name && !empty($this->name)) {
            return $this->name;
        } else {
            return __('Warrior');
        }
    }

    /**
     * Character.
     *
     * @return string
     */
    public function character()
    {
        return '@';
    }

    /**
     * Perform the warrior his turn.
     */
    public function perform_turn()
    {
        if (is_null($this->current_turn->action)) {
            $this->say(__("does nothing"));
        }
        return parent::perform_turn();
    }
}
