<?php
// --------
// |@   s  >|
//  --------

$this->description("It is too dark to see anything, but you smell sludge nearby.");
$this->tip("Use warrior.feel.empty? to see if there is anything in front of you, and warrior.attack! to fight it. Remember, you can only do one action (ending in !) per turn.");
$this->clue("Add an if/else condition using \$warrior->feel()->is_empty() to decide whether to \$warrior->attack() or \$warrior->walk().");

$this->time_bonus(20);
$this->ace_score(26);
$this->size(8, 1);
$this->stairs(7, 0);

$this->warrior(0, 0, ':east')->add_abilities(['feel', 'attack']);

$this->unit(':sludge', 4, 0, ':west');
