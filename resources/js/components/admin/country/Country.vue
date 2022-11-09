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
                                  <router-link to ='create_country'  class="btn btn-primary btn-lg btn-block">Add country</router-link>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">Status</th>
												<th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th>
												<th class="wd-15p border-bottom-0"> Action</th>

												

											</tr>
										</thead>
										<tbody>
											<tr v-for="countrys in country">
												<td>{{countrys.name}}</td>
												<td>{{countrys.status}}</td>
												<td> {{countrys.created_at}}</td>
												<td>{{countrys.updated_at}}</td>
												<td>
													<button type = 'button' @click ="delete_country(countrys.id)"  class="btn btn-danger"><i class="fa fa-trash"></i></button>
							                  	    <router-link  :to ="{name: 'edit_country', params: { id: countrys.id }}"  class="btn btn-success"><i class="fa fa-edit"></i></router-link>
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
            country:'yes',
          }
        },
        mounted(){
            this.axios.post('/country').then(response => {
			this.$root.logo = 'Country'
            this.country = response.data;
            })
		},	
        methods:{
			delete_country(id){

			    this.axios.post(`delete_country/${id}`).then(response => {
					toast.fire({
                                title: "Deleted!",
                                text: "Your category has been deleted.",
                                button: "Close", // Text on button
                                icon: "success", //built in icons: success, warning, error, info
                                timer: 3000, //timeOut for auto-close
                                buttons: {
                                    confirm: {
                                    text: "OK",
                                    value: true,
                                    visible: true,
                                    className: "",
                                    closeModal: true
                                    },
                                    cancel: {
                                    text: "Cancel",
                                    value: false,
                                    visible: true,
                                    className: "",
                                    closeModal: true,
                                    }
                                }
                            })
 
                    // this.$router.push('country')

				})
			}
		}
		
    }
</script>