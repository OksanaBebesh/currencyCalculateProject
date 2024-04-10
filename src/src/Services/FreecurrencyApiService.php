<?php
namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class FreecurrencyApiService implements CurrencyConverterInterface {
    const BASE_URL = 'https://api.freecurrencyapi.com/v1/';
    const RANGE_URL = 'https://api.freecurrencyapi.com/v3/range';
    const URL_HISTORY = 'https://api.freecurrencyapi.com/v1/historical';
    const URL_LATEST = 'https://api.freecurrencyapi.com/v1/latest';
    //TODO add into env file
    const apiKey = 'fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw';

    public function getRate($amount=null, $fromCurrency=null, $toCurrency=null) :array {
        $data = file_get_contents('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw&base_currency=' . $fromCurrency . '&currencies=' . $toCurrency);
        return json_decode($data, true)["data"];
    }

    public function getListOfCurrencyForPeriod(){

        $baseCurrency = 'USD';
        $currencies = 'EUR';
        $date = '2023-12-31';
        $params = [
            'apikey' => self::apiKey,
            'date' => $date,
            'base_currency' => $baseCurrency,
            'currencies' => $currencies,
        ];

        $rangeParams = [
            'apikey' => self::apiKey,
            'datetime_start' => '2024-03-30T23:59:59Z',
            'datetime_end' => '2024-04-15T23:59:59Z',
            'accuracy' => 'day',
            'base_currency' => $baseCurrency,
            'currencies' => $currencies,
        ];

        $urlQuery = http_build_query($params);
        $data = file_get_contents(self::BASE_URL . 'historical' . '?' . $urlQuery );
        // var_dump('I am in service!');        
        // var_dump(json_decode($data, true));

        return json_decode($data, true)["data"];

    }

    public function getData() {
        $listOfCurrency = file_get_contents('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw');

        return json_decode($listOfCurrency, true)["data"];
    }


    private function getApiData(string $baseCurrency = 'USD', string $currencies = 'EUR', int $count = 100) {
        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw&base_currency=' . $baseCurrency . '&currencies=' . $currencies;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        $dataFromApiClean = json_decode($data, true)["data"][$currencies];
        curl_close($curl);

        return $dataFromApiClean;
    }

    private function getAnaliseBestRate() {
        
    }

   
}