<?php
//  -------
// |@ Sa S>|
//  -------

$this->description('You can hear bow strings being stretched.');
$this->tip('No new abilities this time, but you must be careful not to rest while taking damage. Save a @health instance variable and compare it on each turn to see if you\re taking damage.');
$this->clue('Set $this->health to your current health at the end of the turn. If this is greater than your current health next turn then you know you\'re taking damage and shouldn\'t rest.');

$this->time_bonus(45);
$this->ace_score(90);
$this->size(7, 1);
$this->stairs(6, 0);

$this->warrior(0, 0, ':east');

$this->unit(':thick_sludge', 2, 0, ':west');
$this->unit(':archer', 3, 0, ':west');
$this->unit(':thick_sludge', 5, 0, ':west');
