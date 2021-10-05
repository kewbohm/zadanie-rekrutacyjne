<?php

namespace Smartbees;

class Cart
{
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }

    public function addProduct($product, $quantity)
    {
        $cartItem = $this->findCartItem($product->getId());
        if ($cartItem === null){
            $cartItem = new CartItem($product, $quantity);
            $this->items[$product->getId()] = $cartItem;
        }
        return $cartItem;
    }

    private function findCartItem($productId)
    {
        return $this->items[$productId] ?? null;
    }

    public function getTotalSum()
    {
        $totalSum = 0;
        foreach ($this->items as $item) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum;
    }
}