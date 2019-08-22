<?php

namespace AppearHere\SpecialPrice;


class DiscountedGroupPrice
{
    /**
     * Items that we couldn't apply a discount to
     *
     * @var int
     */
    public $remainingItems;

    /**
     * @var int
     */
    public $discountedPrice;

    public function __construct($remainingItemsWithoutDiscount, $discountedPrice)
    {
        $this->remainingItems = $remainingItemsWithoutDiscount;
        $this->discountedPrice = $discountedPrice;
    }
}