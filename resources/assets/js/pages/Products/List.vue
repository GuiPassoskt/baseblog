<template>
    <admin-content title="Produtos" :loading.sync="loading">
        <div>
            <div class="block has-text-right">
                <b-button tag="router-link" type="is-primary" :to="{name: 'product_create'}">Criar</b-button>
            </div>

             <pagination-info :value.sync="products" />

            <b-notification type="is-danger" :closable="false" v-if="products.total === 0">
                Nenhum produto encontrado
            </b-notification>

            <div class="columns is-multiline">
                <div class="column is-12-mobile is-6-tablet is-4-desktop is-3-fullhd" v-for="product in products.data" :key="product.id">
                    <div class="box product">
                        <div class="block is-relative">
                            <div class="category">
                                <b-tag>{{ product.product_category.name }}</b-tag>
                            </div>
                            <bg-image class="block" :src="product.image ? product.image.url : null "></bg-image>
                        </div>
                        <div class="product-body block">
                            <h4>{{ product.name }}</h4>
                            <div class="is-size-7 product-description">{{ product.description | truncate(100) }}</div>
                        </div>
                        <div class="product-footer">
                            <div class="has-text-right">
                                <b-button 
                                    outlined
                                    icon-left="delete"  
                                    type="is-danger"
                                    @click="showRemoveDialog(product, index)" />

                                <b-button 
                                    icon-left="pencil" 
                                    tag="router-link" 
                                    type="is-primary" 
                                    :to="{name: 'product_edit', params: {id: product.id}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <pagination :value.sync="products" @change="paginate" />
        </div>
    </admin-content>
</template>


<script>

import api from "../../services/api";
import BgImage from "../../components/BgImage";
import Pagination from "../../components/Pagination";
import PaginationInfo from "../../components/PaginationInfo";

export default {

    components: {BgImage, Pagination, PaginationInfo},
    name: 'product-list',


    async created () {

        await this.paginate(1)
    },

    data() {
        return {
            products: {}
        }
    },

    computed: {

        columns() {

            return [
                {field: 'name', label: 'Nome'}
            ]
        }
    },

    methods: {

        async showRemoveDialog(product, index)
        {
            this.$buefy.dialog.confirm({
                message: `Confirma a exclusão do produto <b>${product.name}</b>?`,
                onConfirm: () => this.remove(product, index),
                confirmText: 'Sim',
                cancelText: 'Não'
            });
        },

        async remove(product, index) 
        {

            this.loading = true;

            try{
                await api.delete(`/products/${product.id}`);
                this.$buefy.dialog.alert('Produto removido com sucesso')
                this.paginate(1);
            } finally {
                this.loading = false;
            }
        },

        async paginate(page)
        {
            this.loading = true;
            
            try{
                const {data: products} = await api.get('products', {params: {page}})
                this.products = products;

            } finally {
                this.loading = false;
            }
        
        }
    }
}
</script>




<style scoped lang="scss">

.product{
    height: 100%;
    display: flex;
    flex-direction: column;

    .product-image{
        width: 100%;
        height: 150PX;
        background-position: center;
        background-size: cover;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f1f1f1;
    }

    .product-body{
        flex: 1;
    }

    .category{
        position: absolute;
        right: 0;
        top: 0;
        margin: 10px 15px;
        z-index: 2;
    }
}

</style>
