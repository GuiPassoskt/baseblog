<template>
    <div >
        <div class="block has-text-right">
            <b-button icon="chevron-left" @click.prevent="back()" v-if="path">
                Voltar 
            </b-button>
            <b-upload accept="image/*" v-model="selectedFile" @input="upload()">
                <a class="button is-primary">
                    <b-icon icon="upload" size="is-small"></b-icon>
                    <span>Upload...</span>
                </a>
            </b-upload>
        </div>

        <div class="columns is-multiline" style="background-color: #f1f1f1" v-if="files.length">
            <div class="column is-3" v-for="(file, index) in files" :key="index">
                <a class="box" @click="select(file)" v-if="file.type === 'dir'">
                    <b-icon icon="folder" size="is-small"></b-icon> {{ file.name }}
                </a>
                <div v-else @click="select(file)">
                    <bg-image :src="file.url">
                        {{ file.name }}
                    </bg-image>
                </div>
            </div>
        </div>
        <b-notification :closable="false" v-else>
            Nenhum arquivo encontrado
        </b-notification>
    </div>
</template>


<script>

import api from "../services/api";

import BgImage from "../components/BgImage";

export default {
    name: 'file-manager',
    components: {BgImage},
    props: {
        files: Array
    },

    computed: 
    {
        path() {
            return this.segments.join("/");
        }
    },

    data() {
        return {
            selectedFile: null,
            segments: []
        }
    },

    methods: {
        select(file) {

            let event = 'selectImage';

            if (file.type === 'dir') {
                this.segments.push(file.name)
                this.$emit('selectDir', this.path);
            } else {
                this.$emit('selectImage', {file, path: this.path});
            }


            this.$emit('select', file);
        },

        back() {

            this.segments.pop();

            this.$emit('back', this.path);
        },

        async upload() {

            const form = new FormData();
            form.append('path', this.path);
            form.append('file', this.selectedFile, this.selectedFile.name);
            const {data: result} = await api.post(`files/upload`, form);

            this.$emit('uploaded', result);
            this.$emit('selectDir', this.path);
        }
    }

}
</script>

<style>


.filename{
    font-size: 12px;
    word-break: break-all;
    color: #fff;
    background-color: rgba(0, 0, 0, .5);
}
</style>
