<?php
//  ----
// |@s  |
// | sS>|
//  ----

$this->description("Another large room, but with several enemies blocking your way to the stairs.");
$this->tip("Just like walking, you can attack! and feel in multiple directions (:forward, :left, :right, :backward).");
$this->clue("Call warrior.feel(direction).enemy? in each direction to make sure there isn't an enemy beside you (attack if there is). Call warrior.rest! if you're low and health when there are no enemies around.");

$this->time_bonus(40);
$this->ace_score(84);
$this->size(4, 2);
$this->stairs(3, 1);

$this->warrior(0, 0, ':east')->add_abilities(['attack', 'health', 'rest']);

$this->unit(':sludge', 1, 0, ':west');
$this->unit(':thick_sludge', 2, 1, ':west');
$this->unit(':sludge', 1, 1, ':north');
