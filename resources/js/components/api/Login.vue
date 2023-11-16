<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">

                        <form action="javascript:void(0)" class="row" method="post">


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control " name="email" v-model="auth.email">


                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control " name="password"
                                        v-model="auth.password">


                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleLogin">
                                        Login
                                    </button>
                                </div>
                            </div>



                            <div class="col-12 text-center">
                                <label>Don't have an account? <router-link to="/api/register">Register
                                        Now!</router-link></label>
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
                email: "",
                password: "",
            },
            request: {
                headers: {
                    Authorization: '',
                }
            },

        }
    },

    methods: {

        handleLogin() {
            this.processing = true
            axios.get('/sanctum/csrf-cookie').then(({ data }) => {

                console.log(data);
            });
            axios.post('/api/login', this.auth).then(({ data }) => {


                this.request.headers.Authorization = `Bearer ${data.token}`;
                this.getSecrets()
            }).catch(({ response: { data } }) => {
                console.log(data.message)
            }).finally(() => {
                this.processing = false
            })


        },

        getSecrets() {
            axios.get('/api/blogs', this.request).then(response => this.secrets = response.data);
            // console.log(response);
        }
    }

}
</script>



