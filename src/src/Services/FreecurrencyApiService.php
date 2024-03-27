<?php
namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class FreecurrencyApiService implements CurrencyConverterInterface {
    public function getRate($amount=null, $fromCurrency=null, $toCurrency=null) :array {
        $data = file_get_contents('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw&base_currency=' . $fromCurrency . '&currencies=' . $toCurrency);
        return json_decode($data, true)["data"];
    }

    public function getListOfCurrency(){

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
}