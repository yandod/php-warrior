<?php

namespace PHPWarrior\Abilities;

class Shoot extends Base {
  public function description() {
    return "Shoot your bow & arrow in given direction (forward by default).";
  }

  public function perform($direction = ':forward') {
    $this->verify_direction($direction);
    $receiver = null;
    foreach ($this->multi_unit($direction, range(1,3)) as $row) {
      if (!is_null($row)) {
        $receiver = $row;
        break;
      }
    }
    if ($receiver) {
      $this->unit->say("shoots {$direction} and hits {$receiver}");
      $this->damage($receiver, $this->unit->shoot_power());
    } else {
      $this->unit->say("shoots and hits nothing");
    }
  }

  public function multi_unit($direction, $range) {
    $map = [];
    foreach ($range as $n) {
      $map[] = $this->unit($direction, $n);
    }
    return $map;
  }
}
