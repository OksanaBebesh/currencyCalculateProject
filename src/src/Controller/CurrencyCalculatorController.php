<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyCalculatorController extends AbstractController
{
    #[Route('/currency/calculator', name: 'app_currency_calculator')]
    public function index(): Response
    {
        return $this->render('currency_calculator/index.html.twig', [
            'controller_name' => 'CurrencyCalculatorController',
        ]);
    }
}
