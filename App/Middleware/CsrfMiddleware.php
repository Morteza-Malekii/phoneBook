<?php
namespace App\Middleware;

use App\Middleware\contract\MiddlewareContract;
use App\Security\Csrf;

class CsrfMiddleware implements MiddlewareContract
{
    public function handle()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $headers = function_exists('getallheaders') ? getallheaders() : [];
            $token = $_POST['csrf_token'] ?? $headers['X-CSRF-TOKEN'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
            if (!Csrf::verifyToken($token)) {
                http_response_code(403);
                echo "CSRF token is invalid or missing.";
                exit;
            }
        }
        return true;
    }
}