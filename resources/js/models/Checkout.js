import Address from "./Address.js";


export default class Checkout {
    shippingAddress = new Address();
    billingAddress = new Address();
    sameAsBilling = false;
}
