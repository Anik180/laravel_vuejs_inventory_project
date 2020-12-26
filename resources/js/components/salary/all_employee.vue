<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Employee Salary</li>
        </ol>
        <div class="card-header">
               <h5>Employee Salary</h5>  
        </div>
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All Employee</div>

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
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="employee in filtersearch" :key="employee.id">
                    <td>{{employee.name}}</td>
                    <td><img :src="employee.photo" id="em_photo"></td>
                    <td>{{employee.phone}}</td>
                    <td>{{employee.address}}</td>
                    <td>
                     <router-link :to="{name: 'pay-salary', params:{id: employee.id} }" class="btn btn-lg btn-success"><i class="fas fa-hand-holding-usd"></i>Payment</router-link>
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
        	this.allEmployee();
        },
        data(){
          return{
            employees:[],
            searchTerm: ''
          }
        },
        computed:{
          filtersearch(){
            return this.employees.filter(employee => {
              return employee.name.match(this.searchTerm)
            })
          }
        },
        methods:{
          allEmployee(){
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
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

