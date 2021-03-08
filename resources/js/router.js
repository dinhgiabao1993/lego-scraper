import VueRouter from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'product_list',
        component: () => import(/* webpackChunkName: "product_list" */ './components/app/product/List.vue')
    },
]

export default new VueRouter({
    base: '/app',
    mode: 'history',
    routes,
})