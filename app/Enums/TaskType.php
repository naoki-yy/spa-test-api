<?php

namespace App\Enums;

enum TaskType: int
{
    case Unchecked = 0;
    case Checked = 1;

    public function label(): string
    {
        return match($this) {
            self::Unchecked => '未チェック',
            self::Checked => 'チェック済',
        };
    }
}
