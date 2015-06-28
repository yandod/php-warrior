
<?php
//  --------
// |C @ S aa|
//  --------

$this->description(__('The wall behind you feels a bit further away in this room. And you hear more cries for help.'));
$this->tip(__('You can walk backward by passing \'backward\' as an argument to walk(). Same goes for feel(), rescue() and attack(). Archers have a limited attack distance.'));
$this->clue(__('Walk backward if you are taking damage from afar and do not have enough health to attack. You may also want to consider walking backward until $warrior->feel(\'backward\')->is_wall().'));

$this->time_bonus(55);
$this->ace_score(105);
$this->size(8, 1);
$this->stairs(7, 0);

$this->warrior(2, 0, 'east');

$this->unit('captive', 0, 0, 'east');
$this->unit('thick_sludge', 4, 0, 'west');
$this->unit('archer', 6, 0, 'west');
$this->unit('archer', 7, 0, 'west');
