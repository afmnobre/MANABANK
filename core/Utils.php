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

    /**
     * Dispara um alert JavaScript com o conteúdo da variável
     */
    public static function debug($dados) {
        $json = json_encode($dados, JSON_UNESCAPED_UNICODE);
        // Remove quebras de linha reais para não quebrar o JS
        $jsonLimpo = addslashes($json);
        echo "<script>alert('DEBUG PHP: {$jsonLimpo}');</script>";
    }
}
