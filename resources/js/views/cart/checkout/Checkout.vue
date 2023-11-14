<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Checkout",
    setup() {
        var stripe = Stripe('pk_test_51HmfvEJYfVQAz0AAXrdBBYDjubviA9ZW6L82Fruij8CP2yjwmkyo52dAINRbHPDTYmRKsSDhIzIbrFqgGzaMuzOX001JHpvWWg');
        const appearance = {};
        // const options = { /* options */ };
        // const clientSecret = 'sk_test_51HmfvEJYfVQAz0AAbYhEKlQEnwsnipwyrVXFnvDDuKybUJDVr9jCq5ZUIoEFXsM6a5hdAgYb8uPGYR7myQwViMZE00byS5p2xf';
        // const elements = stripe.elements({clientSecret , appearance});
        // const paymentElement = elements.create('payment', {});
        // paymentElement.mount('#payment');
    }
})
</script>

<template>
<div class="px-5 pt-4">
    <h1 class="font-bold text-5xl">Checkout</h1>
    <form class="w-full">
        <div class="border-gray-200 rounded border-2 p-2 mt-2">
            <h1 class="font-bold text-4xl">Shipping</h1>
            <div class="col-span-2">
                <label name="address">Shipping Address</label>
                <input type="text" class="text-box-primary" for="address" />
            </div>
            <div class="flex">
                <div class="w-[calc(100%-2rem)] mr-4">
                    <label>Shipping City</label>
                    <input type="text" class="text-box-primary" />
                </div>
                <div class="w-32 mr-4">
                    <label>Shipping State</label>
                    <input type="text" class="text-box-primary" />
                </div>
                <div class="w-32">
                    <label>Shipping Zip</label>
                    <input type="text" class="text-box-primary" />
                </div>
            </div>
        </div>
        <div class="border-gray-200 rounded border-2 p-2 mt-3">
            <h1 class="font-bold text-4xl mt-3">Billing</h1>
            <div class="col-span-2">
                <label name="address">Billing Address</label>
                <input type="text" class="text-box-primary" for="address" />
            </div>
            <div class="flex">
                <div class="w-[calc(100%-2rem)] mr-4">
                    <label>Billing City</label>
                    <input type="text" class="text-box-primary" />
                </div>
                <div class="w-32 mr-4">
                    <label>Billing State</label>
                    <input type="text" class="text-box-primary" />
                </div>
                <div class="w-32">
                    <label>Billing Zip</label>
                    <input type="text" class="text-box-primary" />
                </div>
            </div>
        </div>
    </form>
    <div id="payment"></div>
</div>
</template>

<style scoped>

</style>
