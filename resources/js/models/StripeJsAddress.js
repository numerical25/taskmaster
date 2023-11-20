

export default class StripeJsAddress {
    name = '';
    address_line1= '';
    address_line2= '';
    address_city= '';
    address_state= '';
    address_zip= '';
    address_country= '';


    constructor(name, address_line1, address_line2, address_city, address_state, address_zip, address_country) {
        this.name = name;
        this.address_line1 = address_line1;
        this.address_line2 = address_line2;
        this.address_city = address_city;
        this.address_state = address_state;
        this.address_zip = address_zip;
        this.address_country = address_country;
    }
}
