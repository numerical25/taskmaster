import Address from "./Address";


export default class StripeJsBillingDetailsAddress {
    city = '';
    country= 'US';
    line1= '';
    line2= '';
    postal_code= '';
    state= '';


    constructor(address: Address = null) {
        if(address) {
            this.city = address.city;
            this.line1 = address.address;
            this.line2 = address.address2;
            this.city = address.city;
            this.state = address.state;
            this.postal_code = address.postalCode;
            if(address.country)
                this.country = address.country;
        }
    }
}
