<template>
    	<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
                                 <div class="form">
                    <h3 class="text-center">Update user</h3>
                    <form method="post" @submit.prevent="updateuser">

                     <input v-model ='user.id' type="hidden"  name="id_name" id="id_name">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input v-model='user.name' type="text"  name="name" id="name">
                       
                    </div>

                    <div class="form-group">
                        <label for="status">الحاله</label>
                        <input v-model='user.status' type="text"  name="status" id="status">
                       
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ</button>
                </form>
            </div>
								
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			
</template>
<script>
    export default {
        data(){
          return{
            user:{
                  id:'',
                  name:'',
                  status:''
                  }
            }
        },
      created() {
            let uri = `/user/${this.$route.params.id }`;
            this.axios.get(uri).then(response => {
                this.user.id = response.data.id;
                this.user.name = response.data.name;
                this.user.status = response.data.status;

            });
        },
        methods:{
            updateuser(event){
            let uri = `/update_user/${this.$route.params.id}`;
            axios.post(uri).then(response => {
                    event.preventDefault();
                    this.$router.push('user')
            })
            }
        }
    }
</script>