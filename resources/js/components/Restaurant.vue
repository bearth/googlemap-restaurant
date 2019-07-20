<template>
    <div>
        <h1 class="text-center m-3">Google Map Restaurant <i class="fas fa-utensils" aria-hidden="true"></i></h1>
        <search-box @fetch-restaurants="fetchRestaurants"></search-box>
        <item-list v-bind:items="items" v-bind:loading="loading"></item-list>
    </div>
</template>

<script>
    import SearchBox from './SearchBox';
    import ItemList from './ItemList';

    export default {
        data() {
            return {
                items: [],
                loading: true
            }
        },

        components: {
            SearchBox,
            ItemList
        },

        methods: {
            async fetchRestaurants(value) {
                this.loading = true;
                let res = await axios.get('api/restaurants', { params: { query: value } });
                this.items = res.data.data
                this.loading = false;
            }
        }
    }
</script>
