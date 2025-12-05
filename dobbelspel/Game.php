<?php
require_once 'Dice.php';
 
class Game {
 
    private $dice = [];
    private $throwCount = 0;
    private $maxThrows = 3;
    private $log = [];
 
    public function __construct() {
        for ($i = 0; $i < 5; $i++) {
            $this->dice[$i] = new Dice();
        }
    }
 
    public function play() {
        if ($this->throwCount >= $this->maxThrows) {
            return "Maximaal aantal worpen bereikt!";
        }
 
        $this->throwCount++;
 
        $values = [];
        foreach ($this->dice as $die) {
            $die->throwDice();
            $values[] = $die->getFaceValue();
        }
 
        $this->log[] = $values;
 
        return $values;
    }
 
    public function getThrowCount() {
        return $this->throwCount;
    }
 
    public function getLog() {
        return $this->log;
    }
 
    public function allEqual($values) {
        return count(array_unique($values)) === 1;
    }
 
    public function hasDoubles($values) {
        return count($values) !== count(array_unique($values));
    }
 
    public function getDiceSvg($value, $color = 'white') {
 
        $svg = "<svg width='60' height='60' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg' style='margin:5px; border:1px solid #000;'>";
        $svg .= "<rect width='100' height='100' style='fill:$color;'/>";
 
        $positions = [
            1 => [[50, 50]],
            2 => [[30, 30], [70, 70]],
            3 => [[30, 30], [50, 50], [70, 70]],
            4 => [[30, 30], [30, 70], [70, 30], [70, 70]],
            5 => [[30, 30], [30, 70], [50, 50], [70, 30], [70, 70]],
            6 => [[30, 30], [30, 50], [30, 70], [70, 30], [70, 50], [70, 70]],
        ];
 
        foreach ($positions[$value] as $p) {
            $svg .= "<circle cx='{$p[0]}' cy='{$p[1]}' r='8' fill='black'></circle>";
        }
 
        $svg .= "</svg>";
        return $svg;
    }
}