<?php

namespace App\Enums;

enum Priority: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Low Priority',
            self::Normal => 'Normal Priority',
            self::High => 'High Priority',
        };
    }
}
