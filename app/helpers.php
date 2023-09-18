<?php
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }
}
