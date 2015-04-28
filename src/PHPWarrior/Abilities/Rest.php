<?php

namespace PHPWarrior\Abilities;

class Rest extends Base {
  public function description() {
    return 'Gain 10% of max health back, but do nothing more.';
  }

  public function perform() {
    if ($this->unit->health() < $this->unit->max_health()) {
      $amount = round($this->unit->max_health()*0.1);
      if ( ($this->unit->health + $amount) > $this->unit->max_health() ) {
        $amount = $this->unit->max_health() - $unit->health;
      }
      $this->unit->health += $amount;
      $this->unit->say("receives {$amount} health from resting, up to {$this->unit->health()} health");
    } else {
      $this->unit->say('is already fit as a fiddle');
    }
  }
}
