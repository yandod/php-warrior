<?php
//  --------
// |@      >|
//  --------

$this->description(__("You see before yourself a long hallway with stairs at the end. There is nothing in the way."));
$this->tip(__("Call \$warrior->walk() to walk forward in the Player 'play_turn' method."));


$this->time_bonus(15);
$this->ace_score(10);
$this->size(8, 1);
$this->stairs(7, 0);

$this->warrior(0, 0, ':east')->add_abilities(['walk']);
