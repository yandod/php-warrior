<?php

namespace PHPWarrior;


class Profile {
  public $score;
  public $epic = false;
  public $epic_score;
  public $current_epic_score;
  public $average_grade;
  public $current_epic_grades = [];
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

  public function epic_score_with_grade() {
    if ($this->average_grade) {
      $letter = Level::grade_letter($this->average_grade);
      return "{$this->epic_score} ({$letter})";
    } else {
      return epic_score;
    }
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

  public function enable_epic_mode() {
    $this->epic = true;
    $this->epic_score = 0;
    $this->current_epic_score = 0;
    $this->last_level_number = $this->level_number;
  }

  public function enable_normal_mode() {
    $this->epic = false;
    $this->epic_score = 0;
    $this->current_epic_score = 0;
    $this->current_epic_grades = [];
    $this->average_grade = null;
    $this->level_number = $this->last_level_number;
    $this->last_level_number = null;
  }

  public function is_epic() {
    return $this->epic;
  }

  public function is_level_after_epic() {
    if ($this->last_level_number) {
      $level = new Level(
        $this,
        $this->last_level_number+1
      );
      return $level->is_exists();
    }
    return false;
  }

  public function update_epic_score() {
    if ($this->current_epic_score > $this->epic_score) {
      $this->epic_score = $this->current_epic_score;
      $this->average_grade = $this->calculate_average_grade();
    }
  }

  public function calculate_average_grade() {
    if (count($this->current_epic_grades) > 0) {
      $sum = array_sum($this->current_epic_grades);
      return $sum / count($this->current_epic_grades);
    }
  }
}
