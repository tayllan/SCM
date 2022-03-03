import './ProductList.css';
import { useState, useEffect } from 'react';
import { ProductService } from '../../services/ProductService';
import Product from '../Product/Product';

export default function ProductList({ cartId, setCartId }) {
  const [products, setProducts] = useState([])

  const fetchProducts = async () => {
    const response = await ProductService.getAllProducts()
    setProducts(response)
  }

  useEffect(() => fetchProducts(), [])

  return (
    <div className="Products">
        {products.map(product =>
            <Product cartId={cartId} setCartId={setCartId} product={product} />)
        }
    </div>
  );
}