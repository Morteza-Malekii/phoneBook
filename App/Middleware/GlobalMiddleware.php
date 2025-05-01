<?php
namespace App\Middleware;

use App\Middleware\contract\MiddlewareContract;

class GlobalMiddleware implements MiddlewareContract
{
        public function handle()
    {
        $this->sanitizeGetParams();
        $this->sanitizePostParams();
        return true;
    }

    private function sanitizeGetParams()
    {
        foreach ($_GET as $key => $value) {
            $_GET[$key] = xss_clean($value);
        }
    }

    private function sanitizePostParams()
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = xss_clean($value);
        }
    }
    

}