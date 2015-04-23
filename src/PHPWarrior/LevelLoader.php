<?php

namespace PHPWarrior;

class LevelLoader {
  public function __construct($level, $load_path) {
    $this->floor = new Floor();
    $this->level = $level;
    $this->level->floor = $this->floor;
    include $load_path;
  }
}
