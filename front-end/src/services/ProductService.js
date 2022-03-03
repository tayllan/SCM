import axios from 'axios';

export const ProductService = {
    getAllProducts: async () => {
        return (await axios.get('http://localhost:8000/api/product')).data
    }
}