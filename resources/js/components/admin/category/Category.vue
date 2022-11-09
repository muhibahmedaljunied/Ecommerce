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
                                  <router-link to ='create_category'  class="btn btn-primary btn-lg btn-block">Add Category</router-link>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">image</th>
												<th class="wd-15p border-bottom-0">Status</th>
												<th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th>
												<th class="wd-15p border-bottom-0"> Action</th>

												

											</tr>
										</thead>
										<tbody>
											<tr v-for="categorys in category">
												<td>{{categorys.name}}</td>
												<td>
                                                <img :src="`assets/img/20191214045454_41TxNIo3cQL.jpg`" height="50px" alt="category image">
                                                </td>
												<td>{{categorys.status}}</td>
												<td> {{categorys.created_at}}</td>
												<td>{{categorys.updated_at}}</td>
												<td>
													<button type = 'button' @click ="delete_category(categorys.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
							                  	    <router-link  :to ="{name: 'edit_category', params: { id: categorys.id }}"  class="edit btn btn-success"> <i class="fa fa-edit"></i></router-link>
												</td>
												
                                            
                                            <!-- <a href="{{route('admin.brand.delete', $brand->id)}}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a> -->

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
            category:'yes',
          }
        },
        mounted(){
            this.axios.post('/category').then(response => {
            this.category = response.data;
			this.$root.logo = 'Category'

            })
		},	
        methods:{
			delete_category(id){

			    this.axios.post(`delete_category/${id}`).then(response => {

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
 
                    // this.$router.push('category')

				})
			}
		}
}
</script>

