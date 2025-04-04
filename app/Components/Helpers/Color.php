<?php

namespace App\Components\Helpers;

use App\Enums\Priority;

readonly class Color
{
    public static function getRandomColorWithOpacity($opacity = 0.3): string
    {
        $randomColor = '#' . dechex(mt_rand(0, 0xFFFFFF));

        $randomColor = str_pad(substr($randomColor, 1), 6, '0', STR_PAD_LEFT);

        $r = hexdec(substr($randomColor, 0, 2));
        $g = hexdec(substr($randomColor, 2, 2));
        $b = hexdec(substr($randomColor, 4, 2));

        return "rgba($r, $g, $b, $opacity)";
    }

    public static function getPriorityColors(string $priority): string
    {
        return match ($priority) {
            Priority::Low->value => '#79c2be',
            Priority::Normal->value=> '#b1b08a',
            Priority::High->value => '#c86822d4'
        };
    }
}
