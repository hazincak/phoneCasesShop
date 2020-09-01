<template>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <form>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" placeholder="E-mailová adresa" class="form-control" v-model="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Heslo</label>
                            <input type="password" name="password" placeholder="Heslo" class="form-control" v-model="password">
                        </div>
                        <div class="dropdown-divider"></div>

                        <button type="submit" class="button button--block button--teal button--squared">Prihlásiť sa</button>

                        <div class="dropdown-divider"></div>
                        <div class="text-center m-5">
                            Nemáte účet
                            <div>
                                <router-link :to="{name: 'home'}" class="login__link">Zaregistrovať sa</router-link>
                            </div>
                        </div>
                        <div class="text-center m-5">
                            Stratili ste heslo?
                            <div>
                            <router-link :to="{name: 'home'}" class="login__link">Resetovať heslo</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            

<!-- 
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div> -->
</template>



<script>
export default {
    data(){
        return{
            email: null,
            password: null
        }
    }
}
</script>