<?php

use AppearHere\Checkout;
use AppearHere\Rules;

class PriceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider totalsAreCalculatedProvider
     * @param int $totalPrice
     * @param string $productIdList
     */
    public function testTotalsAreCalculated($totalPrice, $productIdList)
    {
        $productIds = preg_split('//', $productIdList, -1, PREG_SPLIT_NO_EMPTY);

        $checkout = new Checkout(new Rules());
        foreach ($productIds as $productId) {
            $checkout->scan($productId);
        }

        $this->assertEquals($totalPrice, $checkout->calculateTotal());
    }

    public function totalsAreCalculatedProvider()
    {
        return [
            [0, ""],
            [50, "A"],
            [80, "AB"],
            [115, "CDBA"],

            [100, "AA"],
            [130, "AAA"],
            [180, "AAAA"],
            [230, "AAAAA"],
            [260, "AAAAAA"],

            [160, "AAAB"],
            [175, "AAABB"],
            [190, "AAABBD"],
            [190, "DABABA"],
        ];
    }
}