<?php
//  -------
// |@ CaaSC|
//  -------

$this->description(__('You hear cries for help. Captives must need rescuing.'));
$this->tip(__('Use $warrior->feel()->is_captive() to see if there is a captive and $warrior->rescue() to rescue him. Don\'t attack captives.'));
$this->clue(__('Don\'t forget to constantly check if you\'re taking damage. Rest until your health is full if you aren\'t taking damage.'));

$this->time_bonus(45);
$this->ace_score(123);
$this->size(7, 1);
$this->stairs(6, 0);

$this->warrior(0, 0, 'east')->add_abilities(['rescue']);


$this->unit('captive', 2, 0, 'west');
$this->unit('archer', 3, 0, 'west');
$this->unit('archer', 4, 0, 'west');
$this->unit('thick_sludge', 5, 0, 'west');
$this->unit('captive', 6, 0, 'west');
