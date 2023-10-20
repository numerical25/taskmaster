

export default class Product {
    id = '';
    name = '';
    price = 0;
    description= '';
    quantity = 1;
    image_url = '';

    constructor(product) {
        this.id = product.id;
        this.name = product.name;
        this.price = product.price;
        this.description = product.description;
        this.image_url = product.image_url;
    }
}
