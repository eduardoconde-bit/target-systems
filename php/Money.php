<?php

class Money {
    public static function formatToBRL($value, $isInteger = false) 
    {
        if ($isInteger) {
            return number_format($value, 0, ',', '.'); // Inteiro: sem casas decimais
        } else {
            return number_format($value, 2, ',', '.'); // Decimal: duas casas decimais
        }
    }
}