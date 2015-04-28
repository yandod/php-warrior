<?php

namespace PHPWarrior\Units;


class Warrior extends Base {

  public function __construct() {
    $this->score = 0; # TODO make score dynamic
    $this->golem_abilities = [];
  }

  public function play_turn($turn) {
    $this->player()->play_turn($turn);
  }

  public function player() {
    if (!$this->player) {
      $this->player = new \Player();
    }
    return $this->player;
  }

  public function earn_points($points) {
    $this->score += $points;
    $this->say("earns {$points} points");
  }

  public function attack_power() {
    return 5;
  }

  public function shoot_power() {
    return 3;
  }

  public function max_health() {
    return 20;
  }

  public function name() {
    if ($this->name && !empty($this->name)) {
      return $this->name;
    }  else {
      return 'Warrior';
    }
  }

  public function character() {
    return '@';
  }

  public function perform_turn() {
    if (is_null($this->current_turn->action)) {
      $this->say("does nothing");
    }
    return parent::perform_turn();
  }
}
