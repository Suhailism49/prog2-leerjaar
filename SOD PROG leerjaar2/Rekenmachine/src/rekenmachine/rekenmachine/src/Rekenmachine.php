<?php

class Rekenmachine {
    
    /**
     * Optellen van twee getallen
     */
    public function optellen($a, $b) {
        return $a + $b;
    }
    
    /**
     * Aftrekken van twee getallen
     */
    public function aftrekken($a, $b) {
        return $a - $b;
    }
    
    /**
     * Vermenigvuldigen van twee getallen
     */
    public function vermenigvuldigen($a, $b) {
        return $a * $b;
    }
    
    /**
     * Delen van twee getallen
     */
    public function delen($a, $b) {
        if ($b == 0) {
            throw new Exception("Deling door nul is niet toegestaan!");
        }
        return $a / $b;
    }
    
    /**
     * Macht berekenen (a^b)
     */
    public function macht($a, $b) {
        return pow($a, $b);
    }
    
    /**
     * Vierkantwortel
     */
    public function wortel($a) {
        if ($a < 0) {
            throw new Exception("Vierkantwortel van negatief getal is niet toegestaan!");
        }
        return sqrt($a);
    }
    
    /**
     * Percentage berekenen
     */
    public function percentage($getal, $procent) {
        return ($getal * $procent) / 100;
    }
}