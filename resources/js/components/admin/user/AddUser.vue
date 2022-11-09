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
                    <h3 class="text-center">Add User</h3>
                    <form method="post" @submit.prevent="adduser">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input v-model="data.name" type="text"  name="name" id="name">
                   
                    </div>

                    <div class="form-group">
                        <label for="status">status</label>
                        <input v-model='data.status' type="text"  name="status" id="status">
                   
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>
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
                  
          }
        },
        methods:{

            adduser(event){

                this.axios.post(`/store_user`).then((response) => {
                    event.preventDefault();
                    this.$router.push('user')
                })

            }
        }
    }
</script>