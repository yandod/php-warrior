<?php
use \Ulrichsg\Getopt\Getopt;
use \Ulrichsg\Getopt\Option;

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
    $this->parse_options();
    $this->game->start();
  }

  public function parse_options() {
    $getopt = new \Ulrichsg\Getopt\Getopt([
      ['d', 'directory', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT,'Run under given directory'],
      ['l', 'level', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Practice level on epic'],
      ['s', 'skip', \Ulrichsg\Getopt\Getopt::NO_ARGUMENT, 'Skip user input'],
      ['t', 'time', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Delay each turn by seconds'],
      ['h', 'help', \Ulrichsg\Getopt\Getopt::NO_ARGUMENT, 'Show this message'],
    ]);
    try {
      $getopt->parse();
    } catch (\Exception $e) {
      echo $e->getMessage() . "\n";
      exit;
    }
    if ($getopt->getOption('h')) {
      echo $getopt->getHelpText();
      exit;
    }
    if ($getopt->getOption('d')) {
      Config::$path_prefix = $getopt->getOption('d');
    }
    if ($getopt->getOption('l')) {
      Config::$practice_level = $getopt->getOption('l');
    }
    if ($getopt->getOption('s')) {
      Config::$skip_input = true;
    }
    if ($getopt->getOption('t')) {
      Config::$delay = $getopt->getOption('t');
    }
  }
}
