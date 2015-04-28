<?php

namespace PHPWarrior;

class Floor {

  public $width = 0;
  public $height = 0;
  public $units = [];
  public $stairs_location = [-1, -1];

  public function add($unit, $x, $y, $direction = null) {
    $this->units[] = $unit;
    $unit->position = new Position($this, $x, $y, $direction);
  }

  public function place_stairs($x, $y) {
    $this->stairs_location = [$x, $y];
  }

  public function stairs_space() {
    return call_user_func_array(
      [$this, 'space'],
      $this->stairs_location
    );
  }

  public function units() {
    // todo? filter null
    return array_filter(
      $this->units,
      function($v) { return !is_null($v->position);}
    );
  }

  public function other_units() {
    return array_filter($this->units, function($v) {is_a($v, 'PHPWarrior\Units\Warrior');});
  }

  public function get($x, $y) {
    foreach ($this->units as $v) {
      if (!is_null($v->position) && $v->position->is_at($x, $y)) {
        return $v;
      }
    }
  }

  public function space($x, $y) {
    return new Space($this, $x, $y);
  }

  public function is_out_of_bounds($x, $y) {
    return (
      $x < 0 ||
      $y < 0 ||
      $x > ($this->width - 1) ||
      $y > ($this->height - 1)
    );
  }

  public function character() {
    $rows = [];
    $rows[] = ' ' . str_repeat('-', $this->width);
    for ($y=0; $y<$this->height; $y++) {
      $row = '|';
      for ($x=0; $x<$this->width; $x++) {
        $row .= $this->space($x, $i)->character();
      }
      $row .= '|';
      $rows[] = $row;
    }
    $rows[] = ' ' . str_repeat('-', $this->width);
    return implode("\n", $rows) . "\n";
  }

  public function unique_units() {
    $unique_units = [];
    foreach ($this->units as $u) {
      $unique_units[] = $u;
    }
    return $unique_units;
  }
}
