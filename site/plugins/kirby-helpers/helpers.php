<?php

use JohannSchopplich\Helpers\Env;
use JohannSchopplich\Helpers\Vite;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable
     */
    function env(string $key, $default = null)
    {
        return Env::get($key, $default);
    }
}

if (!function_exists('vite')) {
    /**
     * Returns the Vite singleton class instance
     */
    function vite(): Vite
    {
        return Vite::instance();
    }
}

if (!function_exists('issueColorComponents')) {
    /**
     * Normalizes issue color values from Kirby color field hex values
     * and legacy "r,g,b" values to RGB integer components.
     */
    function issueColorComponents($value): array
    {
        if ($value instanceof Kirby\Content\Field) {
            $value = $value->value();
        }

        $value = trim((string) $value);

        if ($value === '') {
            return [240, 244, 18];
        }

        if (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $value, $matches) === 1) {
            $hex = $matches[1];

            if (strlen($hex) === 3) {
                $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
            }

            return [
                hexdec(substr($hex, 0, 2)),
                hexdec(substr($hex, 2, 2)),
                hexdec(substr($hex, 4, 2))
            ];
        }

        $components = preg_split('/[^\d]+/', $value, -1, PREG_SPLIT_NO_EMPTY);
        if (count($components) >= 3) {
            return [
                max(0, min(255, (int) $components[0])),
                max(0, min(255, (int) $components[1])),
                max(0, min(255, (int) $components[2]))
            ];
        }

        return [240, 244, 18];
    }
}

if (!function_exists('issueColorCss')) {
    /**
     * Returns an rgb()/rgba() CSS color string from issue color values.
     */
    function issueColorCss($value, ?float $alpha = null): string
    {
        [$r, $g, $b] = issueColorComponents($value);

        if ($alpha === null) {
            return "rgb({$r}, {$g}, {$b})";
        }

        $alpha = max(0, min(1, $alpha));

        return "rgba({$r}, {$g}, {$b}, {$alpha})";
    }
}
