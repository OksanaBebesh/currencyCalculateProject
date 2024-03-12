<?php
namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class FreecurrencyApiService implements CurrencyConverterInterface {
    public function getRate($amount=null, $fromCurrency=null, $toCurrency=null) :string {
        return "FreecurrencyApiService";
    }
}