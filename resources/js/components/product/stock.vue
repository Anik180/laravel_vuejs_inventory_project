<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Add Product</li>
        </ol>
        <div class="card-header">
               <h5>All  Product</h5>  
        </div>
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All  Product</div>

          <div class="card-body">
            <div class="table-responsive">
              
              <input type="text" v-model="searchTerm" class="form-control" style="width: 200px;" placeholder="Search"><br>
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Photo</th>
                    <th>Category</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Photo</th>
                    <th>Category</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="product in filtersearch" :key="product.id">
                    <td>{{product.product_name}}</td>
                    <td>{{product.product_code}}</td>
                    <td><img :src="product.image" id="em_photo"></td>
                     <td>{{product.category_name}}</td>
                    <td>{{product.buying_price}}</td>
                    <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Availble</span></td>
                    <td v-else=""><span class="badge badge-danger">Stock Out</span></td>
                    <td>{{product.product_quantity}}</td>
                    <td>
                     <router-link :to="{name: 'edit-stock', params:{id: product.id} }" class="btn btn-lg"><i class="far fa-edit"></i></router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

 <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
        created(){
        	this.allProduct();
        },
        data(){
          return{
            products:[],
            searchTerm: ''
          }
        },
        computed:{
          filtersearch(){
            return this.products.filter(product => {
              return product.product_name.match(this.searchTerm)
            })
          }
        },
        methods:{
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
          },
        }
    }

</script>

<style>
  
#add_new{
  float: right;
}
#em_photo{
  height: 40px;
  width: 40px;
}
</style>

