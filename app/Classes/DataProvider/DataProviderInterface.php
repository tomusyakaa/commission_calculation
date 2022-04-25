<?php

declare(strict_types=1);

namespace App\Classes\DataProvider;

interface DataProviderInterface
{

    /**
     * @return \Generator
     */
    public function getLine(): \Generator;

}