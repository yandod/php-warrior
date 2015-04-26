<?php

namespace PHPWarrior\Abilities;

class Walk extends Base {

  public function description() {
    return "Move in the given direction (forward by default).";
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    if ($this->unit->position) {
      $s_direction = str_replace(':','',$direction);
      $this->unit->say("walks {$s_direction}");
      if ($this->space($direction)->is_empty()) {
        $this->unit->position->move($this->offset($direction));
      } else {
        $this->unit->say("bumps into ". $this->space($direction));
      }
    }
  }
}
