<?php

namespace PHPWarrior\Abilities;

class Look extends Base {

  public $is_sense = true;

  public function description() {
    return "Returns an array of up to three Spaces in the given direction (forward by public functionault).";
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    $map = [];
    foreach (range(1,3) as $amount) {
      $map[] = $this->space($direction, $amount);
    }
    return $map;
  }
}
