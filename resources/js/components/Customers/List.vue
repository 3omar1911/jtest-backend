<template>
    <div class="card mt-5 mb-5">
        <div class="card-header">Customers</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">Country Code</th>
                        <th scope="col">Phone number</th>
                    </tr>
                </thead>
                <tbody v-if="customers.length == 0">
                    <tr>
                       <td colspan="4">No Customers to display</td> 
                    </tr>
                </tbody>

                <tbody v-if="customers.length > 0">
                    <tr v-for="(customer, index) in pageCustomers" :key="'page_customer_' + page + '_' + index">
                        <td>{{ customer.country_name }}</td>
                        <td>{{ customer.is_valid | stateFilter }}</td>
                        <td>{{ customer.country_code | countryCodeFilter }}</td>
                        <td>{{ customer.phone_number }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer" style="text-align: right;">
            <button class="btn btn-primary" :disabled="page == 1" @click="updatePage(page - 1)">Previous</button>
            <button class="btn btn-primary" :disabled="page == totalPages" @click="updatePage(page + 1)">Next</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['customers'],
    
    data() {
        return {
            page: 1,
            totalPages: 1,
            customersPerPage: 5,
            pageCustomers: [],
        }
    },

    methods: {
        updatePage(pageNumber) {
            this.page = pageNumber;
            this.pageCustomers = this.customers.slice((pageNumber - 1) * this.customersPerPage, pageNumber * this.customersPerPage);
        }
    },

    watch: {
        customers() {
            this.pageCustomers = [];
            this.page = 1 ;
            this.totalPages = Math.ceil(this.customers.length / this.customersPerPage);
            if(this.customers.length == 0) {
                return;
            }

            this.updatePage(1);
        }
    },

    filters: {
        countryCodeFilter(countryCode) {
            return "+" + countryCode;
        },

        stateFilter(isValid) {
            return isValid? "OK": "NOK";
        }
    }
}
</script>