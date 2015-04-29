<?php
//  ------
// |      |
// |@     |
// |      |
// |  >   |
//  ------

$this->description("Silence. The room feels large, but empty. Luckily you have a map of this tower to help find the stairs.");
$this->tip("Use warrior.direction_of_stairs to determine which direction stairs are located. Pass this to warrior.walk! to walk in that direction.");

$this->time_bonus(20);
$this->ace_score(19);
$this->size(6, 4);
$this->stairs(2, 3);

$this->warrior(0, 1, ':east')->add_abilities([':walk', ':feel', ':direction_of_stairs']);
