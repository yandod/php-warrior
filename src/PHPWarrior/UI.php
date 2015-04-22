<?php

namespace PHPWarrior;

class UI {
  public static function puts($msg) {
    if (Config::$out_stream) {
      fwrite(Config::$out_stream, $msg . PHP_EOL);
    }
  }

  public static function ask($msg) {
    fwrite(Config::$out_stream, $msg . ' [yn] ');
    if (trim(fgets(Config::$in_stream)) === 'y') {
      return true;
    }
    return false;
  }
}
