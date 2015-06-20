<?php

namespace PHPWarrior\Abilities;

class Attack extends Base {
  public function description() {
    return __('Attacks a unit in given direction (forward by default).');
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    $receiver = $this->unit($direction);
    if ($receiver) {
      $this->unit->say(sprintf(
        __('attacks %1$s and hits %2$s'),
        $direction,
        $receiver
      ));
      if ($direction === ':backward') {
        $power = ceil($this->unit->attack_power()/2.0);
      } else {
        $power = $this->unit->attack_power();
      }
      $this->damage($receiver, $power);
    } else {
      $this->unit->say(sprintf(
        __("attacks %s and hits nothing"),
        $direction
      ));
    }
  }
}
