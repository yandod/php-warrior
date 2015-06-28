<?php
//  -----
// | sC >|
// |@ s C|
// | s   |
//  -----

$this->description(__('Another ticking sound, but some sludge is blocking the way.'));
$this->tip(__('Quickly kill the sludge and rescue the captive before the bomb goes off. You can\'t simply go around them.'));
$this->clue(__('Determine the direction of the ticking captive and kill any enemies blocking that path. You may need to bind surrounding enemies first.'));

$this->time_bonus(70);
$this->ace_score(134);
$this->size(5, 3);
$this->stairs(4, 0);

$this->warrior(0, 1, 'east');

$this->unit('sludge', 1, 0, 'south');
$this->unit('sludge', 1, 2, 'north');
$this->unit('sludge', 2, 1, 'west');
$this->unit('captive', 4, 1, 'west')->add_abilities(['explode'])
->abilities['explode']->time = 10;
$this->unit('captive', 2, 0, 'west');
