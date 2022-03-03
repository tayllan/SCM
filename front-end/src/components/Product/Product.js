import AddToCartButton from '../AddToCartButton/AddToCartButton';
import './Product.css';

export default function Product({ cartId, setCartId, product }) {
    return (
        <div className="Product">
            <li>{product.product_name}</li>
            <li>{product.brand_name}</li>
            <li>${product.price}</li>

            <AddToCartButton cartId={cartId} setCartId={setCartId} product={product} />
        </div>
    );
}