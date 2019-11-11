import Vue from 'vue';
import VueRouter from 'vue-router';
import Buefy from 'buefy'
import "../sass/app.scss";

Vue.use(VueRouter);
Vue.use(Buefy);

import "./layouts";

import App from './components/App.vue';

import Login from "./pages/Login.vue";

import ProductForm from './pages/Products/Form.vue';
import ProductList from './pages/Products/List.vue';

import PostForm from './pages/Posts/Form.vue';
import PostList from './pages/Posts/List.vue';

import ProductCategoryList from "./pages/ProductCategories/List.vue"
import ProductCategoryForm from "./pages/ProductCategories/Form.vue"

import AdminLayout from "./components/layouts/admin/Layout";


const router = new VueRouter({
    mode: 'history',
    base: '/admin',
    routes: [
        {
            path: '/',
            component: Login,
            name: 'login'
        },

        {
            path: "/",
            component: AdminLayout,
            children: [
                {
                    path: 'products',
                    name: 'products',
                    component: ProductList
                },
                {
                    path: 'product/:id/edit',
                    name: 'product_edit',
                    component: ProductForm
                },
        
                {
                    path: 'product/create',
                    name: 'product_create',
                    component: ProductForm
                },
        
        
                {
                    path: 'post/create',
                    name: 'post_create',
                    component: PostForm,
                },
        
                {
                    path: 'post/:id/edit',
                    name: 'post_edit',
                    component: PostForm,
                },
        
                {
                    path: 'posts',
                    name: 'posts',
                    component: PostList
                },

                {
                    path: 'product-categories',
                    name: 'product_categories',
                    component: ProductCategoryList,
                },

                {
                    path: 'product-categories/create',
                    name: 'product_category_create',
                    component: ProductCategoryForm,
                },

                {
                    path: 'product-categories/:id/edit',
                    name: 'product_category_edit',
                    component: ProductCategoryForm,
                }
            ]
        }
    ],
});



Vue.filter('truncate', (str, limit) => {

    if (typeof str === 'string') {
        return str.length > limit ? `${str.substr(0, limit)}...` : str;
    }
    
    return str;
})


new Vue({
    el: '#app',
    components: { App },
    router,
});