<template>
    <div class="card">
        <div class="card-header">Filters</div>
        <div class="card-body">
            <select name="country" id="select-country">
                <option v-for="(country, index) in countries" :key="'filter_country' + index" :value="country.value" @select="updateFilters('country', country)">{{ country.text }}</option>
            </select>

            <select name="state" id="select-state" class="ml-2">
                <option v-for="(state, index) in states" :key="'filter_state' + index" :value="state.value" @select="updateFilters('state', state)">{{ state.text }}</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            countries: [
                {
                    value: null,
                    text: 'Select country'
                },
            ],
            states: [
                {
                    value: null,
                    text: 'Select phone state'
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

            appliedFilters: {
                country: null,
                state: null,
            },
        }
    },

    mounted() {
        this.fetchCountries();
    },

    methods: {
        updateFilters(filter, value) {
            this.appliedFilters[filter] = value;
        },

        fetchCountries() {
            this.axios 
                .get('api/countries')
                .then( response => {
                    this.formatCountries(response.data)
                } );
        },

        formatCountries(responseCountries) {
            for(let isoCode in responseCountries) {
                this.countries.push({
                    value: isoCode,
                    text: responseCountries[isoCode],
                });
            }
        }
    },

    watch: {
        appliedFilters(newFilters) {
            let valuedFilters = {};
            for(prop in newFilters) {
                if(newFilters[prop] === null) {
                    continue;
                }

                valuedFilters[prop] = newFilters[prop];
            }

            this.$emit('filtersChanged', valuedFilters);
        },
    }
}
</script>