<?php
//  -----
// |    S|
// |@> SC|
//  -----

$this->description(__('You can feel the stairs right next to you, but are you sure you want to go up them right away?'));
$this->tip(__('You\'ll get more points for clearing the level first. Use $warrior->feel()->is_stairs() and $warrior->feel()->is_empty() to determine where to go.'));
$this->clue(__("If going towards a unit is the same direction as the stairs, try moving another empty direction until you can safely move toward the enemies."));

$this->time_bonus(45);
$this->ace_score(107);
$this->size(5, 2);
$this->stairs(1, 1);

$this->warrior(0, 1, 'east');

$this->unit('thick_sludge', 4, 0, 'west');
$this->unit('thick_sludge', 3, 1, 'north');
$this->unit('captive', 4, 1, 'west');
