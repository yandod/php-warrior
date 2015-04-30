<?php

namespace PHPWarrior;


class Profile {
  public $score;
  public $epic_score;
  public $current_epic_score;
  public $average_grade;
  public $current_epic_grades;
  public $abilities = [];
  public $level_number = 0;
  public $last_level_number;
  public $tower_path = '';
  public $warrior_name;
  public $player_path;
  public $tower;

  public static function encode($obj) {
    return serialize($obj);
  }

  public function save() {
    // update_epic_score
    // @level_number = 0 if epic?
    file_put_contents($this->player_path() . '/.profile', self::encode($this));
  }

  public static function decode($str) {
    return unserialize($str);
  }

  public static function load($path) {
    $profile = self::decode(file_get_contents($path));
    return $profile;
  }

  public function player_path() {
    if (!$this->player_path) {
      $this->player_path = Config::$path_prefix . '/phpwarrior/' . $this->directory_name();
    }
    return $this->player_path;
  }

  public function directory_name() {
    return implode(
      '-',
      [strtolower($this->warrior_name), $this->tower()->name()]
    );
  }

  public function __ToString() {
    return implode('-', [
      $this->warrior_name,
      $this->tower->name(),
      "Level ".$this->level_number,
      "score ".$this->score
    ]);
  }

  public function tower() {
    if (!$this->tower) {
      $this->tower = new Tower($this->tower_path);
    }
    return $this->tower;
  }

  public function current_level() {
    return new Level($this, $this->level_number);
  }

  public function next_level() {
    return new Level($this, $this->level_number + 1);
  }
}
