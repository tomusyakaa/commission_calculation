<?php

declare(strict_types=1);

namespace App\Classes\DataProvider;

use App\Classes\Model\Transaction;

class File implements DataProviderInterface
{

    /**
     * @param string $filePath
     */
    public function __construct(private string $filePath)
    {

    }

    /**
     * @return \Generator
     *
     * @throws \Exception
     */
    public function getLine(): \Generator
    {
        if (!file_exists($this->filePath)) {
            throw new \Exception('File does not exist.');
        }

        $f = fopen($this->filePath, 'r');

        try {
            while ($line = fgets($f)) {
                $data = json_decode($line, true);

                yield new Transaction((int)$data['bin'], (float)$data['amount'], $data['currency']);
            }
        } finally {
            fclose($f);
        }
    }

}