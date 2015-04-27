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

  public function player_path() {
    return $this->profile->player_path();
  }

  public function load_path() {
    return $this->profile->tower_path . '/level_' . sprintf("%03d", $this->number) . '.php';
  }

  public function load_level() {
    $level_loader = new LevelLoader($this, $this->load_path());
  }

  public function load_player() {
    include $this->player_path() . '/player.php';
  }

  public function generate_player_files() {
    $this->load_level();
    $player_generator = new PlayerGenerator($this);
    return $player_generator->generate();
  }

  public function play($turns = 1000) {
    $this->load_level();
    foreach(range(0,$turns) as $n) {
      if ($this->is_passed() || $this->is_failed()) {
        return;
      }
      $num = $n+1;
      UI::puts("- turn {$num} -");
      UI::put($this->floor->character());
      foreach ($this->floor->units() as $unit) {
        $unit->prepare_turn();
      }
      foreach ($this->floor->units() as $unit) {
        $unit->perform_turn();
      }
      if ($this->time_bonus > 0) {
        $this->time_bonus -= 1;
      }
    }
  }

  public function is_passed() {
    return $this->floor->stairs_space()->is_warrior();
  }

  public function is_failed() {
    return (array_search(
      $this->warrior,
      $this->floor->units()
    ) === false);
  }

  public function is_exists() {
    return file_exists($this->load_path());
  }

  public function setup_warrior($warrior) {
    $this->warrior = $warrior;
    $this->warrior->add_abilities($this->profile->abilities);
    $this->warrior->name = $this->profile->warrior_name;
    return $warrior;
  }

}
