<template>
   <div>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Product</li>
      </ol>
      <!-- Icon Cards-->
      <div class="card-header">
         <router-link class="btn btn-info" to="/supplier" style="float: right;"><i class="fas fa-globe"></i>All Product</router-link>
         <h5>Update Product</h5>
      </div>
<div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded">

<form @submit.prevent="productUpdate" enctype="multipart/form-data">
  <div class="row">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    
    <label >Category Name</label>
    <select class="form-control" v-model="form.category_id">
      <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
    </select>
    <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
  </div>
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
   <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
    
    <label >Product Name</label>
    <input type="text"  v-model="form.product_name" class="form-control"  placeholder="Enter Product Name">
  </div>
  <div class="col-md-3"></div>
  </div>
    <div class="row">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
    <label >Product Code</label>
    <input type="text" v-model="form.product_code" class="form-control"  placeholder="Enter Product Code">
  </div>
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
   <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
    <label >Product Root</label>
    <input type="text"  v-model="form.root" class="form-control"  placeholder="Product Name">
  </div>
  <div class="col-md-3"></div>
  </div>
    <div class="row">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
    <label >Buying Price</label>
    <input type="text" v-model="form.buying_price" class="form-control"  placeholder="Enter Buying Price">
  </div>
   <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
    <label >Selling Price</label>
    <input type="text" v-model="form.selling_price" class="form-control"  placeholder="Enter Selling Price">
  </div>
  <div class="col-md-3"></div>
  </div>
      <div class="row">
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <label >Supplier Name</label>
    <select class="form-control" v-model="form.supplier_id">
      <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
    </select>
    <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
  </div>
   <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
    <label >Buying Date</label>
    <input type="date" v-model="form.buying_date" class="form-control"  >
  </div>
  <div class="col-md-3"></div>
  </div>
     <div class="row">
        <div class="form-group col-md-6">
    <div class="col-md-3"></div>
   <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
    <input type="file" class="btn btn-info" @change="onFileselected">
  </div>
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
 <img :src="form.image" style="height:40px; width: 40px;">
  </div>
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
    <label >Product Quantity</label>
    <input type="text" v-model="form.product_quantity" class="form-control"  placeholder="Enter Product Quantity">
  </div>

  <div class="col-md-3"></div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left:700px;">Update</button>
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
              category_id :'',
              product_name :'',
              product_code:'',
              root:'',
              buying_price :'',
              selling_price:'',
              supplier_id:'',
              buying_date:'',
              image:'',
              newphoto:'',
              product_quantity:''
            },
             errors:{},
            categories:{},
            suppliers:{},
          }
        },
       created(){
        let id = this.$route.params.id
        axios.get('/api/product/'+id)
        .then(({data}) => (this.form = data))
        .catch()

        axios.get('/api/category/')
          .then(({data}) => (this.categories = data))
          axios.get('/api/supplier/')
          .then(({data}) => (this.suppliers = data))
       },
       methods:{  
        onFileselected(event){
          let file=event.target.files[0];
          if (file.size > 1048770) {
            Notification.image_validation()
          }else{
            let reader = new FileReader();
            reader.onload = event => {
              this.form.newphoto = event.target.result
            };
            reader.readAsDataURL(file);
   
          }
        },
        productUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/product/'+id,this.form)
          .then(() => {
            this.$router.push({ name: 'product' })
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        },
        
       }
   } 
</script>
<style>
 
</style>