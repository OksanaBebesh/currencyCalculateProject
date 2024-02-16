<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Currency;

class SavingCurrencyController extends AbstractController
{
    #[Route('/saving/currency', name: 'app_saving_currency')]
    public function index(EntityManagerInterface $eManager): Response
    {

        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);

        $dataArray = json_decode($data, true)["data"];

        foreach( $dataArray as $key => $value) {
            $currency = new Currency();
            $currency->setCurrencyName($key);
            $currency->setValue($value);
            $currency->setDateTimeAdd((new \DateTime()));
            $eManager->persist($currency);
        }

        $eManager->persist($currency);
        $eManager->flush();

        return $this->redirectToRoute('index');
    }
}
