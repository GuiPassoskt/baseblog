<template>
    <admin-content :title="product.id ? 'Editar Produto' : 'Criar Produto'">

        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box">
                    <b-field label="Nome do produto">
                        <b-input v-model="product.name" maxlength="255">
                        </b-input>
                    </b-field>

                    <b-field label='Categoria'>
                        <b-autocomplete
                            v-model="product.product_category.name"
                            :data="product_categories"
                            placeholder="e.g. Fight Club"
                            field="name"
                            :loading="product_categories_loading"
                            @typing="loadProductCategories"
                            @select="item => product.product_category_id = item ? item.id : null">

                        </b-autocomplete>
                    </b-field>
                    
                    <b-field label='Descrição'>
                        <b-input type="textarea" v-model="product.description"></b-input>
                    </b-field>
                    <div class="has-text-right">
                        <b-button @click="save" :loading="loading" type="is-primary">Salvar</b-button>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="box center-xs">
                    <b-field label="Escolha a imagem do produto">
                        <b-upload class="is-fullwidth" v-model="selectedFile" @input="selectImage(selectedFile)" accept="image/*">
                            <b-button type="is-primary" class="is-full-width" tag="a" :loading="uploading">
                                <b-icon icon="upload" size="is-small"></b-icon>
                                <span>Selecionar imagem...</span>
                            </b-button>
                        </b-upload>
                    </b-field>
                    <bg-image :src="imageUrl" v-if="imageUrl" height="350px" >
                        <div>(Pré-Visualização)</div>
                    </bg-image> 
                </div>
            </div>
        </div>
        
    </admin-content>
</template>


<script>

import BgImage from "../../components/BgImage";

import api from "../../services/api";

export default {

    components: {BgImage},

    created() {
        this.loadInfo();
    },

    computed: 
    {
        labels() {
            return {title: 'Título', subtitle: 'Subtítulo', text: 'Texto', list: 'Lista'};
        }
    },
    
    data() 
    {
        return {
            product: {
                name: null,
                product_category: {name: null},
                description: null,
                product_category_id: null,
            },
            loading: false,
            selectedFile: null,
            uploading: false,
            imageUrl: null,
            product_categories: [],
            product_categories_loading: false,
        }
    },

    methods: {

        async loadInfo() {

            if (! this.$route.params.id) return;
            
            const {data: product} = await api.get(`products/${this.$route.params.id}`);
    
            this.product = {...product};
        
            if (this.product.image) {
                this.imageUrl = this.product.image.url;
            }
            
        },

        async save() {

            let result;

            if (this.product.id) {

                ({data: result} = await api.put(`products/${this.product.id}`, this.product))

            } else {

                ({data: result} = await api.post(`products`, this.product))

                this.product = result;


                await this.uploadImage();

                this.$router.replace({name: 'product_edit', params: {id: result.id}});
            }

            this.$buefy.toast.open({
                message: 'Produto salvo com sucesso!',
                type: 'is-primary',
                position: 'is-bottom-right'
            })

        },


        selectImage(file) {

            this.imageUrl = window.URL.createObjectURL(file);

            this.product.id && this.uploadImage(file);
        },

        async uploadImage() {

            if (! this.selectedFile) return;

            this.uploading = true;

            const form = new FormData();

            form.append('image', this.selectedFile, this.selectedFile.name)
            form.append('product_id', this.product.id);

            try{
                await api.post('product-images', form);
            } finally{
                this.uploading = false;
            }

            this.loadInfo();

            this.$buefy.toast.open({
                message: 'Imagem enviada com sucesso!',
                type: 'is-primary',
                position: 'is-bottom-right'
            })
        },

        async loadProductCategories(name) {

            console.log(name)

            if (this.product_categories_loading) return;

            this.product_categories_loading = true;

            const params = {'contains[name]' : name };

            try{
                const {data: product_categories} = await api.get('product-categories', {params})
                this.product_categories = product_categories.data;
            } finally {
                this.product_categories_loading = false;
            }
        }
    },

    watch: {
        '$route' (route) {
            this.loadInfo()
        }
    }
}
</script>


<style scoped>
#app{
    justify-content: center;
}
.image{
    height: 200px;
    width: 100%;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px 1px #666;
    border-radius: 4px;
    background-position: center;
    background-size: cover;
}
</style>
