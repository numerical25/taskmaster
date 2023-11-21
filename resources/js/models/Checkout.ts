import Address from "./Address.js";


export default class Checkout {
    shippingAddress:Address = new Address();
    billingAddress: Address = new Address();
    sameAsBilling: boolean = false;
}
