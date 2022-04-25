<?php

declare(strict_types=1);

namespace App\Classes\Output;

interface LineWriterInterface
{
    /**
     * @param string $text
     *
     * @return void
     */
    public function writeLine(string $text): void;
}