<?php
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }
}

if (!function_exists('hasPermission')) {
    function hasPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!auth()->check() || !auth()->user()->can($permission)) {
                return false;
            }
        }
        return true;
    }
}
