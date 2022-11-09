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
								<div class="d-flex justify-content-between">
                                  <router-link to ='create_user'  class="btn btn-primary btn-lg btn-block">Add user</router-link>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">Phone</th>
												<th class="wd-15p border-bottom-0">Email</th>
												<th class="wd-15p border-bottom-0">Address</th>
												<!-- <th class="wd-15p border-bottom-0">password</th> -->
												<th class="wd-15p border-bottom-0">Status</th>
												<th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th>
												<th class="wd-15p border-bottom-0"> Action</th>

												

											</tr>
										</thead>
										<tbody>
											<tr v-for="users in user">
												<td>{{users.name}}</td>
												<td>{{users.phone}}</td>
												<td>{{users.email}}</td>
												<td>{{users.address}}</td>
												<!-- <td>{{users.password}}</td> -->
												<td>{{users.status}}</td>
												<td> {{users.created_at}}</td>
												<td>{{users.updated_at}}</td>
												<td>
													<!-- <button type = 'button' @click ="delete_user(users.id)"  class="btn btn-danger"><i class="mdi mdi-account-minus"></i></button>
							                  	    <router-link  :to ="{name: 'edit_user', params: { id: users.id }}"  class="btn btn-success"><i class="mdi mdi-account-minus"></i></router-link> -->
												</td>

											</tr>
									
										</tbody>
									</table>
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
            user:'yes',
          }
        },
        mounted(){
            this.axios.post('/user').then(response => {
			this.$root.logo = 'User'
            this.user = response.data;
            })
		},	
        methods:{
			delete_user(id){

			    this.axios.post(`/delete_user/${id}`).then(response => {
 
                    // this.$router.push('user')

				})
			}
		}
		
    }
</script>