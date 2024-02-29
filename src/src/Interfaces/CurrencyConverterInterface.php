<?php
interface CurrencyConverterInterface {
    public function getRate($amount, $fromCurrency, $toCurrency) :float;
} 