<?php

namespace PHPWarrior\Abilities;


class Bind extends Base
{
    public function description()
    {
        return __("Binds a unit in given direction to keep him from moving (forward by default).");
    }

    public function perform($direction = 'forward')
    {
        $direction = \PHPWarrior\Position::normalize_direction($direction);
        $this->verify_direction($direction);
        $receiver = $this->unit($direction);
        if ($receiver) {
            $this->unit->say(sprintf(
                __('binds %1$s and restricts %2$s'),
                __($direction),
                $receiver
            ));
            $receiver->bind();
        } else {
            $this->unit->say(sprintf(
                __("binds %s and restricts nothing"),
                $direction
            ));
        }
    }
}
