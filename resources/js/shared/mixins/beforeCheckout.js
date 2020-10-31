export default {
    methods: {
        setTotalPriceBreakdown(payload){
            this.$store.dispatch('setTotalPriceBreakdown', payload);
          },
        setCustomer(payload){
            this.$store.dispatch('setCustomer', payload);
          },

    }
};