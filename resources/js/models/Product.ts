

export default class Product {
    id: string = '';
    name: string = '';
    price: number = 0;
    description: string= '';
    quantity: number = 1;
    image_url: string = '';

    constructor(product: Product) {
        this.id = product.id;
        this.name = product.name;
        this.price = product.price;
        this.description = product.description;
        this.image_url = product.image_url;
    }
}
