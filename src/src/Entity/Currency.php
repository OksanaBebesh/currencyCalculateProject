<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $currency_name = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column]
    private int $visible = 0;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datetime_add = null;

    public function __construct() {
        $this->setDatetimeAdd(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrencyName(): ?string
    {
        return $this->currency_name;
    }

    public function setCurrencyName(string $currency_name): static
    {
        $this->currency_name = $currency_name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getVisible(): int
    {
        return $this->visible;
    }

    public function setVisible(float $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getDatetimeAdd(): ?\DateTimeInterface
    {
        return $this->datetime_add;
    }

    public function setDatetimeAdd(\DateTimeInterface $datetime_add): static
    {
        $this->datetime_add = $datetime_add;

        return $this;
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

}
