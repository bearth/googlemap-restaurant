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
            // define default items and loading
            return {
                items: [],
                loading: true
            }
        },

        // register local components
        components: {
            SearchBox,
            ItemList
        },

        methods: {
            // define fetchRestaurants method
            async fetchRestaurants(value) {
                // set loading to true when begin fetching data
                this.loading = true;
                // make api request to retrieve data according to keyword
                let res = await axios.get('api/restaurants', { params: { query: value } });
                // set items value to api response
                this.items = res.data.data
                // set loading back to false
                this.loading = false;
            }
        }
    }
</script>
