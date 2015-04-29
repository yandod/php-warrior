<?php

namespace PHPWarrior\Abilities;

class Base {

  public $is_sense = false;

  public function __construct($unit) {
    $this->unit = $unit;
  }

  public function offset($direction, $forward = 1, $right = 0) {
    switch ($direction) {
      case ':forward':
        return [$forward, -$right];
        break;
      case ':backward':
        return [-$forward, $right];
        break;
      case ':right':
        return [$right, $forward];
        break;
      case ':left':
        return [-$right, -$forward];
        break;
    }
  }

  public function space($direction, $forward = 1, $right = 0) {
    return call_user_func_array(
      [$this->unit->position,'relative_space'],
      $this->offset($direction, $forward, $right)
    );
    //return $this->unit->position->relative_space($this->offset($direction, $forward, $right));
  }

  public function unit($direction, $forward = 1, $right = 0) {
    return $this->space($direction, $forward, $right)->unit();
  }

  public function damage($receiver, $amount) {
    $receiver->take_damage($amount);
    if (!$receiver->is_alive()) {
      $this->unit->earn_points($receiver->max_health());
    }
  }

  public function description() {
  }

  public function pass_turn() {
    # callback which is triggered every turn
  }

  public function verify_direction($direction) {
    if (array_search($direction,\PHPWarrior\Position::$RELATIVE_DIRECTIONS) === false) {
      throw new \Exception("Unknown direction {$direction}. Should be :forward, :backward, :left or :right.");
    }
  }
}
