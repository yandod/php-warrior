<?php

namespace PHPWarrior\Abilities;


class Rescue extends Base {
  public function description() {
    return "Rescue a captive from his chains (earning 20 points) in given direction (forward by default).";
  }

  public perform($direction = ':forward') {
    $this->verify_direction($direction);
    if ($this->space($direction)->is_captive()) {
      $recipient = $this->unit($direction);
      $this->unit->say("unbinds {$direction} and rescues {$recipient}");
      $recipient->unbind();
      if (is_a($recipient, 'PHPWarrior\Units\Captive')) {
        $recipient->position = null;
        $this->unit->earn_points(20);
      }
    } else {
      $this->unit->say("unbinds {$direction} and rescues nothing");
    }
  }
}
