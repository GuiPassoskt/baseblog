<template>
    <div class="admin-layout-wrap">
        <div class="admin-sidebar" :class="{'is-mobile-open' : isMobileOpenMenu}">
            <b-menu>
                <b-menu-list label="Menu">
                    <b-menu-item :active="$route.name == 'posts'" icon="border-color" label="Publicações" tag="router-link" :to="{name: 'posts'}"></b-menu-item>
                    <b-menu-item :active="$route.name == 'products'" icon="information-outline" label="Produtos" tag="router-link" :to="{name: 'products'}"></b-menu-item>
                    <b-menu-item :active="$route.name == 'categories'" icon="menu" label="Categorias" tag="router-link" :to="{name: 'product_categories'}"></b-menu-item>
                    <b-menu-item @click="logout" icon="arrow-left" label="Sair"></b-menu-item>
                </b-menu-list>
            </b-menu>
        </div>
        <div class="admin-content">
            <a :class="{'is-flip-180' : isMobileOpenMenu}" class="has-text-dark mobile-menu-control is-hidden-tablet" @click="isMobileOpenMenu = !isMobileOpenMenu">
                <b-icon icon="chevron-right" size="is-large"></b-icon>
            </a>
            <transition name="route-transaction" mode="out-in">
                <router-view :key="$router.name"/>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    name: "admin-layout",
    props: {
        title: String,
        icon: String,
    },
    data() {
        return {
            isMobileOpenMenu: false,
        }
    },

    methods: {
        logout() {
            window.localStorage.removeItem('api_token');
            this.$router.push({name: 'login'})
        }
    },

    watch: {
        "$route" () {
          this.isMobileOpenMenu = false;  
        }
    }
};
</script>
