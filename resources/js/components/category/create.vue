<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Add Category</li>
        </ol>
     
<div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded ">
       <div class="card md-3">
        <div class="card-header">
        <router-link class="btn btn-info" to="/category" style="float: right;"><i class="fas fa-globe"></i>All Category</router-link> 
               <h5 > Add New Category</h5> 
            </div>
            </div>
<form @submit.prevent="categoryInsert">
  <div class="row mt-3">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
    <label >Category Name</label>
    <input type="text" v-model="form.category_name" class="form-control"  placeholder="Enter Category Name">
  </div>

  <div class="col-md-3"></div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left:700px;">Submit</button>
</form>
<div class="card-footer small text-muted mt-3">Updated yesterday at 11:59 PM</div>
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
        methods:{   
          categoryInsert(){
            axios.post('/api/category/',this.form)
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
  
#add_new{
  float: right;
}

</style>

