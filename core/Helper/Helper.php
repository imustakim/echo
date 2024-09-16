<?php

namespace Core\Helper;

class Helper {
    public function formatCurrency(float $amount): string {
        return '$' . number_format($amount, 2);
    } 

    public static function sanitizeString(string $string): string { 
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

}
