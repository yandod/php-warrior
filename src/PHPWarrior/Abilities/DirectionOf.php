<?php

namespace PHPWarrior\Abilities;

class DirectionOf extends Base {

  public $is_sense = true;

  public function description() {
    return __("Pass a Space as an argument, and the direction (left, right, forward, backward) to that space will be returned.");
  }

  public function perform($space) {
    return $this->unit->position->relative_direction_of($space);
  }
}
