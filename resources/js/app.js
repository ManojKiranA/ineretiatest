/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./Shared', true, /\.vue$/i);

files.keys().map(key => {
    return Vue.component(
        key
            .split('/')
            .pop()
            .split('.')[0],
        files(key).default
    );
});


import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import axios from 'axios';

import 'bootstrap'; 
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.use(InertiaApp);
Vue.use(axios);

const app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(app)