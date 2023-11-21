import Address from "./Address.js";


export default class Checkout {
    constructor(shippingAddress: Address = new Address(), billingAddress: Address = new Address(),
                sameAsBilling: boolean = false) {
        this.shippingAddress = shippingAddress;
        this.billingAddress = billingAddress;
        this.sameAsBilling = sameAsBilling;
    }
    shippingAddress:Address = new Address();
    billingAddress: Address = new Address();
    sameAsBilling: boolean = false;
}
