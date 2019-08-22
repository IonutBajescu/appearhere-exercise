<?php

namespace AppearHere;


interface CheckoutInterface
{
    public function __construct(Rules $rules);
    public function scan($productId);
    public function calculateTotal();
}