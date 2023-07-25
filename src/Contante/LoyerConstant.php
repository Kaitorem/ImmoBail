<?php

namespace App\Contante;

class LoyerConstant
{
    // TYPE DE BIEN
    public const APPARTEMENT = 'appartement';
    public const MAISON = 'maison';
    public const PARKING = 'parking';
    public const AUTRES = 'autres';

    public const types = [
        self::APPARTEMENT => self::APPARTEMENT,
        self::MAISON => self::MAISON,
        self::PARKING => self::PARKING,
        self::AUTRES => self::AUTRES,
    ];

    // AMANAGEMENT
    public const MEUBLE = 'meublé';
    public const NON_MEUBLE = 'non meublé';

    public const AMANAGEMENT = [
        self::MEUBLE => self::MEUBLE,
        self::NON_MEUBLE => self::NON_MEUBLE,
    ];
}
