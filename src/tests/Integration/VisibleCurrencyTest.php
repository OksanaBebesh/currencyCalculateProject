<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\CurrencyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class VisibleCurrencyTest extends KernelTestCase
{
    private CurrencyRepository $currencyRepository;


    protected function setUp(): void {

        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();
        $this->currencyRepository = new CurrencyRepository($container->get(ManagerRegistry::class));
    }

    public function testGetListOfCurrencyByVisibility() {

        $currencies = $this->currencyRepository->getListOfCurrencyByVisibility(1);

        if (in_array("Test Currency", array_column($currencies, "currency_name"))) {
            
        }


    
    }
}
