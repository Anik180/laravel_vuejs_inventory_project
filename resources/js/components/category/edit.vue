<template>
   <div>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Categories</li>
      </ol>
      <!-- Icon Cards-->
      <div class="card-header">
         <router-link class="btn btn-info" to="/supplier" style="float: right;"><i class="fas fa-globe"></i>All Category</router-link>
         <h5>Update Category</h5>
      </div>
      <div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded">
         <form @submit.prevent="categoryUpdate">
            <div class="row">
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                  <label >Category Name</label>
                  <input type="text" v-model="form.category_name" class="form-control"  >
               </div>
               
               <div class="col-md-3"></div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
         </form>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
   </div>
   </div>
   </div>
</template>
<script>
   export default {
    mounted(){
           if (!User.loggedIn()) {
              this.$router.push({ name:'/' })
           } 
       },
       data(){
        return{
          form:{
            category_name :''
          },
          errors:{},
        }
       },
       created(){
        let id = this.$route.params.id
        axios.get('/api/category/'+id)
        .then(({data}) => (this.form = data))
        .catch()
       },
       methods:{  
        categoryUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/category/'+id,this.form)
          .then(() => {
            this.$router.push({ name: 'category' })
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        },
        
       }
   } 
</script>
<style>
 
</style>