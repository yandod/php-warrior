<?php

namespace PHPWarrior;

class Level {
  public $profile;
  public $number;

  public $description;
  public $tip;
  public $clue;
  public $warrior;
  public $floor;
  public $time_bonus;
  public $ace_score;

  public function __construct($profile, $number) {
      $this->profile = $profile;
      $this->number = $number;
  }

  public function load_path() {
    return './towers/' . $this->profile->tower_path . '/level_' . sprintf("%03d", $this->number) . '.php';
  }

  public function load_level() {
    $level_loader = new LevelLoader($this, $this->load_path());
  }

  public function generate_player_files() {
    $this->load_level();
    //$player_generator = new PlayerGenerator($this);
    //return $player_generator->generate();
  }

  public function setup_warrior($warrior) {
    $this->warrior = $warrior;
    $this->warrior->add_abilities($this->profile->abilities);
    $this->warrior->name = $this->profile->warrior_name;
    return $warrior;
  }

}
