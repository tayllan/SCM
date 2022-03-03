import axios from 'axios';

export const CartService = {
    addItemToCart: async (product_id, quantity, cart_id) => {
        return (await axios.post('http://localhost:8000/api/cart', {
            'product_id': product_id,
            'quantity': quantity,
            'cart_id': cart_id,
        })).data
    },
    listCartItems: async (cart_id) => {
        return (await axios.get(`http://localhost:8000/api/cart/${cart_id}`)).data
    },
    removeItemFromCart: async (item_id, cart_id) => {
        return (await axios.delete('http://localhost:8000/api/item', {
            data: {
                'item_id': item_id,
                'cart_id': cart_id,
            }
        })).data
    },
    checkout: async (cart_id) => {
        return (await axios.post('http://localhost:8000/api/checkout', {
            'cart_id': cart_id,
        })).data
    },
}