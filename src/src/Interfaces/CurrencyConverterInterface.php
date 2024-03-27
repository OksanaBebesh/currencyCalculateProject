<?php
namespace App\Interfaces;

interface CurrencyConverterInterface {
    public function getRate($amount, $fromCurrency, $toCurrency) :array;
    public function getData();
} 