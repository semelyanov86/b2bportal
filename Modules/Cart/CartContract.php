<?php

namespace Modules\Cart;

//use Modules\Support\Money;

class CartContract
{
    private $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function entity()
    {
        return $this->contract;
    }

    public function id()
    {
        return $this->contract->id;
    }

    public function name()
    {
        return $this->contract->name;
    }

}
