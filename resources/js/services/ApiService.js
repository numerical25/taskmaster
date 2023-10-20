import {API_ENDPOINT} from "../constants.js";


export default class ApiService {
    client = {};
    nextPageUrl = '';
    lastPageUrl = ''
    data = '';
    constructor() {
        this.client = axios.create({
            baseURL: API_ENDPOINT,
            timeout: 5000
        });
    }

    get(endpoint, params = {}) {
        return new Promise((resolve, reject) => {
            this.client.get(endpoint, params).then((response) => {
                this.data = response.data;
                this.nextPageUrl = response.data.data.next_page_url;
                this.lastPageUrl = response.data.data.prev_page_url;
                resolve(response);
            }, (error) => {
                reject(error);
            });
        });
    }

    next() {
        return new Promise((resolve, reject) => {
            if(this.data && this.data.next_page_url) {
                return this.get(this.data.next_page_url).then((response) => {
                    resolve(response);
                });
            }
            reject('End of Records');
        });
    }
    back() {
        return new Promise((resolve, reject) => {
            if (this.data && this.data.prev_page_url) {
                return this.get(this.data.prev_page_url).then((response) => {
                    resolve(response);
                });
            }
            reject('End of Records');
        });
    }
}
