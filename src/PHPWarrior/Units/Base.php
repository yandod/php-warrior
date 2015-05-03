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
    \PHPWarrior\UI::puts_with_delay("{$this->name()} {$msg}");
  }

  public function name() {
    return array_pop(explode('\\',get_class($this)));
  }

  public function __ToString(){
    return $this->name();
  }

  public function add_abilities($new_abbilities) {
    foreach ($new_abbilities as $abbility_str) {
      $camel = '';
      $abbility_str = str_replace(':', '', $abbility_str);
      foreach(explode('_', $abbility_str) as $str)  {
        $camel .= ucfirst($str);
      }
      $class_name = 'PHPWarrior\Abilities\\' . $camel;
      $this->abilities[$abbility_str] = new $class_name($this);
    }
    return $this;
  }

  public function next_turn() {
    return new \PHPWarrior\Turn($this->abilities());
  }

  public function prepare_turn() {
    $this->current_turn = $this->next_turn();
    return $this->play_turn($this->current_turn);
  }

  public function perform_turn() {
    if ($this->position) {
      foreach ($this->abilities as $ability) {
        $ability->pass_turn();
      }
      if ($this->current_turn->action && !$this->is_bound()) {
        list ($name, $args) = $this->current_turn->action;
        call_user_func_array([$this->abilities[$name], 'perform'], $args);
        //$this->abilities[$name]->perform($args);
      }
    }
  }

  public function play_turn($turn) {
    # to be overriden by subclass
  }

  public function abilities() {
    return $this->abilities;
  }

  public function character() {
    return '?';
  }
}
