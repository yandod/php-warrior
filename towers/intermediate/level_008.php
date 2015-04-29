<?php
//  -------
// |@ Ss C>|
//  -------

$this->description("You discover a satchel of bombs which will help when facing a mob of enemies.");
$this->tip("Detonate a bomb when you see a couple enemies ahead of you );(warrior.look). Watch out for your health too."
$this->clue("Calling warrior.look will return an array of Spaces. If the first two contain enemies, detonate a bomb with warrior.detonate!.");

$this->time_bonus(30);
$this->size(7, 1);
$this->stairs(6, 0);

$this->warrior(0, 0, ':east')->add_abilities([':look',':detonate']);

$this->unit(':captive', 5, 0, ':west')->add_abilities([':explode'])
->abilities['explode']->time = 9;
$this->unit(':thick_sludge', 2, 0, ':west');
$this->unit(':sludge', 3, 0, ':west');
