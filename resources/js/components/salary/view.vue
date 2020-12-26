<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Employee Salary Details</li>
        </ol>
        <div class="card-header">
               <h5>Employee Salary Details</h5>  
        </div>
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
          Salary</div>

          <div class="card-body">
            <div class="table-responsive">
              
              <input type="text" v-model="searchTerm" class="form-control" style="width: 200px;" placeholder="Search"><br>
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Salary Month</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Salary Month</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="salary in filtersearch" :key="salary.id">
                    <td>{{salary.name}}</td>
                    <td>{{salary.salary_month}}</td>
                    <td>{{salary.amount}}</td>
                    <td>{{salary.salary_date}}</td>
                    <td>
                     <router-link :to="{name: 'edit-salary', params:{id: salary.id} }" class="btn btn-sm btn-success"><i class="fas fa-eye"></i>Edit Salary</router-link>
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
          this.viewSalary();
        },

        data(){
          return{
            salaries:[],
            searchTerm:'',         
          }
        },
       computed:{
         filtersearch(){
          return this.salaries.filter(salary => {
             return salary.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          viewSalary(){
            let id = this.$route.params.id
    		axios.get('/api/salary/view/'+id)
    		.then(({data}) => (this.salaries = data))
    		.catch(error => this.errors = error.response.data.errors)
          },
        },
      
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

