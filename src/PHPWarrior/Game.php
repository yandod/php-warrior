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
      $this->profile = $this->choose_profile();
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
      UI::puts("First level has been generated. See the phpwarrior/{$this->profile->directory_name()}/README for instructions.");
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

  public function profiles() {
    $map = [];
    foreach ($this->profile_paths() as $path) {
      $map[] = Profile::load($path);
    }
    return $map;
  }

  public function profile_paths() {
    return glob(Config::$path_prefix . '/phpwarrior/**/.profile');
  }

  public function new_profile() {
    $profile = new Profile();
    $profile->tower_path = UI::choose('tower', $this->towers())->path;
    $profile->warrior_name = UI::request('Enter a name for your warrior: ');
    return $profile;
  }

  public function towers() {
    $map = [];
    foreach ($this->tower_paths() as $path) {
      $map[] = new Tower($path);
    }
    return $map;
  }

  public function tower_paths() {
    return glob('./towers/*');
  }

  public function choose_profile() {
    $profile = UI::choose('profile', array_merge($this->profiles(),[[':new','New Profile']]));
    if (is_array($profile) && $profile[0] == ':new') {
      $profile = $this->new_profile();
    }
    /*
    if profile == :new
      profile = new_profile
      if profiles.any? { |p| p.player_path == profile.player_path }
        if UI.ask("Are you sure you want to replace your existing profile for this tower?")
          UI.puts "Replacing existing profile."
          profile
        else
          UI.puts "Not replacing profile."
          exit
        end
      else
        profile
      end
    else
      profile
    end
    */
    return $profile;
  }
}
