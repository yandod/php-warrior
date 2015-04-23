<?php

namespace PHPWarrior;

class Game {

  public $profile;

  public function start() {
    UI::puts('Welcome to PHP Warrior');

    if (file_exists(Config::$path_prefix . '/.profile')) {
      $this->profile = Profile::load(Config::$path_prefix . '/.profile');
    } elseif (!is_dir(Config::$path_prefix . '/phpwarrior')) {
      $this->make_game_directory();
    } else {
      $this->profile = new Profile();
    }

    $this->play_normal_mode();
  }

  public function make_game_directory() {
    if (UI::ask('No phpwarrior directory found, would you like to create one?')) {
      mkdir(Config::$path_prefix . '/phpwarrior');
    } else {
      UI::puts('Unable to continue without directory.');
      exit;
    }
  }

  public function play_normal_mode() {
    if ($this->profile->current_level()->number == 0) {
      $this->prepare_next_level();
      UI::puts("First level has been generated. See the rubywarrior/{$this->profile->directory_name()}/README for instructions.");
    } else {
      $this->play_current_level();
    }
  }

  public function play_current_level() {

  }

  public function prepare_next_level() {
    $this->profile->next_level()->generate_player_files();
    $this->profile->level_number += 1;
    $this->profile->save(); // this saves score and new abilities too
  }
}
