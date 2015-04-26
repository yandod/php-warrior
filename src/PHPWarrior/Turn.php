<?php

namespace PHPWarrior;

class Turn {

  public $action = null;
  public $senses = [];
  public $abilities;

  public function __construct($abilities) {
    $this->abilities = $abilities;
  }

  public function __call($name, $arguments) {
    if ($this->action) {
      throw new Exception("Only one action can be performed per turn.");
    }
    $this->action = [$name, $arguments];
    //@senses[:#{name}].perform(*args)
  }
}
