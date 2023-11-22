import Checkout from "./Checkout";


export default class PaymentRequest {
    amount: number = 0;
    currency: string = 'usd';
    payment_method: string = '';
    checkout: Checkout;
}
