<?php

declare(strict_types=1);

namespace App\Classes\Helper;

class Country
{
    public const AUSTRIA = 'AT';
    public const BELGIUM = 'BE';
    public const BULGARIA = 'BG';
    public const CYPRUS = 'CY';
    public const CZECHIA = 'CZ';
    public const GERMANY = 'DE';
    public const DENMARK = 'DK';
    public const ESTONIA = 'EE';
    public const SPAIN = 'ES';
    public const FINLAND = 'FI';
    public const FRANCE = 'FR';
    public const GREECE = 'GR';
    public const CROATIA = 'HR';
    public const HUNGARY = 'HU';
    public const IRELAND = 'IE';
    public const ITALY = 'IT';
    public const LITHUANIA = 'LT';
    public const LUXEMBOURG = 'LU';
    public const LATVIA = 'LV';
    public const MALTA = 'MT';
    public const NETHERLANDS = 'NL';
    public const POLAND = 'PO';
    public const PORTUGAL = 'PT';
    public const ROMANIA = 'RO';
    public const SWEDEN = 'SE';
    public const SLOVENIA = 'SI';
    public const SLOVAKIA = 'SK';

    public const EUROPEAN_COUNTRIES = [
        self::AUSTRIA,
        self::BELGIUM,
        self::BULGARIA,
        self::CROATIA,
        self::CYPRUS,
        self::CZECHIA,
        self::DENMARK,
        self::ESTONIA,
        self::FINLAND,
        self::FRANCE,
        self::GERMANY,
        self::GREECE,
        self::HUNGARY,
        self::IRELAND,
        self::ITALY,
        self::LATVIA,
        self::LITHUANIA,
        self::LUXEMBOURG,
        self::MALTA,
        self::NETHERLANDS,
        self::POLAND,
        self::PORTUGAL,
        self::ROMANIA,
        self::SLOVAKIA,
        self::SLOVENIA,
        self::SPAIN,
        self::SWEDEN,
    ];

    /**
     * @param string $countryCode
     *
     * @return bool
     */
    public static function isEurope(string $countryCode): bool
    {
        return in_array($countryCode, self::EUROPEAN_COUNTRIES, true);
    }
}