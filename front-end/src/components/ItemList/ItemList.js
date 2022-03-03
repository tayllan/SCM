import './ItemList.css';
import { useNavigate } from 'react-router-dom';
import Item from '../Item/Item';

export default function ItemList({ items, cartId }) {
    let navigate = useNavigate();

    return (
        <div className="Items">
            <button onClick={() => navigate('/')}>Back</button>

            <table border="1">
                <thead>
                    <tr>
                        <td>Product Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total Price</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    {items.map(item =>
                        <Item cartId={cartId} item={item} />)
                    }
                </tbody>
            </table>
        </div>
    );
}