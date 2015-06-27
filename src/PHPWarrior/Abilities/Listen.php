<?php

namespace PHPWarrior\Abilities;


class Listen extends Base {

  public $is_sense = true;

  public function description() {
    return __("Returns an array of all spaces which have units in them.");
  }

  public function perform() {
    $map = [];
    foreach ($this->unit->position->floor->units() as $unit) {
      if ($unit !== $this->unit) {
        $map[] = $unit->position->space();
      }
    }
    return $map;
  }

}
