<template>
    <div class="card">
        <div class="card-header">Filters</div>
        <div class="card-body">
            <select name="country" id="select-country" v-model="country">
                <option v-for="(countryOption, index) in countries" :key="'filter_country' + index" :value="countryOption.value">{{ countryOption.text }}</option>
            </select>

            <select name="state" id="select-state" class="ml-2" v-model="state">
                <option v-for="(stateOption, index) in states" :key="'filter_state' + index" :value="stateOption.value">{{ stateOption.text }}</option>
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
            },

            country: null,
            state: null,
        }
    },

    mounted() {
        this.fetchCountries();
    },

    methods: {
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
        },

        updateFilters(filter, value) {
            if(value === null) {
                delete this.appliedFilters[filter];
                this.$emit('filtersUpdated', this.appliedFilters);
                return;
            }

            this.appliedFilters[filter] = value;
            this.$emit('filtersUpdated', this.appliedFilters);
        },
    },

    watch: {
        country(newCountry) {
            this.updateFilters('country_code', newCountry);
        },

        state(newState) {
            this.updateFilters('state', newState);
        }
    }
}
</script>