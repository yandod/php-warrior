<?php
use \Ulrichsg\Getopt\Getopt;
use \Ulrichsg\Getopt\Option;
use \Gettext\Translator;

namespace PHPWarrior;

class Runner
{

    public function __construct($arguments, $stdin, $stdout)
    {
        $this->arguments = $arguments;
        $this->stdin = $stdin;
        $this->stdout = $stdout;
        $this->game = new Game();
    }

    public function run()
    {
        Config::$in_stream = $this->stdin;
        Config::$out_stream = $this->stdout;
        Config::$delay = 0.6;
        $this->parse_options();
        $this->load_translation();
        $this->game->start();
    }

    public function parse_options()
    {
        $getopt = new \Ulrichsg\Getopt\Getopt([
            ['d', 'directory', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Run under given directory'],
            ['l', 'level', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Practice level on epic'],
            ['s', 'skip', \Ulrichsg\Getopt\Getopt::NO_ARGUMENT, 'Skip user input'],
            ['t', 'time', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Delay each turn by seconds'],
            ['L', 'locale', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT, 'Specify locale like en_US'],
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
        if (!is_null($getopt->getOption('t'))) {
            Config::$delay = $getopt->getOption('t');
        }
        // get locale from $LANG like en_US.UTF8
        list(Config::$locale) = explode('.', getenv('LANG'));
        if ($getopt->getOption('L')) {
            Config::$locale = $getopt->getOption('L');
        }
    }

    public function load_translation()
    {
        $translator = new \Gettext\Translator();
        $i18n_path = realpath(__DIR__ . '/../../i18n/' . Config::$locale . '.po');
        if (file_exists($i18n_path)) {
            $translations = \Gettext\Translations::fromPoFile($i18n_path);
            $translator->loadTranslations($translations);
        }
        \Gettext\Translator::initGettextFunctions($translator);
    }
}
