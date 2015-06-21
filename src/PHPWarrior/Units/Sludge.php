<?php

namespace PHPWarrior\Units;

class Sludge extends Base {
  public function __construct() {
    $this->add_abilities(['attack', 'feel']);
  }

  public function play_turn($turn) {
    $directions = ['forward', 'left', 'right', 'backward'];
    foreach ($directions as $direction) {
      if ($turn->feel($direction)->is_player()) {
        $turn->attack($direction);
        return;
      }
    }
  }

  public function attack_power() {
    return 3;
  }

  public function max_health() {
    return 12;
  }

  public function character() {
    return "s";
  }
}
