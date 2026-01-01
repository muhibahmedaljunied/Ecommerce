<template>
<div>
    <div class="container">
        <div class="row">
            
            <div class="offset-3 col-md-6">
                <div class="card mt-5 mb-5">
                    <div class="card-header text-center">
                        <h3>{{ $t('messages.please_register') }}</h3>
                        <h4 v-if="success" class="text-success">{{ $t('messages.' + success) }}</h4>
                    </div>
                    <div class="card-body">
                    <form @submit.prevent="register" method="post">
                        <div class="form-group">
                            <label>{{ $t('messages.first_name') }}</label>
                            <input v-model="form['first_name']" type="text" class="form-control" name="first_name">
                            <span v-if="error.first_name" class="text-danger">{{error.first_name[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ $t('messages.last_name') }}</label>
                            <input v-model="form['last_name']" type="text" class="form-control" name="last_name">
                            
                        </div>

                        <div class="form-group">
                            <label>{{ $t('messages.email_address') }}</label>
                            <input v-model="form['email_address']" type="email" class="form-control" name="email_address">
                            <span v-if="error.email_address" class="text-danger">{{error.email_address[0]}}</span>
                        </div>

                        <div class="form-group">
                            <label>{{ $t('messages.phone') }}</label>
                            <input v-model="form['phone_no']" type="text" class="form-control" name="phone_no">
                        </div>

                        <div class="form-group">
                            <label>{{ $t('messages.password') }}</label>
                            <input v-model="form['password']" type="password" class="form-control" name="password">
                            <span v-if="error.password" class="text-danger">{{error.password[0]}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ $t('messages.address') }}</label>
                            <textarea v-model="form['address']" class="form-control" name="address"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ $t('messages.register') }}</button>
                    </form>
                    <router-link to="/customer/login">{{ $t('messages.login_here') }}</router-link>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
</template>

<script>
    export default {
        // name: "userRegister",
        data(){
            return{
                form:[],
                error:[],
                success:''
            }
        },
        mounted() {
            
        },
        methods: {
            register(){
                this.error = [],
                this.success = '',
                this.$Progress.start();
                axios.post('/customer-register',{
                    first_name: this.form.first_name,
                    last_name: this.form.last_name,
                    email_address: this.form.email_address,
                    phone_no: this.form.phone_no,
                    password: this.form.password,
                    address: this.form.address
                })
                .then((response)=>{
                    //console.log(response.data.errors)
                    //this.$router.push('/user-login')
                    this.success = 'registration_success'
                    this.form = []
                    this.$store.dispatch("customerSession");
                    this.$Progress.finish();
                })
                .catch((error)=>{
                    if (error.response.status == 422) {
                        this.error = error.response.data.errors
                        this.$Progress.finish();
                    }
                })
            }
        }
    }
</script>
