<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registeration</div>

                <div class="card-body">
                    <form action="javascript:void(0)" class="row" method="post">
                

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" v-model="auth.name">

                         
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" v-model="auth.email">

                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" v-model="auth.password" >

                        
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="auth.confirm_password" >
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleregister">
                                   Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            secrets: [],
            auth: {
                name: "",
                email: "",
                password: "",
                // confirm_email: "",


            },
        }
    },

    methods: {
        handleregister() {
            this.processing = true
            axios.get('/sanctum/csrf-cookie').then(({ data }) => {

                console.log(data);
            });
            axios.post('/api/register', this.auth).then(({ data }) => {
         
            }).catch(({ response: { data } }) => {
                console.log(data.message)
            }).finally(() => {
                this.processing = false
            })

            // axios.get('/api/listApi').then(response => this.secrets = response.data);

        },

       
    }

}
</script>