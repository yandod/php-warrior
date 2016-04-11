<?php

namespace PHPWarrior;

/**
 * Class LevelLoader
 * 
 * @package PHPWarrior
 */
class LevelLoader
{
    /**
     * Class constructor
     *
     * @param $level
     * @param $load_path
     */
    public function __construct($level, $load_path)
    {
        $this->floor = new Floor();
        $this->level = $level;
        $this->level->floor = $this->floor;
        include $load_path;
    }

    /**
     * Description.
     *
     * @param $desc
     */
    public function description($desc)
    {
        $this->level->description = $desc;
    }

    /**
     * Tip.
     *
     * @param $tip
     */
    public function tip($tip)
    {
        $this->level->tip = $tip;
    }

    /**
     * Clue.
     *
     * @param $clue
     */
    public function clue($clue)
    {
        $this->level->clue = $clue;
    }

    /**
     * Time bonus.
     *
     * @param $bonus
     */
    public function time_bonus($bonus)
    {
        $this->level->time_bonus = $bonus;
    }

    /**
     * Ace score.
     *
     * @param $score
     */
    public function ace_score($score)
    {
        $this->level->ace_score = $score;
    }

    /**
     * Size.
     *
     * @param $width
     * @param $height
     */
    public function size($width, $height)
    {
        $this->floor->width = $width;
        $this->floor->height = $height;
    }

    /**
     * Stairs.
     *
     * @param $x
     * @param $y
     */
    public function stairs($x, $y)
    {
        $this->floor->place_stairs($x, $y);
    }

    /**
     * unit.
     *
     * @param $unit
     * @param $x
     * @param $y
     * @param string $facing
     *
     * @return mixed
     */
    public function unit($unit, $x, $y, $facing = ':north')
    {
        if (!is_a($unit, 'PHPWarrior\Units\Base')) {
            $camel = $this->unit_to_constant($unit);
            $unit = new $camel();
        }
        $this->floor->add($unit, $x, $y, $facing);
        //yield unit if block_given?
        return $unit;
    }

    /**
     * Warrior
     *
     * @param $x
     * @param $y
     * @param $facing
     *
     * @return mixed
     */
    public function warrior($x, $y, $facing)
    {
        return $this->level->setup_warrior(
            $this->unit(new Units\Warrior(), $x, $y, $facing)
        );
    }

    /**
     * Unit to constant
     *
     * @param $name
     *
     * @return string
     */
    public function unit_to_constant($name)
    {
        $camel = '';
        $name = str_replace(':', '', $name);
        foreach (explode('_', $name) as $str) {
            $camel .= ucfirst($str);
        }
        return 'PHPWarrior\Units\\' . $camel;
    }
}
