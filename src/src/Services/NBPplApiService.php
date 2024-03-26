<?php
namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class NBPplApiService implements CurrencyConverterInterface {
    public function getRate($amount, $fromCurrency, $toCurrency) :string {
        return "NBPplApiService";
    }

    public function getData() {
        $currencies = 'gbp';
        $listOfCurrency = file_get_contents("http://api.nbp.pl/api/exchangerates/rates/a/$currencies/last/10/?format=json");

        return json_decode($listOfCurrency, true);
    }
}
