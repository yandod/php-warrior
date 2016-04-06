<?php

namespace PHPWarrior\Units;


class Captive extends Base
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->bind();
    }

    /**
     * Maximum health.
     *
     * @return int
     */
    public function max_health()
    {
        return 1;
    }

    /**
     * Character type.
     *
     * @return string
     */
    public function character()
    {
        return "C";
    }
}
