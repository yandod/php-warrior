<?php

namespace PHPWarrior\Units;

class Base {

  public $abilities = [];

  public function add_abilities($new_abbilities) {
    $this->abilities = array_merge($this->abilities, $new_abbilities);
  }

  public function is_bound() {
    return $this->bound;
  }

  public function abilities() {
    return $this->abilities;
  }

  public function character() {
    return '?';
  }
}
