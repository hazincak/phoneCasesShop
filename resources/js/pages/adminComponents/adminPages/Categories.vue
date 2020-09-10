<template>
    <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
    </div>
    <div class="row" v-else>
        <div class="col-12">
         <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Registrovaní užívatelia</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Názov kategórie</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Názov kategórie</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="item in categories" :key = item.id >
                            <tr>
                        <td>{{item.id}}</td>
                        <td>{{item.category_name}}</td>
                        <td>{{item.created_at | fromNow}}</td>
                        <td>{{item.updated_at | fromNow}}</td>
                          <td><button class="btn btn-danger">Odstrániť</button></td>
                      
                        
                      </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            loading: false,
            categories: {},
        }
    },

    created(){
        this.loading = true;
        axios.get('/api/kategorie')
            .then(response =>{
                this.categories = response.data
                this.loading = false;
            });
    }
}
</script>