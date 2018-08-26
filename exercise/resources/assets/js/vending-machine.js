window.Vue = require('vue');

Vue.component('vending-machine-component', require('./components/VendingMachineComponent.vue'));

new Vue({
    el: '#app'
});
