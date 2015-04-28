<?php

namespace PHPWarrior\Abilities;

class Feel extends Base {

  public $is_sense = true;

  public function description() {
    return 'Returns a Space for the given direction (forward by default).';
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    return $this->space($direction);
  }
}
