<?php

namespace AppearHere;


use AppearHere\SpecialPrice\GroupedPricingStrategy;

class Product
{
    private $id;
    private $unitPrice;
    private $discountStrategy;

    /**
     * @param int $id
     * @param int $unitPrice
     * @param GroupedPricingStrategy $specialPrice
     */
    public function __construct($id, $unitPrice, GroupedPricingStrategy $specialPrice = null)
    {
        $this->id = $id;
        $this->unitPrice = $unitPrice;
        $this->discountStrategy = $specialPrice;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @return GroupedPricingStrategy
     */
    public function getDiscountStrategy(): ?GroupedPricingStrategy
    {
        return $this->discountStrategy;
    }
}