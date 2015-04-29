<?php

namespace PHPWarrior\Units;


class Captive extends Base {
  public function __consturuct() {
    $this->bind();
  }

  public function max_health() {
    return 1;
  }

  public function character() {
    return "C";
  }
}
