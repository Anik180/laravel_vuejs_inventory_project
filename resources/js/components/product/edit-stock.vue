<template>
   <div>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Stock</li>
      </ol>
      <!-- Icon Cards-->
      <div class="card-header">
         <router-link class="btn btn-info" to="/stock" style="float: right;"><i class="fas fa-globe"></i>Stock</router-link>
         <h5>Update Product Stock</h5>
      </div>
<div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded">

<form @submit.prevent="stockUpdate">
     <div class="row">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
    <label >Product Quantity</label>
    <input type="text" v-model="form.product_quantity" class="form-control"  placeholder="Enter Product Quantity">
  </div>

  <div class="col-md-3"></div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left:700px;">Stock Update</button>
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
             
              product_quantity:''
            },
             errors:{},
          }
        },
       created(){
        let id = this.$route.params.id
        axios.get('/api/product/'+id)
        .then(({data}) => (this.form = data))
        .catch()
       },
       methods:{  
   	stockUpdate(){
        		let id = this.$route.params.id
        		axios.post('/api/stock/update/'+id,this.form)
        		.then(() => {
        			this.$router.push({ name: 'stock' })
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        		
        	},
        
       }
   } 
</script>
<style>
 
</style>