<?php

namespace App\Services;

class Money
{
    public static function toYuan($fen)
    {
        return sprintf('%.2f', $fen / 100.0);
    }

    public static function toFen($yuan)
    {
        return intval($yuan * 100);
    }
}
