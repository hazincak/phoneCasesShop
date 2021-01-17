<template>
    <div class="container" >
        <b-breadcrumb>
            <router-link class="breadcrumb-link" :to="{name: 'home'}"> <i class="fas fa-home"></i> Home/</router-link>
            <b-breadcrumb-item active>Registration</b-breadcrumb-item>
        </b-breadcrumb>
        <div class="row">
            <div class="col-md-6 my-center">
                <h2 class="underlined-header mb-3">Registration</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Name</label>
                            <input
                            type="text"
                            class="form-control"
                            v-model="user.first_name"
                            name="first_name"
                            placeholder="First name"
                            :class="[{'is-invalid': errorFor('first_name')}]"
                             >
                             <v-errors :errors="errorFor('first_name')"></v-errors>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Surname</label>
                            <input
                            type="text"
                            class="form-control"
                            v-model="user.last_name"
                            name="last_name"
                            placeholder="Surname"
                            :class="[{'is-invalid': errorFor('last_name')}]"
                            >
                            <v-errors :errors="errorFor('last_name')"></v-errors>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" placeholder="E-mail" class="form-control" v-model="user.email" :class="[{'is-invalid': errorFor('email')}]">
                                <v-errors :errors="errorFor('email')"></v-errors>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Phone number</label>
                            <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" v-model="user.phone_number" :class="[{'is-invalid': errorFor('phone_number')}]">
                                <v-errors :errors="errorFor('phone_number')"></v-errors>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Street</label>
                        <input
                        type="text"
                        class="form-control"
                        v-model="user.street"
                        name="street"
                        placeholder="Street name and number"
                        :class="[{'is-invalid': errorFor('street')}]"
                        >
                        <v-errors :errors="errorFor('street')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input
                        type="text"
                        class="form-control"
                        v-model="user.city"
                        name="city"
                        placeholder="City"
                        :class="[{'is-invalid': errorFor('city')}]"
                        >
                        <v-errors :errors="errorFor('city')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 form-group">
                  <div class="input-group-prepend">
                    <label for="county">County</label>
                  </div>
                  <select class="custom-select"  v-model="user.county" :class="[{'is-invalid': errorFor('county')}]" >
                    <option disabled value="">Select your county</option>
                    <option>Antrim</option>
                    <option >Armagh</option>
                    <option> Carlow</option>
                    <option> Cavan</option>
                    <option> Clare</option>
                    <option> Cork</option>
                    <option> Donegal</option>
                    <option> Down</option>
                    <option> Dublin</option>
                    <option> Fermanagh</option>
                    <option> Galway</option>
                    <option> Kerry</option>
                    <option> Kildare</option>
                    <option> Kilkenny</option>
                    <option> Laois</option>
                    <option> Leitrim</option>
                    <option> Limerick</option>
                    <option> Londonderry</option>
                    <option> Longford</option>
                    <option> Louth</option>
                    <option> Mayo</option>
                    <option> Meath</option>
                    <option> Monaghan</option>
                    <option> Offaly</option>
                    <option> Roscommon</option>
                    <option> Sligo</option>
                    <option> Tipperary</option>
                    <option> Tyrone</option>
                    <option> Waterford</option>
                    <option> Westmeath</option>
                    <option> Wexford</option>
                    <option> Wicklow</option>
                  </select>
                  <v-errors :errors="errorFor('county')"></v-errors>
                </div>
                <div class="col-md-5 form-group" >
                        <label for="zip">Eircode</label>
                        <input
                        type="text"
                        class="form-control"
                        v-model="user.zip"
                        name="zip"
                        placeholder="Eircode number"
                        :class="[{'is-invalid': errorFor('zip')}]"
                        >
                        <v-errors :errors="errorFor('zip')"></v-errors>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control" v-model="user.password" :class="[{'is-invalid': errorFor('password')}]">
                        <v-errors :errors="errorFor('password')"></v-errors>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password confirmation</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" class="form-control" v-model="user.password_confirmation" :class="[{'is-invalid': errorFor('password_confirmation')}]">
                        <v-errors :errors="errorFor('password_confirmation')"></v-errors>
                </div>
                <div class="dropdown-divider"></div>
                <button type="submit" class="button button--block button--teal button--squared" :disabled="loading" @click.prevent="register">Register <i class="fas fa-check-double"></i></button>
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
            phone_number: null,
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
                    this.$router.push({ name: "home" });
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
