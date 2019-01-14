
require('./bootstrap');

import _ from 'lodash'

//Material icons
import 'material-design-icons-iconfont/dist/material-design-icons.css'

//Vue
import Vue from 'vue'

//Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify);

//Vuetify styles
import 'vuetify/dist/vuetify.min.css'

//VueRouter
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Imports components
import WidgetEmployeeList from './components/employee/List'

//Routes
const routes = [
    //Employees
    { path: '/', component: WidgetEmployeeList},

]

const router = new VueRouter({
    routes
})

//Main
new Vue({
    el: '#app',
    components: {
    },
    router
}).$mount('#app');