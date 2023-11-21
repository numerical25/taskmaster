import Address from "./Address";


export default class StripeJsAddress {
    name = '';
    address_line1= '';
    address_line2= '';
    address_city= '';
    address_state= '';
    address_zip= '';
    address_country= '';


    constructor(name: string, address: Address) {
        this.name = name;
        this.address_line1 = address.address;
        this.address_line2 = address.address2;
        this.address_city = address.city;
        this.address_state = address.state;
        this.address_zip = address.postalCode;
        this.address_country = address.country;
    }
}
