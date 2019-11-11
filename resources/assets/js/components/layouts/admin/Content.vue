<template>
    <div class="is-relative">
        <h1 class="title is-3"><b-icon :icon="icon" v-if="icon"></b-icon> {{ title }}</h1>
        <hr />
        <slot></slot>
        <b-loading :is-full-page="false" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>


<script>
export default {
    name: "admin-layout",
    props: {
        title: String,
        icon: String,
        loading: {
            type: Boolean,
            default: false,
        }
    }
};
</script>
