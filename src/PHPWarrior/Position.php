<?php

namespace PHPWarrior;

class Position {

  public $floor;
  public $DIRECTIONS = [':north', ':east', ':south', ':west'];
  public $RELATIVE_DIRECTIONS = [':forward', ':right', ':backward', ':left'];

  public function initialize($floor, $x, $y, $direction = null) {
    $this->floor = $floor;
    $this->x = $x;
    $this->y = $y;
    $this->direction_index = array_search(
      is_null($direction) ? ':north' : $direction,
      $this->DIRECTIONS
    );
  }

  public function is_at($x, $y) {
    return ($this->x == $x && $this->y == $y);
  }

  public function direction() {
    return $this->DIRECTIONS[$this->direction_index];
  }

  public function rotate($amount) {
    $this->direction_index += $amount;
    while ($this->direction_index > 3) {
      $this->direction_index -= 4;
    }
    while ($this->direction_index < 0) {
      $this->direction_index += 4;
    }
  }

  public function relative_space($forward, $right = 0) {
    return $this->floor->space($this->translate_offset($forward, $right));
  }

  public function space() {
    return $this->floor->space($this->x, $this->y);
  }

  public function move($forward, $right = 0) {
    list($this->x, $this->y) = $this->translate_offset($forward, $right);
  }

  public function distance_from_stairs() {
    return $this->distance_of($this->floor->stairs_space());
  }

  public function distance_of($space) {
    list ($x, $y) = $space->location();
    return abs($this->x - $x) + abs($this->y - $y);
  }

  public function relative_direction_of_stairs() {
    return $this->relative_direction_of($this->floor->stairs_space());
  }

  public function relative_direction_of($space) {
    return $this->relative_direction($this->direction_of($space));
  }

  public function direction_of($space) {
    list ($space_x, $space_y) = $this->space->location();
    if (abs($this->x - $space_x) > abs($this->y - $space_y)) {
      return $space_x > $this->x ? ':east' : ':west';
    } else {
      return $space_y > $this->y ? ':south' : ':north';
    }
  }

  public function relative_direction($direction) {
    $offset = array_search($direction,$this->DIRECTIONS) - $this->direction_index;
    while ($offset > 3) {
      $offset -= 4;
    }
    while ($offset < 0) {
      $offset += 4;
    }
    return $this->RELATIVE_DIRECTIONS[$offset];
  }

  public function translate_offset($forward, $right) {
    switch ($direction) {
      case ':north':
        return [$this->x + $right, $this->y - $forward];
        break;
      case ':east':
        return [$this->x + $forward, $this->y + $right];
        break;
      case ':south':
        return [$this->x - $right, $this->y + $forward];
        break;
      case ':west':
        return [$this->x - $forward, $this->y - $right];
        break;
    }
  }
}
