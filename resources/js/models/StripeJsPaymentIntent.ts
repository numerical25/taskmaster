import Checkout from "./Checkout";


export default class StripeJsPaymentIntent {
    amount:number = 0;
    currency:string = 'usd';
    description: string = '';
    payment_method: string = '';
    checkout: Checkout;


    constructor(amount: number, currency: string = 'usd', description: string = '',
                payment_method: string = '') {
        this.amount = amount;
        this.currency = currency;
        this.description = description;
        this.payment_method = payment_method;
    }
}
