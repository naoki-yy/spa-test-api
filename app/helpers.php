<?php

if (!function_exists('ddh')) {
    function ddh(mixed ...$args): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd(...$args);
    }
}
