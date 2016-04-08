<?php

namespace PHPWarrior\Units;

/**
 * Class ThickSludge
 * 
 * @package PHPWarrior\Units
 */
class ThickSludge extends Sludge
{
    /**
     * Maximum health.
     *
     * @return int
     */
    public function max_health()
    {
        return 24;
    }

    /**
     * Character.
     *
     * @return string
     */
    public function character()
    {
        return "S";
    }
}
