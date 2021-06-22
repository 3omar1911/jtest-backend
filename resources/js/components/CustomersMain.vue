<template>
    <div class="mt-5">
        <Filters @filtersUpdated="applyFilters"></Filters>
        <List :customers="customers"></List>
    </div>
</template>

<script>

import Filters from './Customers/Filters.vue';
import List from './Customers/List.vue';

export default {
    components: {
        Filters,
        List,
    },
    data() {
        return {
            customers: [],
        }
    },

    mounted() {
        this.fetchCustomers();
    },

    methods: {
        fetchCustomers(filters = {}) {
            this.axios 
                .get('api/customers', {
                    params: filters,
                })
                .then( response => {
                    if(response.status == 204) {
                        this.customers = [];
                        return;
                    }

                    this.customers = response.data.data;
                } );
        },

        applyFilters(filters) {
            this.fetchCustomers(filters);
        }
    }
}
</script>