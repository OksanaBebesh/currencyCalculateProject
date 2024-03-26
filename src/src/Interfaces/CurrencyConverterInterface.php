<?php
namespace App\Interfaces;

interface CurrencyConverterInterface {
    public function getRate($amount, $fromCurrency, $toCurrency) :string;
    public function getData();
} 