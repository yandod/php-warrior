<?php

namespace PHPWarrior\Units;

class Base {

  public $position;
  public $abilities = [];
  public $bound;

  public function attack_power() {
    return 0;
  }

  public function max_health() {
    return 0;
  }

  public function earn_points($points) {
  }

  public function health() {
    if (is_null($this->health)) {
      $this->health = $this->max_health();
    }
    return $this->health;
  }

  public function take_damage($amount) {
    if ($this->is_bound()) {
      $this->unbind();
    }
    if ($this->health()) {
      $this->health -= $amount;
      $this->say("takes {$amount} damage, {$this->health()} health power left");
      if ($this->health() <= 0) {
        $this->position = null;
        $this->say("dies");
      }
    }
  }

  public function is_alive() {
    return !is_null($this->position);
  }

  public function is_bound() {
    return $this->bound;
  }

  public function unbind() {
    $this->say("released from bonds");
    $this->bound = false;
  }

  public function bind() {
    $this->bound = true;
  }

  public function say($msg) {
    UI::puts_with_delay("{$this->name()} {$msg}");
  }

  public function name() {
    return get_class($this);
  }

  public function add_abilities($new_abbilities) {
    $this->abilities = array_merge($this->abilities, $new_abbilities);
  }

  public function abilities() {
    return $this->abilities;
  }

  public function character() {
    return '?';
  }
}
