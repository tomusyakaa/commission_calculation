<?php

declare(strict_types=1);

namespace App\Classes\BIN;

use App\Classes\Model\BinMetadata;
use App\Classes\Trait\RequestTrait;

class BinlistClient implements BINInterface
{
    use RequestTrait;

    /**
     * @param string $url
     */
    public function __construct(private string $url)
    {

    }

    /**
     * @param int $binId
     *
     * @return BinMetadata
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBinMetaData(int $binId): BinMetadata
    {
        $data = $this->getData($this->getUri($binId));
        $data = json_decode($data, true);

        if (!$data) {
            throw new \Exception("No metadata for $binId.");
        }

        return new BinMetadata($binId, $data['country']['alpha2']);
    }

    /**
     * @param int $binId
     *
     * @return string
     */
    private function getUri(int $binId): string
    {
        return $this->url . '/' . $binId;
    }
}