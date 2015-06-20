<?php

namespace PHPWarrior\Abilities;

class Rest extends Base {
  public function description() {
    return __('Gain 10% of max health back, but do nothing more.');
  }

  public function perform() {
    if ($this->unit->health() < $this->unit->max_health()) {
      $amount = round($this->unit->max_health()*0.1);
      if ( ($this->unit->health + $amount) > $this->unit->max_health() ) {
        $amount = $this->unit->max_health() - $this->unit->health;
      }
      $this->unit->health += $amount;
      $this->unit->say(sprintf(
        __('receives %1$s health from resting, up to %2$s health'),
        $amount,
        $this->unit->health()
      ));
    } else {
      $this->unit->say(__('is already fit as a fiddle'));
    }
  }
}
