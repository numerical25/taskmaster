<script lang="ts">
import {defineComponent, onBeforeMount, ref} from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import { StripeElements, StripeElement } from 'vue-stripe-js';
import Card from "primevue/card";
import InputText from "primevue/inputtext";
import Button from 'primevue/button';
import ToggleButton from 'primevue/togglebutton';
import Address from "../../../models/Address.js";
import Checkout from "../../../models/Checkout.js";
import StripeJsAddress from "../../../models/StripeJsAddress.js";

export default defineComponent({
    name: "Checkout",
    components: {
        StripeElements,
        StripeElement,
        Card,
        InputText,
        Button,
        ToggleButton
    },
    setup() {
        const stripeKey = ref('pk_test_51HmfvEJYfVQAz0AAXrdBBYDjubviA9ZW6L82Fruij8CP2yjwmkyo52dAINRbHPDTYmRKsSDhIzIbrFqgGzaMuzOX001JHpvWWg');
        const cardOptions = ref({
            // https://stripe.com/docs/stripe.js#element-options
        });
        const instanceOptions = ref({
            // https://stripe.com/docs/js/initializing#init_stripe_js-options
        })
        const elementsOptions = ref({
            // https://stripe.com/docs/js/elements_object/create#stripe_elements-options
        })
        const stripeLoaded = ref(false);
        const card = ref();
        const elms = ref();
        onBeforeMount(() => {
            const stripePromise = loadStripe('pk_test_51HmfvEJYfVQAz0AAXrdBBYDjubviA9ZW6L82Fruij8CP2yjwmkyo52dAINRbHPDTYmRKsSDhIzIbrFqgGzaMuzOX001JHpvWWg');
            stripePromise.then(() => {
                stripeLoaded.value = true
            });
        });
        return {
            stripeKey,
            stripeLoaded,
            instanceOptions,
            elementsOptions,
            cardOptions,
            card,
            elms,
        }
    },
    data() {
        return {
            checkout: new Checkout(),
        }
    },
    methods: {
        pay() {
            const cardElement = this.card.stripeElement;
            // Access instance methods, e.g. createToken()
            let billingAddress = new StripeJsAddress('Joe Smoe', this.checkout.billingAddress);
            if(this.checkout.sameAsBilling){
                billingAddress = new StripeJsAddress('Joe Smoe', this.checkout.shippingAddress);
            }
            this.elms.instance.createToken(cardElement,billingAddress).then((result) => {
                // Handle result.error or result.token
                console.log(result)
            });
        }
    }
});
</script>

<template>
<div class="px-5 pt-4">
    <Card class="mb-2">
        <template #content>
            <h1 class="font-bold text-5xl">Checkout</h1>
        </template>
    </Card>
    <form class="w-full">
        <Card class="mb-5">
            <template #content>
                <div>
                    <h1 class="font-bold text-4xl">Shipping</h1>
                    <div class="col-span-2">
                        <label name="address">Shipping Address</label>
                        <InputText type="text" class="w-full" v-model="checkout.shippingAddress.address" for="address" />
                    </div>
                    <div class="flex">
                        <div class="w-[calc(100%-2rem)] mr-4">
                            <label>Shipping City</label>
                            <InputText type="text" class="w-full" v-model="checkout.shippingAddress.city"  />
                        </div>
                        <div class="w-32 mr-4">
                            <label>Ship State</label>
                            <InputText type="text" class="w-full" v-model="checkout.shippingAddress.state" />
                        </div>
                        <div class="w-32">
                            <label>Shipping Zip</label>
                            <InputText type="text" class="w-full" v-model="checkout.shippingAddress.postalCode" />
                        </div>
                    </div>
                </div>
            </template>
        </Card>
        <div class="flex items-center">
            <ToggleButton v-model="checkout.sameAsBilling" class="mr-5" /> <span>Same as Billing ?</span>
        </div>
        <Card class="mt-4">
            <template #content>
                <div>
                    <h1 class="font-bold text-4xl mt-3">Billing</h1>
                    <div class="col-span-2">
                        <label name="address">Billing Address</label>
                        <InputText v-model="checkout.billingAddress.address" type="text" class="w-full" />
                    </div>
                    <div class="flex">
                        <div class="w-[calc(100%-2rem)] mr-4">
                            <label>Billing City</label>
                            <InputText v-model="checkout.billingAddress.city" type="text" class="w-full" />
                        </div>
                        <div class="w-32 mr-4">
                            <label>Billing State</label>
                            <InputText type="text" v-model="checkout.billingAddress.state" class="w-full" />
                        </div>
                        <div class="w-32">
                            <label>Billing Zip</label>
                            <InputText type="text" v-model="checkout.billingAddress.postalCode" class="w-full" />
                        </div>
                    </div>
                </div>
            </template>
        </Card>
    </form>
    <Card class="mt-4">
        <template #content>
            <StripeElements
                v-if="stripeLoaded"
                v-slot="{ elements, instance }"
                class="py-8"
                ref="elms"
                :stripe-key="stripeKey"
                :instance-options="instanceOptions"
                :elements-options="elementsOptions"
            >
                <StripeElement
                    ref="card"
                    :elements="elements"
                    :options="cardOptions"
                />
            </StripeElements>
        </template>
    </Card>
    <div class="flex justify-between my-7">
        <router-link :to="{name: 'cart'}"><Button label="Cart" /></router-link>
        <Button  label="Pay" @click="pay" icon="pi pi-check" />
    </div>
</div>
</template>

<style scoped>

</style>
