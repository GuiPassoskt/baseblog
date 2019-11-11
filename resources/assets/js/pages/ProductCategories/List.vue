<template>
    <admin-content title="Categorias">
        <div class="block has-text-right">
            <b-button tag="router-link" type="is-primary" :to="{name: 'product_category_create'}">Criar</b-button>
        </div>
        <div class="columns is-multiline">
            <div class="column is-12-mobile is-6-tablet is-4-desktop is-3-fullhd" v-for="product_category in product_categories.data" :key="`product_category-${product_category.id}`">
                <div class="box">
                    <bg-image :src="product_category.url_image" class="block" />
                    <h4>{{ product_category.name }}</h4>
                    <div class="has-text-right">
                        <b-button 
                            icon-left="pencil" 
                            tag="router-link" 
                            type="is-primary" 
                            :to="{name: 'product_category_edit', params: {id: product_category.id}}" />
                    </div>
                </div>
            </div>
        </div>
    </admin-content>
</template>

<script>

import api from "../../services/api";
import BgImage from "../../components/BgImage";

export default {

    components: { BgImage },

    data() {
        return {
            product_categories: {data: []},
            loading: true,
        }
    },

    created() {

        this.paginate(1);
    },

    methods: {

         async paginate (page) {

            this.loading = true;

            const params = {page};

            try{
                const {data: product_categories} = await api.get('product-categories', {params})
                this.product_categories = product_categories;

            } finally {
                this.loading = false;
            }
    
        }
    }
}
</script>