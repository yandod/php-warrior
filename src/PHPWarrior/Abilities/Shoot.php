<?php

namespace PHPWarrior\Abilities;

class Shoot extends Base {
  public function description() {
    return __("Shoot your bow & arrow in given direction (forward by default).");
  }

  public function perform($direction = 'forward') {
    $direction = \PHPWarrior\Position::normalize_direction($direction);
    $this->verify_direction($direction);
    $receiver = null;
    foreach ($this->multi_unit($direction, range(1,3)) as $row) {
      if (!is_null($row)) {
        $receiver = $row;
        break;
      }
    }
    if ($receiver) {
      $this->unit->say(sprintf(
        __('shoots %1$s and hits %2$s'),
        __($direction),
        __($receiver)
      ));
      $this->damage($receiver, $this->unit->shoot_power());
    } else {
      $this->unit->say(__("shoots and hits nothing"));
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
