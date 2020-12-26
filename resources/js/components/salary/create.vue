<template>
   <div>
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
         </li>
         <li class="breadcrumb-item active float-right">Add Employee</li>
      </ol>
      <div class="card-header">
         <router-link class="btn btn-info" to="/employee" style="float: right;"><i class="fas fa-globe"></i>All Employee</router-link>
         <h5>Add New Employee</h5>
      </div>
      <div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded">
         <form @submit.prevent="paidSalary">
            <div class="row">
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  <label >Full Name</label>
                  <input type="text" v-model="form.name" class="form-control"  placeholder="Enter Full Name">
               </div>
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                  <label >Email</label>
                  <input type="text"  v-model="form.email" class="form-control"  placeholder="Enter  Email">
               </div>
               <div class="col-md-3"></div>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
            <div class="col-md-3"></div>
           <label >Month</label>
           <select class="form-control" v-model="form.salary_month">
           <option value="January">January</option>
           <option value="February">February</option>
           <option value="March">March</option>
           <option value="April">April</option>
           <option value="May">May</option>
           <option value="June">June</option>
           <option value="July">July</option>
           <option value="August">August</option>
           <option value="September">September</option>
           <option value="October">October</option>
           <option value="November">November</option>
           <option value="December">December</option>
           </select>
           <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
             </div>
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                  <label >Salary</label>
                  <input type="text"  v-model="form.salary" class="form-control"  placeholder="Salary">
               </div>
               <div class="col-md-3"></div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left:700px;">Pay Now</button>
         </form>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
            name :'',
            email :'',
            salary_month:'',
            salary: '',
          },
          errors:{},
        }
       },
       created(){
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
        .then(({data}) => (this.form = data))
        .catch()
       },
       methods:{  
        paidSalary(){
          let id = this.$route.params.id
          axios.post('/api/salary/paid/'+id,this.form)
          .then(() => {
            this.$router.push({ name: 'given-salary' })
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