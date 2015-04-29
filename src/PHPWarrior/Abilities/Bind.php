<?php

namespace PHPWarrior\Abilities;


class Bind extends Base {
  public function description() {
    return "Binds a unit in given direction to keep him from moving (forward by default).";
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    $receiver = $this->unit($direction);
    if ($receiver) {
      $this->unit->say("binds {$direction} and restricts {$receiver}");
      $receiver->bind();
    } else {
      $this->unit->say("binds {$direction} and restricts nothing");
    }
  }
}
