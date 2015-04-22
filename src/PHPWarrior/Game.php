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

  }
}
