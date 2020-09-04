<template>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div v-if="!isLoggedIn">
                        <form>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" placeholder="E-mailová adresa" class="form-control" v-model="email" :class="[{'is-invalid': errorFor('email')}]">
                                    <v-errors :errors="errorFor('email')"></v-errors>
                            </div>
                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input type="password" name="password" placeholder="Heslo" class="form-control" v-model="password" :class="[{'is-invalid': errorFor('password')}]">
                                    <v-errors :errors="errorFor('password')"></v-errors>
                            </div>
                            <div class="dropdown-divider"></div>

                            <button type="submit" class="button button--block button--teal button--squared" :disabled="loading" @click.prevent="login">Prihlásiť sa <i class="fas fa-sign-in-alt"></i></button>

                            <div class="dropdown-divider"></div>
                            <div class="text-center m-5">
                                Nemáte účet
                                <div>
                                    <router-link :to="{name: 'register'}" class="login__link">Zaregistrovať sa</router-link>
                                </div>
                            </div>
                            <div class="text-center m-5">
                                Stratili ste heslo?
                                <div>
                                <router-link :to="{name: 'domov'}" class="login__link">Resetovať heslo</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div v-else>
                        <div class="text-center"><router-link to="">Profile <i class="far fa-id-card"></i></router-link></div>
                        <div class="text-center"><router-link to="">História objednávok <i class="fas fa-list"></i></router-link></div>

                        <div class="dropdown-divider"></div>
                        <button class="button button--block button--teal button--squared" @click.prevent="logout">Odhlásiť sa <i class="fas fa-sign-out-alt"></i></button>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
            
</template>



<script>
import validationErrors from "../../shared/mixins/validationErrors";
import {mapState ,mapGetters} from "vuex";
import {logIn} from "../../shared/utils/auth";
export default {
    mixins: [validationErrors],
    data(){
        return{
            email: null,
            password: null,
            loading: false
        }
    },

    methods: {
        async login(){
            this.loading = true;
            this.errors = null;
            try {
                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/login", {
                email: 	this.email,
                password: this.password
        });
            logIn();
            this.$store.dispatch("loadUser");
            // this.$router.push({name: "domov"});
            } catch (error) {
               
                    this.errors = error.response && error.response.data.errors;
                
                
            }

            this.loading = false;
        },

        async logout() {
            try {
                axios.post("/logout");
                this.$store.dispatch("logout");
            } catch (error) {
                this.$store.dispatch("logout");
            }
        }
    },

    computed: {
        ...mapState({
           isLoggedIn: "isLoggedIn" 
        }),

        ...mapGetters({
            itemsInBasket: "itemsInBasket"
        })
    }
}
</script>