<?php

namespace PHPWarrior\Units;

class Base
{

    public $position;
    public $abilities = [];
    public $bound;

    /**
     * The attack power in the base.
     *
     * @return int, Attack power
     */
    public function attack_power()
    {
        return 0;
    }

    /**
     * Maximum health.
     *
     * @return int
     */
    public function max_health()
    {
        return 0;
    }

    /**
     * Earn points.
     *
     * @param $points
     */
    public function earn_points($points)
    {
    }

    /**
     * Health.
     *
     * @return int
     */
    public function health()
    {
        if (!isset($this->health)) {
            $this->health = $this->max_health();
        }
        return $this->health;
    }

    /**
     * Take damage.
     *
     * @param $amount
     */
    public function take_damage($amount)
    {
        if ($this->is_bound()) {
            $this->unbind();
        }
        if ($this->health()) {
            $this->health -= $amount;
            $this->say(sprintf(
                __('takes %1$s damage, %2$s health power left'),
                $amount,
                $this->health()
            ));
            if ($this->health() <= 0) {
                $this->position = null;
                $this->say(__("dies"));
            }
        }
    }

    /**
     * Is unit alive?
     *
     * @return bool
     */
    public function is_alive()
    {
        return !is_null($this->position);
    }

    /**
     * is_bound?
     *
     * @return mixed
     */
    public function is_bound()
    {
        return $this->bound;
    }

    /**
     * Unbind
     */
    public function unbind()
    {
        $this->say(__("released from bonds"));
        $this->bound = false;
    }

    /**
     * bind.
     */
    public function bind()
    {
        $this->bound = true;
    }

    /**
     * Say a message.
     *
     * @param $msg
     */
    public function say($msg)
    {
        \PHPWarrior\UI::puts_with_delay("{$this->name()} {$msg}");
    }

    /**
     * name.
     *
     * @return mixed
     */
    public function name()
    {
        $slice_name = explode('\\', get_class($this));
        return array_pop($slice_name);
    }

    /**
     * __ToString function.
     *
     * @return mixed
     */
    public function __ToString()
    {
        return __($this->name());
    }

    /**
     * Add some abilties.
     *
     * @param $new_abbilities
     * @return $this
     */
    public function add_abilities($new_abbilities)
    {
        foreach ($new_abbilities as $abbility_str) {
            $camel = '';
            $abbility_str = str_replace(':', '', $abbility_str);
            foreach (explode('_', $abbility_str) as $str) {
                $camel .= ucfirst($str);
            }
            $class_name = 'PHPWarrior\Abilities\\' . $camel;
            $this->abilities[$abbility_str] = new $class_name($this);
        }
        return $this;
    }

    /**
     * Next turn.
     *
     * @return \PHPWarrior\Turn
     */
    public function next_turn()
    {
        return new \PHPWarrior\Turn($this->abilities());
    }

    /**
     * Prepare for your turn.
     */
    public function prepare_turn()
    {
        $this->current_turn = $this->next_turn();
        return $this->play_turn($this->current_turn);
    }

    /**
     * Perform your turn.
     */
    public function perform_turn()
    {
        if ($this->position) {
            foreach ($this->abilities as $ability) {
                $ability->pass_turn();
            }
            if ($this->current_turn->action && !$this->is_bound()) {
                list ($name, $args) = $this->current_turn->action;
                call_user_func_array([$this->abilities[$name], 'perform'], $args);
                //$this->abilities[$name]->perform($args);
            }
        }
    }

    /**
     * Play your turn.
     *
     * @param $turn
     */
    public function play_turn($turn)
    {
        # to be overriden by subclass
    }

    /**
     * Abilities.
     *
     * @return array
     */
    public function abilities()
    {
        return $this->abilities;
    }

    /**
     * The character.
     *
     * @return string
     */
    public function character()
    {
        return '?';
    }
}
