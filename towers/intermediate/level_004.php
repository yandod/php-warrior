<?php
//  ----
// |C s |
// | @ S|
// |C s>|
//  ----

$this->description(__('Your ears become more in tune with the surroundings. Listen to find enemies and captives!'));
$this->tip(__('Use $warrior->listen() to find spaces with other units, and $warrior->direction_of() to determine what direction they\'re in.'));
$this->clue(__('Walk towards an enemy or captive with $warrior->walk($warrior->direction_of($warrior->listen()[0])), once empty($warrior->listen()) then head for the stairs.'));

$this->time_bonus(55);
$this->ace_score(144);
$this->size(4, 3);
$this->stairs(3, 2);

$this->warrior(1, 1, 'east')->add_abilities(['listen', 'direction_of']);

$this->unit('captive', 0, 0, 'east');
$this->unit('captive', 0, 2, 'east');
$this->unit('sludge', 2, 0, 'south');
$this->unit('thick_sludge', 3, 1, 'west');
$this->unit('sludge', 2, 2, 'north');
