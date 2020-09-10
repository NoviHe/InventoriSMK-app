<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $kode;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->kode = $oldCart->kode;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'kode' => $item->kode_inventaris, 'items' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['kode'];
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->kode;
        $this->totalPrice += $item->price;
    }

    public function minOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['items']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['items']['price'];
    }

    public function plusOne($id)
    {
        $this->items[$id]['qty']++;
        $this->items[$id]['price'] += $this->items[$id]['items']['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['items']['price'];
    }
}
