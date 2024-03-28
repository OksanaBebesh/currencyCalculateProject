<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject;
use App\Factories\ApiCurrencyFactory;
use App\Services\FreecurrencyApiService;
use App\Services\NBPplApiService;
use App\Interfaces\CurrencyConverterInterface;

class CurrencyFactoryTest extends TestCase
{
    private MockObject $objectService;

    protected function setUp():void {

        // $this->objectService = $this->createMock(CurrencyConverterInterface::class);
        $this->factory = new ApiCurrencyFactory();
    }

    public function testCreateCurrencyApi()
    {
        $param = 'Unknown Service Name';
        $waitingForResult = 'Invalid CurrencyApi type specified.';

        $result = $this->factory->createCurrencyApi($param);

        $this->assertSame($waitingForResult, $result);
    }

}
