<?php

declare(strict_types=1);

namespace App\Classes\Output;

class Console implements LineWriterInterface
{
    /**
     * @param string $text
     *
     * @return void
     */
    public function writeLine(string $text): void
    {
        echo "\e[32m{$text} \n";
    }

}