<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'CECOB');
define('APP_URL', 'http://localhost/ceco');
define('APP_ROOT', dirname(__DIR__));

date_default_timezone_set('Africa/Tripoli');

