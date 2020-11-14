import SignUpForm from './components/SignUpForm.vue'
import Vue from 'vue';

Vue.component('SignUpForm', SignUpForm);

new Vue({
    el: '#vue-app',
    render: h => h(SignUpForm),
});
