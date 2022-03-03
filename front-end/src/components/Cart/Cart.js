import './Cart.css';
import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { CartService } from '../../services/CartService';
import ItemList from '../ItemList/ItemList';

export default function Cart() {
    const { id } = useParams();

    const [items, setItems] = useState([])

    const fetchItems = async () => {
        const response = await CartService.listCartItems(id)
        setItems(response)
    }

    useEffect(() => fetchItems(), [])

    const getTotalPrice = () => items
        .map(item => item.quantity * item.price)
        .reduce((acc, value) => acc + value, 0.0)

    const checkout = async () => {
        await CartService.checkout(id)

        alert('Checkout processed, thanks for shopping at Tayllan\'s Cannabis Shop!')
    }

    return (
        <div className="Cart">
            <ItemList items={items} cartId={id} />
            <p>{getTotalPrice().toFixed(2)}</p>
            <button onClick={checkout}>BUY ALL!!!</button>
        </div>
    );
}