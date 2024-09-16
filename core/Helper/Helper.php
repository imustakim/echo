<?php

namespace Core\Helper;

class Helper {

    /**
     * Format a float as currency.
     *
     * @param float $amount The amount to format.
     * @return string The formatted currency string.
     */
    public function formatCurrency(float $amount): string {
        return '$' . number_format($amount, 2);
    } 

    /**
     * Sanitize a string for safe output.
     *
     * @param string $string The string to sanitize.
     * @return string The sanitized string.
     */
    public static function sanitizeString(string $string): string { 
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate an email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Generate a random string of a given length.
     *
     * @param int $length The length of the string to generate.
     * @return string The generated random string.
     */
    public static function generateRandomString(int $length = 10): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Convert a date string to a specified format.
     *
     * @param string $date The date string to format.
     * @param string $format The format to convert to (default 'Y-m-d').
     * @return string The formatted date string.
     */
    public static function formatDate(string $date, string $format = 'Y-m-d'): string {
        $dateTime = new \DateTime($date);
        return $dateTime->format($format);
    }

    /**
     * Check if a string contains only alphabetic characters.
     *
     * @param string $string The string to check.
     * @return bool True if the string contains only alphabetic characters, false otherwise.
     */
    public static function isAlpha(string $string): bool {
        return ctype_alpha($string);
    }

    /**
     * Check if a string contains only alphanumeric characters.
     *
     * @param string $string The string to check.
     * @return bool True if the string contains only alphanumeric characters, false otherwise.
     */
    public static function isAlphanumeric(string $string): bool {
        return ctype_alnum($string);
    }
}
