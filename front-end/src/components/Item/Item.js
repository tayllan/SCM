import './Item.css';
import { CartService } from '../../services/CartService';

export default function Item({ item, cartId }) {
    const removeItemFromCart = async () => {
        const response = await CartService.removeItemFromCart(item.item_id, cartId)

        // Hack because I couldn't make the component reload using only setCartId
        window.location.reload(false)
    }

    return (
        <tr className='Item'>
            <td>{item.product_name}</td>
            <td>{item.price}</td>
            <td>{item.quantity}</td>
            <td>{parseInt(item.quantity, 10) * item.price}</td>
            <td><button onClick={removeItemFromCart}>-</button></td>
        </tr>
    );
}