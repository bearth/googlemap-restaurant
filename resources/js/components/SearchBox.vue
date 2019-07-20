<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input class="form-control" v-model="keyword" type="text" placeholder="Find new restaurants" aria-label="Search" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            // define default keyword
            return {
                keyword: 'Bangsue'
            }
        },

        created() {
            // emit fetch-restaurants event with default keyword "Bangsue" when component get created
            this.$emit('fetch-restaurants', this.keyword);
        },

        methods: {
            // emit fetch-restaurants event with input keyword when submit form
            onSubmit() {
                this.$emit('fetch-restaurants', this.keyword);
            }
        }
    }
</script>
