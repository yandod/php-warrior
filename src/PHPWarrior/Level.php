<?php

namespace PHPWarrior;

class Level
{
    public $profile;
    public $number;

    public $description;
    public $tip;
    public $clue;
    public $warrior;
    public $floor;
    public $time_bonus;
    public $ace_score;

    public static function grade_letter($percent)
    {
        if ($percent >= 1.0) {
            return 'S';
        } elseif ($percent >= 0.9) {
            return 'A';
        } elseif ($percent >= 0.8) {
            return 'B';
        } elseif ($percent >= 0.7) {
            return 'C';
        } elseif ($percent >= 0.6) {
            return 'D';
        } else {
            return 'F';
        }
    }

    public function __construct($profile, $number)
    {
        $this->profile = $profile;
        $this->number = $number;
    }

    public function player_path()
    {
        return $this->profile->player_path();
    }

    public function load_path()
    {
        return $this->profile->tower_path . '/level_' . sprintf("%03d", $this->number) . '.php';
    }

    public function load_level()
    {
        $level_loader = new LevelLoader($this, $this->load_path());
    }

    public function load_player()
    {
        include_once $this->player_path() . '/player.php';
    }

    public function generate_player_files()
    {
        $this->load_level();
        $player_generator = new PlayerGenerator($this);
        return $player_generator->generate();
    }

    public function play($turns = 1000)
    {
        $this->load_level();
        foreach (range(0, $turns) as $n) {
            if ($this->is_passed() || $this->is_failed()) {
                return;
            }
            $num = $n + 1;
            UI::puts(sprintf(__("- turn %s -"), $num));
            UI::put($this->floor->character());
            foreach ($this->floor->units() as $unit) {
                $unit->prepare_turn();
            }
            foreach ($this->floor->units() as $unit) {
                $unit->perform_turn();
            }
            if ($this->time_bonus > 0) {
                $this->time_bonus -= 1;
            }
        }
    }

    public function tally_points()
    {
        $score = 0;

        UI::puts(sprintf(
            __("Level Score: %s"),
            $this->warrior->score
        ));
        $score += $this->warrior->score;

        UI::puts(sprintf(
            __("Time Bonus: %s"),
            $this->time_bonus
        ));
        $score += $this->time_bonus;

        if (count($this->floor->other_units()) == 0) {
            UI::puts(sprintf(
                __("Clear Bonus: %s"),
                $this->clear_bonus()
            ));
            $score += $this->clear_bonus();
        }

        if ($this->profile->is_epic()) {
            if ($this->grade_for($score)) {
                UI::puts(sprintf(
                    __("Level Grade: %s"),
                    $this->grade_for($score)
                ));
            }
            UI::puts(sprintf(
                __("Total Score: %s"),
                $this->score_calculation($this->profile->current_epic_score, $score)
            ));
            if ($this->ace_score) {
                $this->profile->current_epic_grades[$this->number] = ($score / $this->ace_score);
            }
            $this->profile->current_epic_score += $score;
        } else {
            UI::puts(sprintf(
                __("Total Score: %s"),
                $this->score_calculation($this->profile->score, $score)
            ));
            $this->profile->score += $score;
            $this->profile->abilities = array_keys($this->warrior->abilities);
        }
    }

    public function grade_for($score)
    {
        if ($this->ace_score) {
            return self::grade_letter($score / $this->ace_score);
        }
    }

    public function clear_bonus()
    {
        return round(($this->warrior->score + $this->time_bonus) * 0.2);
    }

    public function score_calculation($current_score, $addition)
    {
        if (empty($current_score)) {
            return $addition;
        } else {
            $total = $current_score + $addition;
            return "{$current_score} + {$addition} = {$total}";
        }
    }

    public function is_passed()
    {
        return $this->floor->stairs_space()->is_warrior();
    }

    public function is_failed()
    {
        return (array_search(
                $this->warrior,
                $this->floor->units()
            ) === false);
    }

    public function is_exists()
    {
        return file_exists($this->load_path());
    }

    public function setup_warrior($warrior)
    {
        $this->warrior = $warrior;
        $this->warrior->add_abilities($this->profile->abilities);
        $this->warrior->name = $this->profile->warrior_name;
        return $warrior;
    }

}
