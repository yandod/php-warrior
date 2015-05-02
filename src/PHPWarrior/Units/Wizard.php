<?php

namespace PHPWarrior\Units;

class Wizard extends Base {
  public function __construct() {
    $this->add_abilities(['shoot', 'look']);
  }

  public function play_turn($turn) {
    $directions = [':forward', ':left', ':right'];
    foreach ($directions as $direction) {
      foreach ($turn->look($direction) as $space) {
        if ($space->is_player()) {
          $turn->shoot($direction);
          return;
        } elseif (!$space->is_empty()) {
          break;
        }
      }
    }
  }

  public function shoot_power() {
    return 11;
  }

  public function max_health() {
    return 3;
  }

  public function character() {
    return "w";
  }
}
