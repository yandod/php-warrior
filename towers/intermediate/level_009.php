<?php
//  ----
// |ssC>|
// |@sss|
// |ssC |
//  ----

$this->description(__('Never before have you seen a room so full of sludge. Start the fireworks!'));
$this->tip(__('Be careful not to let the ticking captive get caught in the flames. Use $warrior->distance_of() to avoid the captives.'));
$this->clue(__('Be sure to bind the surrounding enemies before fighting. Check your health before detonating explosives.'));

$this->time_bonus(70);
$this->size(4, 3);
$this->stairs(3, 0);

$this->warrior(0, 1, 'east')->add_abilities(['distance_of']);

$this->unit('captive', 2, 0, 'south')->add_abilities(['explode'])
->abilities['explode']->time = 20;
$this->unit('captive', 2, 2, 'north');

$this->unit('sludge', 0, 0, 'south');
$this->unit('sludge', 1, 0, 'south');
$this->unit('sludge', 1, 1, 'east');
$this->unit('sludge', 2, 1, 'east');
$this->unit('sludge', 3, 1, 'east');
$this->unit('sludge', 0, 2, 'north');
$this->unit('sludge', 1, 2, 'north');
