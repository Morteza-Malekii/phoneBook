<?php
namespace App\Middleware;

use App\Middleware\contract\MiddlewareContract;

class GlobalMiddleware implements MiddlewareContract
{
    public function handle()
    {
        $this->sanitize($_GET);
        $this->sanitize($_POST);
        return true;
    }

    private function sanitize(&$array)
    {
        foreach ($array as $key => $value) {
            $array[$key] = htmlspecialchars(trim($value));
        }
    }
}