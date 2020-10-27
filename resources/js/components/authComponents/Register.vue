<template>
    <div class="container" >
        <b-breadcrumb>
            <router-link class="breadcrumb-link" :to="{name: 'domov'}"> <i class="fas fa-home"></i> Domov/</router-link>
            <b-breadcrumb-item active>Registrácia</b-breadcrumb-item>
        </b-breadcrumb>
        <h2 class="underlined-header">Registrácia</h2>    
        <div class="row ">
            <div class="col-md-6 my-center">
                <div class="row">
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Meno</label>
                            <input 
                            type="text" 
                            class="form-control" 
                            v-model="user.first_name"
                            name="first_name"
                            placeholder="Meno užívateľa"
                            :class="[{'is-invalid': errorFor('first_name')}]"
                             >
                             <v-errors :errors="errorFor('first_name')"></v-errors>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Priezvisko</label>
                            <input 
                            type="text" 
                            class="form-control" 
                            v-model="user.last_name"
                            name="last_name"
                            placeholder="Priezvisko užívateľa"
                            :class="[{'is-invalid': errorFor('last_name')}]" 
                            >
                            <v-errors :errors="errorFor('last_name')"></v-errors>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="E-mailová adresa" class="form-control" v-model="user.email" :class="[{'is-invalid': errorFor('email')}]">
                        <v-errors :errors="errorFor('email')"></v-errors>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Ulica</label>
                        <input 
                        type="text" 
                        class="form-control"
                        v-model="user.street" 
                        name="street"
                        placeholder="Názov a číslo ulice"
                        :class="[{'is-invalid': errorFor('street')}]" 
                        >
                        <v-errors :errors="errorFor('street')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">Mesto</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        v-model="user.city"
                        name="city"
                        placeholder="Mesto"
                        :class="[{'is-invalid': errorFor('city')}]" 
                        >
                        <v-errors :errors="errorFor('city')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 form-group">
                  <div class="input-group-prepend">
                    <label for="county">Kraj</label>
                  </div>
                  <select class="custom-select"  v-model="user.county" :class="[{'is-invalid': errorFor('county')}]" >
                    <option disabled value="">Vyberte kraj</option>
                    <option>Bratislavský kraj</option>
                    <option>Trnavský kraj</option>
                    <option>Trenčiansky kraj</option>
                    <option>Nitriansky kraj</option>
                    <option>Žilinský kraj</option>
                    <option>Banskobystrický kraj</option>
                    <option>Prešovský kraj</option>
                    <option>Košický kraj</option>
                  </select>
                  <v-errors :errors="errorFor('county')"></v-errors>
                </div>
                <div class="col-md-5 form-group" >
                        <label for="zip">PSČ</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        v-model="user.zip"
                        name="zip"
                        placeholder="Poštové smerovacie číslo"
                        :class="[{'is-invalid': errorFor('zip')}]" 
                        >
                        <v-errors :errors="errorFor('zip')"></v-errors>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input type="password" name="password" placeholder="Heslo" class="form-control" v-model="user.password" :class="[{'is-invalid': errorFor('password')}]">
                        <v-errors :errors="errorFor('password')"></v-errors>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Potvrdenie hesla</label>
                    <input type="password" name="password_confirmation" placeholder="Potvrdte heslo" class="form-control" v-model="user.password_confirmation" :class="[{'is-invalid': errorFor('password_confirmation')}]">
                        <v-errors :errors="errorFor('password_confirmation')"></v-errors>
                </div>
                <div class="dropdown-divider"></div>
                <button type="submit" class="button button--block button--teal button--squared" :disabled="loading" @click.prevent="register">Zaregistrovať sa <i class="fas fa-check-double"></i></button>
                <div class="dropdown-divider"></div>
            
            </div>
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
            user:{
            first_name: null,
            last_name: null,
            street: null,
            city: null,
            county: '',
            zip: null,
            email: null,
            password: null,
            password_confirmation: null
            
            },
            loading: false
        }
    },

    methods: {
        async register(){
            this.loading = true;
            this.errors = null;

            try {
               const response = await axios.post("/register", this.user);

               if(201 == response.status){
                   logIn();
                   this.$store.dispatch("loadUser");
                    this.$router.push({ name: "domov" });
               }
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
            this.loading = false;
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