<?php

namespace PHPWarrior;

class UI {
  public static function puts($msg) {
    if (Config::$out_stream) {
      fwrite(Config::$out_stream, $msg . PHP_EOL);
    }
  }
}
