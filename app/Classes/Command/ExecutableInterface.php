<?php

declare(strict_types=1);

namespace App\Classes\Command;

interface ExecutableInterface
{

    /**
     * @param ...$params
     *
     * @return void
     */
    public function execute(...$params): void;

}