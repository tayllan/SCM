<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemCart;
use Illuminate\Support\Collection;

class CartService
{
    public function add_item_to_cart(int $product_id, int $quantity, int $user_id, int $cart_id = null): int
    {
        if (!$product_id || !$quantity) {
            return -1;
        }

        if (!$cart_id) {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->save();

            $cart_id = $cart->id;
        }

        $item = new Item;
        $item->quantity = $quantity;
        $item->product_id = $product_id;
        $item->save();

        $item_cart = new ItemCart;
        $item_cart->item_id = $item->id;
        $item_cart->cart_id = $cart_id;
        $item_cart->save();

        return $item->id;
    }

    public function get_items_from_cart(int $cart_id)
    {
        if (!$cart_id) {
            return Collection::empty();
        }

        $items = Cart::join('item_carts', 'carts.id', '=', 'item_carts.cart_id')
            ->join('items', 'item_carts.item_id', '=', 'items.id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('carts.id', '=', $cart_id)
            ->get([
                'carts.id AS cart_id',
                'items.id AS item_id',
                'items.quantity',
                'products.id AS product_id',
                'products.product_name',
                'products.product_flavor',
                'products.price',
                'brands.brand_name',
                'brands.brand_logo_path',
            ]);

        return $items;
    }

    public function remove_item_from_cart(int $item_id, int $cart_id): bool
    {
        if (!$item_id || !$cart_id) {
            return false;
        }

        $item_cart = ItemCart::where('item_id', '=', $item_id)->firstOrFail();
        $item_cart->delete();

        $item = Item::find($item_id);
        $item->delete();

        $item_cart = ItemCart::where('cart_id', '=', $cart_id)->first();
        if (!$item_cart) {
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return true;
    }

    public function update_item_quantity(int $item_id, int $new_quantity): bool
    {
        if (!$item_id || !$new_quantity) {
            return false;
        }

        $item = Item::find($item_id);
        $item->quantity = $new_quantity;
        $item->save();

        return true;
    }
}