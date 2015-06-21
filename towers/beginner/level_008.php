<?php
//  -------
// |@  Cww>|
//  -------

$this->description(__("You hear the mumbling of wizards. Beware of their deadly wands! Good thing you found a bow."));
$this->tip(__("Use warrior.look to determine your surroundings, and warrior.shoot! to fire an arrow."));
$this->clue(__("Wizards are deadly but low in health. Kill them before they have time to attack."));

$this->time_bonus(20);
$this->ace_score(46);
$this->size(6, 1);
$this->stairs(5, 0);

$this->warrior(0, 0, 'east')->add_abilities(['look','shoot']);

$this->unit('captive', 2, 0, 'west');
$this->unit('wizard', 3, 0, 'west');
$this->unit('wizard', 4, 0, 'west');
