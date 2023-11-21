


export default class StripeJsPaymentIntent {
    amount:number = 0;
    currency:string = 'usd';
    description: string = '';
    payment_method: string = '';


    constructor(amount: number, currency: string = 'usd', description: string = '') {
        this.amount = amount;
        this.currency = currency;
        this.description = description;
    }
}
