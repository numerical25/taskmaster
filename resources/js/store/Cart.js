import Vuex from "vuex";
import Product from "../models/Product.js";

export const Cart = new Vuex.Store({
  state: {
      count: 0,
      products: []
  },
    getters: {
        total() {
            return state.products.length
        },
    },
    mutations: {
        addToCart(state, data) {
            state.products.push(data);
        },
        initialiseStore(state) {
            // Check if the ID exists
            if(localStorage.getItem('cart')) {
                // Replace the state object with the stored item
                this.replaceState(
                    Object.assign(state, JSON.parse(localStorage.getItem('cart')))
                );
            }
        },
        emptyCart(state) {
            state.products = [];
        }
    },
    actions: {
      addToCart({commit, state},product) {
          return new Promise((resolve, reject) => {
              let found = state.products.some(prod => prod.id === product.id);
              if(found) {
                  reject("Product Exist");
                  return;
              }
              commit('addToCart', product);
              resolve('Product Successfully Added!');
          });
      },
        emptyCart({commit, state}) {
          return new Promise((resolve, reject) => {
              try {
                  commit('emptyCart');
                  resolve('Cart was successfully emptied');
              } catch (e) {
                  reject('Something went wrong saving data');
              }
          });
        }
    }
});
