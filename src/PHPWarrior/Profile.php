<?php

namespace PHPWarrior;


class Profile {
  public $score;
  public $epic_score;
  public $current_epic_score;
  public $average_grade;
  public $current_epic_grades;
  public $abilities;
  public $level_number = 0;
  public $last_level_number;
  public $tower_path;
  public $warrior_name;
  public $player_path;

  public function encode() {

  }

  public function save() {

  }

  public function decode($str) {

  }

  public static function load() {
    $profile = new Profile();
    return $profile;
  }

  public function player_path() {

  }

  public function directory_name() {
    return null; //[warrior_name.downcase.gsub(/[^a-z0-9]+/, '-'), tower.name].join('-')
  }

  public function current_level() {
    return new Level($this, $this->level_number);
  }

  public function next_level() {
    return new Level($this, $this->level_number + 1);
  }
}
