<template>
    <div>
        <div v-if="loading" class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div v-else-if="!loading && items.length == 0">
            <h4>Sorry! no result you are looking for. Please try again.</h4>
        </div>
        <div v-else v-for="item in items" v-bind:key="item.id">
            <item v-bind:item="item"></item>
        </div>
    </div>
</template>

<script>
    import Item from './Item';

    export default {
        // define props
        props: ['items', 'loading'],

        // register local components
        components: {
            Item
        }
    }
</script>
