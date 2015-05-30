<?php
//  ---------
// |@ s ss s>|
//  ---------

$this->description('The air feels thicker than before. There must be a horde of sludge.');
$this->tip('Be careful not to die! Use warrior.health to keep an eye on your health, and warrior.rest! to earn 10% of max health back.');
$this->clue('When there is no enemy ahead of you call \$warrior->rest() until health is full before walking forward.');

$this->time_bonus(35);
$this->ace_score(71);
$this->size(9, 1);
$this->stairs(8, 0);

$this->warrior(0, 0, ':east')->add_abilities(['health', 'rest']);

$this->unit(':sludge', 2, 0, ':west');
$this->unit(':sludge', 4, 0, ':west');
$this->unit(':sludge', 5, 0, ':west');
$this->unit(':sludge', 7, 0, ':west');
