import {Cart} from "../store/Cart";
import {toast} from "vue3-toastify";
import Product from "../models/Product";


export default class CartService {

    USDollar = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    });
    addToCart(product: Product) {
        Cart.dispatch('addToCart', product).then((response) => {
            toast(response, {
                autoClose: 1000,
            }); // ToastOptions
        }, (error) => {
            toast(error, {
                autoClose: 1000,
            }); // ToastOptions
        });
    }

    formatCurrency(value: number) {
        return this.USDollar.format(value);
    }
}
