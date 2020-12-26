<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Add Product</li>
        </ol>
        <div class="card-header">
              <router-link class="btn btn-info" to="/store-product" style="float: right;"><i class="fas fa-plus-circle"></i>Add Product</router-link>
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
                    <th>Selling Price</th>
                    <th>Root</th>
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
                    <th>Selling Price</th>
                    <th>Root</th>
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
                    <td>{{product.selling_price}}</td>
                    <td>{{product.root}}</td>
                    <td>
                     <router-link :to="{name: 'edit-product', params:{id: product.id} }" class="btn btn-lg"><i class="far fa-edit"></i></router-link>
                      <a  @click="deleteProduct(product.id)" class="btn btn-lg "><i class="fas fa-trash-alt"></i></a>
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
             deleteProduct(id){
             Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
            if (result.value) {
              axios.delete('/api/product/'+id)
              .then(()=>{
                this.product = this.product.filter(product =>{
                  return product.id !=id
                })
              })
              .catch(()=>{
                this.$router.push({name: 'product'})
              })
            Swal.fire(
           'Deleted!',
            'Your file has been deleted.',
           'success'
            )
            }
            })

          }
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

