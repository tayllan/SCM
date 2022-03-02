<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Support\Collection;

class CheckoutService
{
    private EmailService $email_service;
    private UserService $user_service;

    public function __construct(EmailService $email_service, UserService $user_service)
    {
        $this->email_service = $email_service;
        $this->user_service = $user_service;
    }

    public function process_checkout(int $cart_id)
    {
        /** @var Collection $cart_items */
        $cart_items = Cart::join('item_carts', 'item_carts.cart_id', '=', 'carts.id')
            ->join('items', 'items.id', '=', 'item_carts.item_id')
            ->join('products', 'products.id', '=', 'items.product_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('carts.id', '=', $cart_id)
            ->get();

        $total_price = array_reduce($cart_items->toArray(),
            function(string $carry, $item) {
                $item_total_price = $item['quantity'] * floatval($item['price']);
                return floatval($carry) + $item_total_price;
            }, ''
        );

        $checkout = new Checkout;
        $checkout->cart_id = $cart_id;
        $checkout->total_price = $total_price;
        $checkout->save();

        $cart = Cart::find($cart_id);
        $this->send_checkout_email($cart->user_id, $total_price, $cart_items->toArray());

        return $cart_items;
    }

    private function send_checkout_email(int $user_id, string $total_price, array $items): bool
    {
        $user = $this->user_service->get_user($user_id);

        $from_address = env('MAIL_FROM_ADDRESS', 'contact@tayllan.com');
        $from_name = env('MAIL_FROM_NAME', 'Tayllan');
        $subject = 'Checkout complete';
        $user_name = $user->name;
        $user_email = 'tayllan@pistildata.com';

        $data = [
            'from_address' => $from_address,
            'from_name' => $from_name,
            'subject' => $subject,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'total_price' => $total_price,
            'items' => $items,
        ];

        $this->email_service->send_email($data);

        return true;
    }
}