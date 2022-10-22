<?php

namespace App\Core;

class ResponseCodesEnum
{
    private const RESPONSE_CODES = [
        200 => 'OK',
        500 => 'Internal Server Error'
    ];

    public static function getCodeDescription(int $code): string
    {
        return self::RESPONSE_CODES[$code];
    }
}