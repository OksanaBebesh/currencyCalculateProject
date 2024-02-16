<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Currency;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(Request $request): Response
    {        
        $result = $request->query->get('result');;
        //TODO get data from DB
        //Create Service to get data from API
        $url = 'https://api.freecurrencyapi.com/v1/currencies?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);

        $dataArray = json_decode($data, true)["data"];
        $listOfData = array_keys($dataArray, true);
        $listOfCurrency = array_map(function($item) {return [$item => $item];}, $listOfData);

        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('count', TextType::class)
            ->add('From', ChoiceType::class, [
                'choices'  => $listOfCurrency
            ])
            ->add('To', ChoiceType::class, [
                'choices'  => $listOfCurrency
            ])
            ->add('send', SubmitType::class)
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $calculate = $form->getData();

                $result = $this->getApiData($calculate["From"], $calculate["To"], $calculate["count"]);

                var_dump($result);
                return  $this->redirectToRoute('index', ["result" => $result]);
            }    
            

        return $this->render('Default/default.html.twig', [
            'dataCurrency' => $dataArray,
            'form' => $form->createView(),
            'result' => $result
        ]);
    }

    private function getApiData($baseCurrency, $currencies, $count) {
        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_QC0XQuzSAHlD8NbYkp7G1a9q1nhFUlGu53IwrLSw&base_currency=' . $baseCurrency . '&currencies=' . $currencies;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        $dataFromApiClean = json_decode($data, true)["data"][$currencies];

        curl_close($curl);
        $stringAnswer =  $count . " " . $baseCurrency . " To " . $currencies . " = ";


        return $stringAnswer . intval($count * $dataFromApiClean);
    }

    private function getCurrencyDataFromDB() {
        
    }
}
