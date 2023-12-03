<script lang="ts">
import {defineComponent, compile, createApp} from 'vue'
import grapesjs from 'grapesjs';
import Button from "primevue/button";
import 'primevue/resources/themes/tailwind-light/theme.css';
import '/node_modules/primeflex/primeflex.css';
import 'grapesjs/dist/css/grapes.min.css';
import Header from "../../../components/layouts/Header.vue";
import TwoColumnLeft from "../../../components/layouts/TwoColumnLeft.vue";
import Footer from "../../../components/layouts/Footer.vue";
export default defineComponent({
    name: "Editor",
    data() {
        return {
            editor: null
        }
    },
    methods: {
        initializeGrapeJS() {
            const editor = grapesjs.init({
                // Your GrapeJS configuration options go here
                container: '#gjs',
                canvas: {
                    styles: [
                        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
                        'http://127.0.0.1:5173/resources/css/app.css?t=1701573737497',
                        'http://127.0.0.1:5173/node_modules/primevue/resources/themes/tailwind-light/theme.css',
                        'http://127.0.0.1:5173/node_modules/primeflex/primeflex.css'
                    ]
                }
            });
            this.editor = editor;
            let app = createApp(Header);
            let componentRoot = document.createElement('div');
            app.mount(componentRoot);
            editor.addComponents(componentRoot.outerHTML);

            app = createApp(TwoColumnLeft);
            componentRoot = document.createElement('div');
            app.mount(componentRoot);
            editor.addComponents(componentRoot.outerHTML);

            app = createApp(Footer);
            componentRoot = document.createElement('div');
            app.mount(componentRoot);
            editor.addComponents(componentRoot.outerHTML);
        },
    },
    mounted() {
        this.initializeGrapeJS();
    },
    components: {Button}
})
</script>

<template>
    <div>
        <div id="gjs"></div>
        <!-- Your other Vue components go here -->
    </div>
</template>

<style scoped>

</style>
