<?php

namespace AppearHere;

class Checkout implements CheckoutInterface
{
    /**
     * @var Rules
     */
    private $rules;

    /**
     * @var array
     */
    private $scannedItemIds = [];

    public function __construct(Rules $rules)
    {
        $this->rules = $rules;
    }


    /**
     * @param string $productId
     */
    public function scan($productId)
    {
        if (isset($this->scannedItemIds[$productId])) {
            $this->scannedItemIds[$productId]++;
        } else {
            $this->scannedItemIds[$productId] = 1;
        }
    }

    /**
     * @return int
     */
    public function calculateTotal()
    {
        $totalPrice = 0;
        foreach ($this->scannedItemIds as $productId => $count) {
            $product = $this->rules->getProductById($productId);

            $totalPrice += $product->getDiscountStrategy()
                ? $this->calculateDiscountedProduct($product, $count)
                : $product->getUnitPrice() * $count;
        }

        return $totalPrice;
    }

    /**
     * @return int
     */
    public function calculateDiscountedProduct(Product $product, $count)
    {
        $price = 0;

        // We first try to apply a discount
        $discount = $product->getDiscountStrategy()->getDiscountedPrice($count);
        $price += $discount->discountedPrice;

        // And if there's any remaining items, we multiply and get the unit price for them
        if ($discount->remainingItems) {
            $price += $product->getUnitPrice() * $discount->remainingItems;
        }

        return $price;
    }
}