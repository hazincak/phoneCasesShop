export default{
    state:{
        basket:{
            items: []
        },
    },
    mutations:{
        addToBasket(state, payload) {
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload) {
            state.basket.items = state.basket.items.filter(item => item.product.id !== payload);
        },
        setBasket(state, payload) {
            state.basket = payload;
        },
    },

    actions:{
        loadStoredState(context){
            const basket = localStorage.getItem('basket');
            if(basket) {
                context.commit('setBasket', JSON.parse(basket));
            }
        },

        addToBasket({commit, state}, payload){
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },

        removeFromBasket({commit, state}, payload){
            commit('removeFromBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        }
    },

    getters: {
        itemsInBasket: (state) => state.basket.items.length,
        inBasketAlready(state) {
            return function (id) {
                return state.basket.items.reduce(
                    (result, item) => result || item.product.id === id,
                    false
                );
            }
        }
    }   
}
