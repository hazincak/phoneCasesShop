export default{
    state:{
        lastSearch:{
            from: null,
            to: null
        }
    }
}

const store = new Vuex.Store({
    state:{
        count: 0
    },
    mutations:{
        increment(state){
            state.count++
        }
    }
});