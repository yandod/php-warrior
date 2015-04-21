<?php

namespace PHPWarrior;

class Runner {

  public function __construct( $arguments, $stdin, $stdout ) {
    $this->arguments = $arguments;
    $this->stdin = $stdin;
    $this->stdout = $stdout;
    $this->game = new Game();
  }

  public function run() {
    Config::$in_stream = $this->stdin;
    Config::$out_stream = $this->stdout;
    Config::$delay = 0.6;
    $this->game->start();
  }
}
