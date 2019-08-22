<?php

namespace AppearHere\SpecialPrice;


class GroupedPricingStrategy
{
    private $itemsInGroup;
    private $totalPrice;

    public function __construct($itemsInGroup, $totalPrice)
    {
        $this->itemsInGroup = $itemsInGroup;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @param int $count
     * @return DiscountedGroupPrice
     */
    public function getDiscountedPrice($count): DiscountedGroupPrice
    {
        // We're getting the groups that we can apply the special price
        // (since sometimes we could apply the discount twice if enough items are purchased)
        $qualifiedGroups = intdiv($count, $this->itemsInGroup);
        $discountedPrice = $qualifiedGroups * $this->totalPrice;

        // Return the remaining items that we couldn't create a special price for
        $remainingItems = $count % $this->itemsInGroup;

        return new DiscountedGroupPrice($remainingItems, $discountedPrice);
    }
}