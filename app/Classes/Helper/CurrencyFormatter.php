<?php

namespace App\Classes\Helper;

class CurrencyFormatter
{
    /**
     * @param float $commision
     *
     * @return float
     */
    public static function format(float $commission): float
    {
        $pow = pow (10, 2);

        return (ceil($pow * $commission) + ceil($pow * $commission - ceil($pow * $commission))) / $pow;
    }
}