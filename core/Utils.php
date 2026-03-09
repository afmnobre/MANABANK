<?php

// core/Utils.php
class Utils {
    public static function maskPhone($number) {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (strlen($number) == 11) {
            return "(" . substr($number, 0, 2) . ") " . substr($number, 2, 5) . "-" . substr($number, 7);
        }
        return $number;
    }
}
