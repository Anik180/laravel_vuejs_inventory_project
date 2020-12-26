<template>

<div>
   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active float-right">Add Expense</li>
        </ol>
     
<div class="col-md-8 offset-lg-2 shadow p-3 mb-5 bg-light rounded ">
       <div class="card md-3">
        <div class="card-header">
        <router-link class="btn btn-info" to="/category" style="float: right;"><i class="fas fa-globe"></i>All Expense</router-link> 
               <h5 > Add New Expense</h5> 
            </div>
            </div>
<form @submit.prevent="expenseUpdate">
  <div class="row mt-3">
    <div class="form-group col-md-6">
    <label>Expense Details</label>
    <textarea class="form-control" v-model="form.details"></textarea>
     <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
  </div>
  <div class="form-group col-md-6">
    <div class="col-md-3"></div>
    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
    <label >Amount</label>
    <input type="text" v-model="form.amount" class="form-control"  placeholder="Enter Amount">
  </div>

  <div class="col-md-3"></div>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left:700px;">Submit</button>
</form>
<div class="card-footer small text-muted mt-3">Updated yesterday at 11:59 PM</div>
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
              details :'',
              amount :''
            },
            errors:{},
          }
        },
           created(){
        	let id = this.$route.params.id
        	axios.get('/api/expense/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{   
          expenseUpdate(){
          	let id = this.$route.params.id
            axios.patch('/api/expense/'+id,this.form)
            .then(() => {
              this.$router.push({ name: 'expense' })
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

