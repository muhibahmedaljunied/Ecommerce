<template>
<div>
    <div class="container">
        <div class="row">
            
            <div class="offset-3 col-md-6">
                <div class="card mt-5 mb-5">
                    <div class="card-header text-center">
                        <h3>{{ $t('messages.please_login') }}</h3>
                        <h5 v-if="success" class="text-success">{{ $t('messages.' + success) }}</h5>
                    </div>
                    <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>{{ $t('messages.email_address') }}</label>
                            <input v-model="form['email_address']" type="email" class="form-control" name="email_address" required>
                            <span v-if="error" class="text-danger">{{ $t('messages.' + error) }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ $t('messages.password') }}</label>
                            <input v-model="form['password']" type="password" class="form-control" name="password">
                            <span v-if="error.password" class="text-danger">{{error.password[0]}}</span>
                        </div>
                        <button type="button" class="btn btn-primary" @click='login'>{{ $t('messages.login') }}</button>
                    </form>
                    <router-link to="/customer/register">{{ $t('messages.register_here') }}</router-link>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return{
                form:[],
                error:'',
                success:''
            }
        },
        methods:{
            login(){
                // console.log(this.form.email_address,this.form.password);
                this.success = '',
                this.error = '',
                axios.post('/customer-login',{
                    email_address: this.form.email_address,
                    password: this.form.password
                })
                .then((response)=>{
                    if (response.data =='Error') {
                        this.error = 'invalid_credential'
                    }else{
                        //console.log(response)
                        this.success = 'login_success'
                        this.form = []
                        this.$store.dispatch("customerSession");
                        this.$router.go(-1)
                    }
                    console.log(response.data);
                })
            }
        }
    }
</script>
