<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Factories\ApiCurrencyFactory;
use App\Services\FreecurrencyApiService;
use App\Services\NBPplApiService;

class CurrecyFactoryTest extends TestCase
{
    /**
     * @dataProvider getCurrencyApi
     */
    public function testCreateCurrencyApi(string $params)
    {
        $argumentToCheck = ApiCurrencyFactory::createCurrencyApi($params);
        $this->assertSame($params, $argumentToCheck);
    }

    public function getCurrencyApi() {
        yield ['NBPplApiService', new NBPplApiService()];
        yield ['FreecurrencyApiService', new FreecurrencyApiService()];
    }
}
