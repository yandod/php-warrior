<?php
//  -----------
// |>Ca  @ S wC|
//  -----------

$this->description("Time to hone your skills and apply all of the abilities that you have learned.");
$this->tip("Watch your back.");
$this->clue("Don't just keep shooting the bow while you are being attacked from behind.");

$this->time_bonus(40);
$this->ace_score(100);
$this->size(11, 1);
$this->stairs(0, 0);

$this->warrior(5, 0, ':east');

$this->unit(':captive', 1, 0, ':east');
$this->unit(':archer', 2, 0, ':east');
$this->unit(':thick_sludge', 7, 0, ':west');
$this->unit(':wizard', 9, 0, ':west');
$this->unit(':captive', 10, 0, ':west');
