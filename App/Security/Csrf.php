<?php
namespace App\Security;

class Csrf
{
    const TOKEN_KEY = 'csrf_token';

    public static function generateToken(): string
    {
        self::startSessionIfNotStarted();

        if (!isset($_SESSION[self::TOKEN_KEY])) {
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::TOKEN_KEY];
    }

    public static function getToken(): ?string
    {
        self::startSessionIfNotStarted();
        return $_SESSION[self::TOKEN_KEY] ?? null;
    }

    public static function verifyToken(?string $token): bool
    {
        self::startSessionIfNotStarted();

        return isset($_SESSION[self::TOKEN_KEY]) &&
               is_string($token) &&
               hash_equals($_SESSION[self::TOKEN_KEY], $token);
    }

    private static function startSessionIfNotStarted(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}