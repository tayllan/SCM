import './CartTopBar.css';
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { CartService } from '../../services/CartService';

export default function CartTopBar({ cartId }) {
    const [items, setItems] = useState([])

    const fetchItems = async () => {
        const response = await CartService.listCartItems(cartId)
        setItems(response)
    }

    useEffect(() => fetchItems(), [])

    return (
        <div className='CartTopBar'>
            <Link to={`/cart/${cartId}`}>{items.length}</Link>
        </div>
    );
}