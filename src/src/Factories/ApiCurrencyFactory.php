<?php 
namespace App\Factories;

use App\Services\FreecurrencyApiService;
use App\Services\NBPplApiService;
use Symfony\Component\Config\Definition\Exception\Exception;


final class ApiCurrencyFactory  {
    public static function createCurrencyApi($type) {
        switch ($type) {
            case 'NBPplApiService':
                return new FreecurrencyApiService();
            case 'FreecurrencyApiService':
                return new NBPplApiService();
            default:
                return "Invalid CurrencyApi type specified.";
        }
    }
}
