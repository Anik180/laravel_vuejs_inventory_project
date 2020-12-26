<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">All Salary</li>
        </ol>
        <div class="card-header">
               <h5>All Salary</h5>  
        </div>
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All Salary</div>

          <div class="card-body">
            <div class="table-responsive">
              
              <input type="text" v-model="searchTerm" class="form-control" style="width: 200px;" placeholder="Search"><br>
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Month Name</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Month Name</th>
                    <th>Details</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="salary in filtersearch" :key="salary.salary_month">
                    <td>{{salary.salary_month}}</td>
                    <td>
                     <router-link :to="{name: 'view-salary', params:{id: salary.salary_month} }" class="btn btn-sm btn-success"><i class="fas fa-eye"></i>View Salary</router-link>
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
        	this.allSalary();
        },
        data(){
          return{
            salaries:[],
            searchTerm: ''
          }
        },
        computed:{
          filtersearch(){
            return this.salaries.filter(salary => {
              return salary.salary_month.match(this.searchTerm)
            })
          }
        },
        methods:{
          allSalary(){
            axios.get('/api/salary/')
            .then(({data}) => (this.salaries = data))
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

