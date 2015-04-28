<?php

namespace PHPWarrior\Abilities;

class Health extends Base {

  public $is_sense = true;

  public function description() {
    return 'Returns an integer representing your health.';
  }

  public function perform() {
    return $this->unit->health();
  }
}
