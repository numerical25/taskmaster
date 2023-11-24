



export default class ImageService {


    product_url(image_name: string = '') : string {
        if(image_name)
            return `/images/test/products/${image_name}`;
    }
}
