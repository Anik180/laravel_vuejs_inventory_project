<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Add Supplier</li>
        </ol>
        <div class="card-header">
              <router-link class="btn btn-info" to="/store-supplier" style="float: right;"><i class="fas fa-plus-circle"></i>Add Supplier</router-link>
               <h5>All  Supplier</h5>  
        </div>
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All  Supplier</div>

          <div class="card-body">
            <div class="table-responsive">
              
              <input type="text" v-model="searchTerm" class="form-control" style="width: 200px;" placeholder="Search"><br>
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Shop Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Shop Name</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="supplier in filtersearch" :key="supplier.id">
                    <td>{{supplier.name}}</td>
                    <td><img :src="supplier.photo" id="em_photo"></td>
                    <td>{{supplier.phone}}</td>
                    <td>{{supplier.address}}</td>
                    <td>{{supplier.shopname}}</td>
                    <td>
                     <router-link :to="{name: 'edit-supplier', params:{id: supplier.id} }" class="btn btn-lg"><i class="far fa-edit"></i></router-link>
                      <a  @click="deleteSupplier(supplier.id)" class="btn btn-lg "><i class="fas fa-trash-alt"></i></a>
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
        	this.allSupplier();
        },
        data(){
          return{
            suppliers:[],
            searchTerm: ''
          }
        },
        computed:{
          filtersearch(){
            return this.suppliers.filter(supplier => {
              return supplier.name.match(this.searchTerm)
            })
          }
        },
        methods:{
          allSupplier(){
            axios.get('/api/supplier/')
            .then(({data}) => (this.suppliers = data))
            .catch()
          },
             deleteSupplier(id){
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
              axios.delete('/api/supplier/'+id)
              .then(()=>{
                this.suppliers = this.suppliers.filter(supplier =>{
                  return supplier.id !=id
                })
              })
              .catch(()=>{
                this.$router.push({name: 'supplier'})
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

