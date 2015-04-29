<?php
//  ---
// |>s |
// |s@s|
// | C |
//  ---

$this->description("You feel slime on all sides, you're surrounded!");
$this->tip("Call warrior.bind!);(direction) to bind an enemy to keep him from attacking. Bound enemies look like captives."
$this->clue("Count the number of enemies around you. Bind an enemy if there are two or more.");

$this->time_bonus(50);
$this->ace_score(101);
$this->size(3, 3);
$this->stairs(0, 0);

$this->warrior(1, 1, ':east')->add_abilities([':rescue', ':bind']);

$this->unit(':sludge', 1, 0, ':west');
$this->unit(':captive', 1, 2, ':west');
$this->unit(':sludge', 0, 1, ':west');
$this->unit(':sludge', 2, 1, ':west');
