<?php

namespace PHPWarrior\Abilities;


class Bind extends Base {
  public function description() {
    return __("Binds a unit in given direction to keep him from moving (forward by default).");
  }

  public function perform($direction = 'forward') {
    $direction = \PHPWarrior\Position::normalize_direction($direction);
    $this->verify_direction($direction);
    $receiver = $this->unit($direction);
    if ($receiver) {
      $this->unit->say(sprintf(
        __("binds %$1s and restricts %$2s"),
        __($direction),
        __($receiver)
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
