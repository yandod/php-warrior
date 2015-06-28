<?php
//  ------
// |Cs   >|
// |@  sC |
//  ------

$this->description(__('What\'s that ticking? Some captives have a timed bomb at their feet!'));
$this->tip(__('Hurry and rescue captives first that have space->is_ticking(), they\'ll soon go!'));
$this->clue(__('Avoid fighting enemies at first. Use $warrior->listen() and space->is_ticking() and quickly rescue those captives.'));

$this->time_bonus(50);
$this->ace_score(108);
$this->size(6, 2);
$this->stairs(5, 0);

$this->warrior(0, 1, ':east');

$this->unit('sludge', 1, 0, 'west');
$this->unit('sludge', 3, 1, 'west');
$this->unit('captive', 0, 0, 'west');
$this->unit('captive', 4, 1, 'west')->add_abilities(['explode'])
->abilities['explode']->time = 7;
