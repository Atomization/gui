<?php


namespace atom\gui\elements;


use Exception;
use pocketmine\Player;

class Slider extends Element {

    protected $min = 0;
    protected $max = 0;
    protected $step = 0;
    protected $defaultValue = 0;

    /**
     * Slider constructor.
     * @param $text
     * @param $min
     * @param $max
     * @param float $step
     * @throws Exception
     */
    public function __construct($text, $min, $max, $step = 0.0){
        if ($min > $max) {
            throw new Exception(__METHOD__ . ' Borders are messed up');
        }
        $this->text = $text;
        $this->min = $min;
        $this->max = $max;
        $this->defaultValue = $min;
        $this->setStep($step);
    }

    /**
     * @param $step
     * @throws Exception
     */
    public function setStep($step){
        if ($step < 0) {
            throw new Exception(__METHOD__ . ' Step should be positive');
        }
        $this->step = $step;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setDefaultValue($value) {
        if ($value < $this->min || $value > $this->max) {
            throw new Exception(__METHOD__ . ' Default value out of borders');
        }
        $this->defaultValue = $value;
    }

    public function jsonSerialize() {
        $data = [
            "type" => "slider",
            "text" => $this->text,
            "min" => $this->min,
            "max" => $this->max
        ];
        if ($this->step > 0) {
            $data["step"] = $this->step;
        }
        if ($this->defaultValue != $this->min) {
            $data["default"] = $this->defaultValue;
        }
        return $data;
    }

    public function handle($value, Player $player){
        return $value;
    }
}
