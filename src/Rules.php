<?php

namespace AppearHere;


use AppearHere\SpecialPrice\GroupedPricingStrategy;

class Rules
{
    /**
     * @var array
     */
    protected $items;

    public function __construct()
    {
        $this->addItem('A', 50, new GroupedPricingStrategy(3, 130));
        $this->addItem('B', 30, new GroupedPricingStrategy(2, 45));
        $this->addItem('C', 20);
        $this->addItem('D', 15);
    }

    /**
     * @param int $productId
     * @return Product
     */
    public function getProductById($productId)
    {
        return $this->items[$productId];
    }

    public function addItem($id, $unitPrice, GroupedPricingStrategy $specialPrice = null)
    {
        $this->items[$id] = new Product($id, $unitPrice, $specialPrice);
    }
}