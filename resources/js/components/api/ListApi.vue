<template>
  

    <div class="row h-100 align-items-center">
        <H1>List Api</H1>
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card shadow sm">
                <div class="card-body">
                    <h1 class="text-center">Login</h1>
                    <hr />
                    <form action="javascript:void(0)" class="row" method="post">
                        <div class="form-group col-12">
                            <label for="email" class="font-weight-bold">Email</label>
                            <input v-model="auth.email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="password" class="font-weight-bold">Password</label>
                            <input  v-model="auth.password" name="password" id="password"
                                class="form-control">
                        </div>
                        <div class="col-12 mb-2">
                            <button type="submit" :disabled="processing" @click="handleLogin"
                                class="btn btn-primary btn-block">
                                {{ processing ? "Please wait" : "Login" }}
                            </button>
                        </div>
                        <div class="col-12 text-center">
                            <label>Don't have an account? <router-link :to="{ name: 'register' }">Register
                                    Now!</router-link></label>
                        </div>
                    </form>
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
        }
    },

    methods: {

        handleLogin() {
            this.processing = true
            axios.get('/sanctum/csrf-cookie').then(({ data }) => {

                console.log(data);
            });
            axios.post('/login', this.auth).then(({ data }) => {
                this.getSecrets()
            }).catch(({ response: { data } }) => {
                alert(data.message)
            }).finally(() => {
                this.processing = false
            })

            axios.get('/api/listApi').then(response => this.secrets = response.data);

        },

        getSecrets() {
            axios.get('/api/blogs').then(response => this.secrets = response.data);
            // console.log(response);
        }
    }

}
</script>



