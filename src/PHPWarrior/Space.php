<?php

namespace PHPWarrior;


class Space
{

    /**
     * Space constructor.
     * 
     * @param $floor
     * @param $x
     * @param $y
     */
    public function __construct($floor, $x, $y)
    {
        $this->floor = $floor;
        $this->x = $x;
        $this->y = $y;
    }

    public function is_wall()
    {
        return $this->floor->is_out_of_bounds($this->x, $this->y);
    }

    public function is_warrior()
    {
        return is_a($this->unit(), 'PHPWarrior\Units\Warrior');
    }

    public function is_golem()
    {
        return is_a($this->unit(), 'PHPWarrior\Units\Golem');
    }

    public function is_player()
    {
        return ($this->is_warrior() || $this->is_golem());
    }

    public function is_enemy()
    {
        return (
            $this->unit() &&
            !$this->is_player() &&
            !$this->is_captive()
        );
    }

    public function is_captive()
    {
        return (
            $this->unit() &&
            $this->unit()->is_bound()
        );
    }

    public function is_empty()
    {
        return (
            is_null($this->unit()) &&
            !$this->is_wall()
        );
    }

    public function is_stairs()
    {
        return (
            $this->floor->stairs_location == $this->location()
        );
    }

    public function is_ticking()
    {
        return (
            $this->unit() &&
            array_search(
                'explode',
                array_keys($this->unit()->abilities())
            ) !== false
        );
    }

    public function unit()
    {
        return $this->floor->get($this->x, $this->y);
    }

    public function location()
    {
        return [$this->x, $this->y];
    }

    public function character()
    {
        if ($this->unit()) {
            return $this->unit()->character();
        } elseif ($this->is_stairs()) {
            return '>';
        } else {
            return ' ';
        }
    }

    public function __ToString()
    {
        if ($this->unit()) {
            return (string)$this->unit();
        } elseif ($this->is_wall()) {
            return __('wall');
        } else {
            return __('nothing');
        }
    }
}
