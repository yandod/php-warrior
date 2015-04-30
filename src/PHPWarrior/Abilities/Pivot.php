<?php

namespace PHPWarrior\Abilities;

class Pivot extends Base {
  public static $ROTATION_DIRECTIONS = [':forward', ':right', ':backward', ':left'];

  public function description() {
    return "Rotate :left, :right or :backward (default)";
  }

  public function perform($direction = ':backward') {
    $this->verify_direction($direction);
    $this->unit->position->rotate(
      array_search($direction, self::$ROTATION_DIRECTIONS)
    );
    $this->unit->say("pivots {$direction}");
  }
}
