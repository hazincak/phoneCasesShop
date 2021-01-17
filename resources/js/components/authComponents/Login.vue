<template>
            <div class="dropdown-menu dropdown-menu-right p-4" aria-labelledby="navbarDropdown">
                    <div v-if="!isLoggedIn">
                        <form>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" placeholder="E-mail" class="form-control" v-model="email" :class="[{'is-invalid': errorFor('email')}]">
                                    <v-errors :errors="errorFor('email')"></v-errors>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control" v-model="password" :class="[{'is-invalid': errorFor('password')}]">
                                    <v-errors :errors="errorFor('password')"></v-errors>
                            </div>
                            <div class="dropdown-divider"></div>

                            <button type="submit" class="button button--block button--teal button--squared" :disabled="loading" @click.prevent="login">Login <i class="fas fa-sign-in-alt"></i></button>

                            <div class="dropdown-divider"></div>
                            <div class="text-center m-5">
                                No account?
                                <div>
                                    <router-link :to="{name: 'register'}" class="login__link">Register</router-link>
                                </div>
                            </div>
                            <div class="text-center m-5">
                                Forgot your password?
                                <div>
                                <router-link :to="{name: 'home'}" class="login__link">Reset password</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div v-else>
                        <div v-if="isUserAdmin">
                            <div class="text-center"><router-link :to="{name: 'BrandsDashboard'}">Admin <i class="fas fa-user-shield"></i></router-link></div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button class="button button--block button--teal button--squared" @click.prevent="logout">Logout <i class="fas fa-sign-out-alt"></i></button>
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
            itemsInBasket: "itemsInBasket",
            isUserAdmin:  "isUserAdmin"
        })
    }
}
</script>
