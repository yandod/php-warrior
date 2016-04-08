<?php
namespace PHPWarrior;

/**
 * Class PlayerGenerator
 * 
 * @package PHPWarrior
 */
class PlayerGenerator
{

    public $level;
    public $previous_level;

    /**
     * Class constrictor.
     *
     * @param $level
     */
    public function __construct($level)
    {
        $this->level = $level;
    }

    /**
     * Previous level.
     *
     * @return Level
     */
    public function previous_level()
    {
        if (!$this->previous_level) {
            $this->previous_level = new Level(
                $this->level->profile,
                $this->level->number - 1
            );
        }
        return $this->previous_level;
    }

    /**
     * Generate.
     */
    public function generate()
    {
        if ($this->level->number == 1) {
            if (!file_exists($this->level->player_path())) {
                mkdir($this->level->player_path(), 0777, true);
            }
            copy($this->template_path() . '/player.php', $this->level->player_path() . '/player.php');
        }

        file_put_contents(
            $this->level->player_path() . '/README',
            $this->read_template($this->template_path() . '/README.php')
        );
    }

    /**
     * Template path
     *
     * @return string
     */
    public function template_path()
    {
        return realpath(__DIR__ . '/../../templates');
    }

    /**
     * @param  $path
     * @return string
     */
    public function read_template($path)
    {
        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
