import './App.css'
import { useState } from 'react';
import ProductList from './components/ProductList/ProductList'
import CartTopBar from './components/CartTopBar/CartTopBar'

function App() {
  const [cartId, setCartId] = useState(6)

  return (
    <div className="App">
      <CartTopBar cartId={cartId} setCartId={setCartId} />
      <h1>Tayllan's Cannabis Shop</h1>
      <ProductList cartId={cartId} setCartId={setCartId} />
    </div>
  )
}

export default App