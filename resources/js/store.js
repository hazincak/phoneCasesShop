import { isLoggedIn, logOut } from "./shared/utils/auth";

export default{
    state:{
        basket:{
            items: []
        },
        isLoggedIn: false,
        user:{

        }
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
        setUser(state, payload){
            state.user = payload;
        },
        setLoggedIn(state, payload){
            state.isLoggedIn = payload;
        }
    

    },

    actions:{
        loadStoredState(context){
            const basket = localStorage.getItem('basket');
            if(basket) {
                context.commit('setBasket', JSON.parse(basket));
            }

            context.commit("setLoggedIn", isLoggedIn());
        },



        addToBasket({commit, state}, payload){
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },

        removeFromBasket({commit, state}, payload){
            commit('removeFromBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },

        async loadUser({commit, dispatch}){
            if(isLoggedIn()){
                try {
                    const user =  (await axios.get('/user')).data;
                    commit("setUser", user);
                    commit("setLoggedIn", true);
                } catch (error) {
                    dispatch("logout");
                }
            }
        },

        logout({commit}) {
            commit("setUser", {});
            commit("setLoggedIn", false);
            logOut();
        }
    },

    getters: {
        itemsInBasket: (state) => state.basket.items.length,
        totalPrice (state) {
                return state.basket.items.reduce(function(prev, cur){
                    return prev + cur.product.price;
                },0)
        },
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
