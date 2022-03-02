<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\CartService;
use App\Services\EmailService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart_service;

    public function __construct(CartService $cart_service)
    {
        $this->cart_service = $cart_service;
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id') ?? 0;
        $quantity = $request->input('quantity') ?? 0;
        $cart_id = $request->input('cart_id');

        $result = $this->cart_service->add_item_to_cart($product_id, $quantity, $cart_id);

        if (!$result) {
            return response('Bad Request', 400);
        }

        return response($result, 201);
    }

    public function show(int $cart_id)
    {
        return $this->cart_service->get_items_from_cart($cart_id);
    }

    public function update(Request $request)
    {
        $item_id = $request->input('item_id');
        $quantity = $request->input('quantity');

        $item = Item::find($item_id);
        $item->quantity = $quantity;
        $item->save();

        return true;
    }

    public function destroy(Request $request)
    {
        $item_id = $request->input('item_id');
        $cart_id = $request->input('cart_id');

        $result = $this->cart_service->remove_item_from_cart($item_id, $cart_id);

        if (!$result) {
            return response('Bad Request', 400);
        }

        return response($result, 200);
    }

    public function checkout(Request $request)
    {
        $cart_id = $request->input('cart_id');

        $result = $this->cart_service->checkout($cart_id);
        if (!$result) {
            return response('Bad Request', 400);
        }

        return response($result, 201);
    }
}
