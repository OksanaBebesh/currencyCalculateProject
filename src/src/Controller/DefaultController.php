<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\{TextType,SubmitType};
use App\Factories\ApiCurrencyFactory;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(Request $request, CurrencyRepository $currencyRepository): Response
    {        
        $result = $request->query->get('result');;
        //Getting data from DB. Choose Only visible currency

        // Example usage Factory:

        // Creating a currency api connection by NBPplApi
        $nbpApiService = ApiCurrencyFactory::createCurrencyApi('NBPplApiService');
        // var_dump($nbpApiService );
        // $chosenService = $nbpApiService->getRate() . "\n"; // Output: NBPplApi
        // echo $result . "\n";

        // Creating currency api connection by Freecurrencyapi
        $FreecurrencyApiService = ApiCurrencyFactory::createCurrencyApi('FreecurrencyApiService');
        $chosenService = $FreecurrencyApiService->getRate(); // Output: Freecurrencyapi
        $listOfCurrency = $FreecurrencyApiService->getData();

        // echo $result . "\n";

        // $currencyVisible = $currencyRepository->getListOfCurrencyByVisibility(true);
        // $listOfVisibleCurrency = array_map(function($item) {return [$item["currency_name"] => $item["currency_name"]];}, $currencyVisible);


        $defaultData = ['message' => ''];
        $form = $this->createFormBuilder($defaultData)
            ->add('count', TextType::class)
            ->add('From', ChoiceType::class, [
                'choices'  => $listOfCurrency
            ])
            ->add('To', ChoiceType::class, [
                'choices'  => $listOfCurrency
            ])
            ->add('send', SubmitType::class)
            ->add('get_best_item', SubmitType::class)
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $calculate = $form->getData();
                $currencies = $calculate["To"];
                $a = $FreecurrencyApiService->getListOfCurrencyForPeriod($currencies);
                // $result = (new Currency)->convert($calculate["From"], $calculate["To"], $calculate["count"]);

                return  $this->redirectToRoute('index', ["result" => $a]);
            }    
            

        return $this->render('Default/default.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
            'serviceInUse' => $chosenService,
            'currencyList' => $listOfCurrency
        ]);
    }
}
