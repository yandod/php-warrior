<?php

namespace PHPWarrior;

class LevelLoader
{
    public function __construct($level, $load_path)
    {
        $this->floor = new Floor();
        $this->level = $level;
        $this->level->floor = $this->floor;
        include $load_path;
    }

    public function description($desc)
    {
        $this->level->description = $desc;
    }

    public function tip($tip)
    {
        $this->level->tip = $tip;
    }

    public function clue($clue)
    {
        $this->level->clue = $clue;
    }

    public function time_bonus($bonus)
    {
        $this->level->time_bonus = $bonus;
    }

    public function ace_score($score)
    {
        $this->level->ace_score = $score;
    }

    public function size($width, $height)
    {
        $this->floor->width = $width;
        $this->floor->height = $height;
    }

    public function stairs($x, $y)
    {
        $this->floor->place_stairs($x, $y);
    }

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

    public function warrior($x, $y, $facing)
    {
        return $this->level->setup_warrior(
            $this->unit(new Units\Warrior(), $x, $y, $facing)
        );
    }

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
