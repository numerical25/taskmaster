import Address from "./Address";
import StripeJsBillingDetailsAddress from "./StripeJsBillingDetailsAddress";


export default class StripeJsBillingDetails {
    address: StripeJsBillingDetailsAddress;
    email: string = '';
    name: string  = '';
    phone:string  = '';


    constructor(name: string = '', email: string = '', phone: string = '', address: Address) {
        this.name = name;
        this.address = new StripeJsBillingDetailsAddress(address);
        this.email = email;
        this.phone = phone;
    }
}
