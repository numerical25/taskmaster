import {API_ENDPOINT} from "../constants.js";


export default class ApiService {
    client = {};
    constructor() {
        this.client = axios.create({
            baseURL: API_ENDPOINT,
            timeout: 5000
        });
    }

    get(endpoint, params = {}) {
        return new Promise((resolve, reject) => {
            this.client.get(endpoint, params).then((response) => {
                resolve(response);
            }, (error) => {
                reject(error);
            });
        });
    }
}
