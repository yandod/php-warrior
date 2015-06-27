<?php

namespace PHPWarrior\Abilities;


class Rescue extends Base {
  public function description() {
    return __("Rescue a captive from his chains (earning 20 points) in given direction (forward by default).");
  }

  public function perform($direction = 'forward') {
    $direction = \PHPWarrior\Position::normalize_direction($direction);
    $this->verify_direction($direction);
    if ($this->space($direction)->is_captive()) {
      $recipient = $this->unit($direction);
      $this->unit->say(sprintf(
        __("unbinds %$1s and rescues  %$2s"),
        __($direction),
        __($recipient)
      ));
      $recipient->unbind();
      if (is_a($recipient, 'PHPWarrior\Units\Captive')) {
        $recipient->position = null;
        $this->unit->earn_points(20);
      }
    } else {
      $this->unit->say(sprintf(
        __("unbinds %s and rescues nothing"),
        __($direction)
      ));
    }
  }
}
