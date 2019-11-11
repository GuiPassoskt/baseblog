<template>
    <b-pagination
        v-if="object.last_page > 1" @change="$emit('change', $event)"
        :total="object.total"
        :current.sync="object.current_page"
        :rounded="true"
        :per-page="object.per_page"
        aria-next-label="Próximo"
        aria-previous-label="Anterior"
        aria-page-label="Página"
        aria-current-label="Página Atual">
    </b-pagination>
</template>

<script>
export default {
    name: 'pagination',
    props: {
        value: Object,
    },
    data() {
        return {
            object: this.value,
        }
    },

    watch: {
        value(value) {
            this.object = value
        }
    }
}
</script>

