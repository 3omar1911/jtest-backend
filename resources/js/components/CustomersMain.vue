<template>
    <div class="mt-5">
        <Filters></Filters>
    </div>
</template>

<script>
import Filters from './Customers/Filters.vue';

export default {
    components: {
        Filters
    },
    data() {
        return {
            countries: [
                {
                    value: null,
                    text: 'all'
                },                
            ],
            states: [
                {
                    value: null,
                    text: 'all'
                },
                {
                    value: "valid",
                    text: "validate phone numbers"
                },
                {
                    value: "invalid",
                    text: "invalidate phone numbers"                    
                },
            ],

            page: 1,
            totalPages: 1,
            customers: [],
            pageCustomers: [],
        }
    },

    mounted() {
        this.fetchCountries();
        this.fetchCustomers();
    },

    methods: {
        fetchCountries() {
        },

        fetchCustomers() {

        }
    }
}
</script>