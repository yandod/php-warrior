<?php

namespace PHPWarrior\Abilities;


class DistanceOf extends Base {

  public $is_sense = true;

  public function description() {
    return __("Pass a Space as an argument, and it will return an integer representing the distance to that space.");
  }

  public function perform($space) {
    return $this->unit->position->distance_of($space);
  }
}
