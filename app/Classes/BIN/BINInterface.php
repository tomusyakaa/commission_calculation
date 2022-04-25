<?php

namespace App\Classes\BIN;

use App\Classes\Model\BinMetadata;

interface BINInterface
{
    /**
     * @param int $binId
     *
     * @return BinMetadata
     */
    public function getBinMetaData(int $binId): BinMetadata;
}