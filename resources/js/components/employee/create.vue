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
         <form @submit.prevent="employeeInsert" enctype="multipart/form-data">
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
                  <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                  <label >Address</label>
                  <input type="text" v-model="form.address" class="form-control"  placeholder="Enter Address">
               </div>
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                  <label >Salary</label>
                  <input type="text"  v-model="form.salary" class="form-control"  placeholder="Salary">
               </div>
               <div class="col-md-3"></div>
            </div>
            <div class="row">
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                  <label >Joining Date</label>
                  <input type="date" v-model="form.joining_date" class="form-control"  placeholder="Enter Joining Date">
               </div>
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                  <label >Nid Number</label>
                  <input type="text"  v-model="form.nid" class="form-control"  placeholder="Nid Number">
               </div>
               <div class="col-md-3"></div>
            </div>
            <div class="row">
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                  <label >Phone Number</label>
                  <input type="text"  v-model="form.phone" class="form-control"  placeholder="Phone Number">
               </div>
               <div class="col-md-3"></div>
            </div>
            <div class="row">
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                  <input type="file" class="btn btn-info" @change="onFileselected">
               </div>
               <div class="form-group col-md-6">
                  <div class="col-md-3"></div>
                  <img :src="form.photo" style="height:40px; width: 40px;">
               </div>
               <div class="col-md-3"></div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left:700px;">Submit</button>
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
             address:'',
             salary:'',
             joining_date :'',
             nid :'',
             phone :'',
             photo:''
           },
           errors:{},
         }
       },
       methods:{   
         onFileselected(event){
           let file=event.target.files[0];
           if (file.size > 1048770) {
             Notification.image_validation()
           }else{
             let reader = new FileReader();
             reader.onload = event => {
               this.form.photo = event.target.result
   
               console.log(event.target.result);
             };
             reader.readAsDataURL(file);
   
           }
         },
         employeeInsert(){
           axios.post('/api/employee/',this.form)
           .then(() => {
             this.$router.push({ name: 'employee' })
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