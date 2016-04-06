<?php

namespace PHPWarrior;


class Tower
{
    public $path;

    /**
     * Tower constructor.
     * 
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function name()
    {
        return basename($this->path);
    }

    public function __toString()
    {
        return $this->name();
    }
}
