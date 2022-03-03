import './AddToCartButton.css';
import { useState } from 'react';
import { CartService } from '../../services/CartService';

export default function AddToCartButton({ cartId, setCartId, product }) {
    const [quantity, setQuantity] = useState([])

    const handleInput = event => setQuantity(event.target.value)

    const addItemToCart = async () => {
        const response = await CartService.addItemToCart(product.product_id, quantity, cartId)
        setCartId(response)

        // Hack because I couldn't make the component reload using only setCartId
        window.location.reload(false)
    }

    return (
        <div className="AddToCartButton">
            <input onChange={handleInput} type='number' placeholder='Quantity'></input>

            <button onClick={addItemToCart}>Add to Cart</button>
        </div>
    );
}