<?php
namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class NBPplApiService implements CurrencyConverterInterface {
    public function getRate($amount, $fromCurrency, $toCurrency) :string {
        return "NBPplApiService";
    }
}
