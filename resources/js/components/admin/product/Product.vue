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
                                  <router-link to ='create_product'  class="btn btn-primary btn-lg btn-block">Add Product</router-link>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Product</th>
												<th class="wd-15p border-bottom-0">Image</th>
												<th class="wd-15p border-bottom-0">Category</th>
												<th class="wd-15p border-bottom-0">Country</th>
												<th class="wd-15p border-bottom-0">Size</th>
												<th class="wd-15p border-bottom-0">qty</th>
												<th class="wd-15p border-bottom-0">price</th>
												<th class="wd-15p border-bottom-0">Discount</th>
												<th class="wd-15p border-bottom-0">Status</th>
												<th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th>
												<th class="wd-15p border-bottom-0"> Action</th>

												

											</tr>
										</thead>
										<tbody>
										<tr v-for="products in product">
											<td>{{products.name}}</td>
											<td>
                                                <img :src="`assets/img/${products.image}`" height="50px" alt="products image">
                                            </td>
											<td>{{products.category_name}}</td>
											<td>{{products.country_name}}</td>
											<td>{{products.size_name}}</td>
											<td>{{products.qty}}</td>
											<td>{{products.price}}</td>
											<td>{{products.discount}}</td>
											<td>{{products.status}}</td>
											<td>{{products.created_at}}</td>
											<td>{{products.updated_at}}</td>
											<td>
												<button type = 'button' @click ="delete_product(products.id)"  class="btn btn-danger"><i class="fa fa-trash"></i></button>
							                  	 <router-link  :to ="{name: 'edit_product', params: { id: products.id }}"  class="btn btn-success"><i class="fa fa-edit"></i></router-link>
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
            product:'',
          }
        },
        mounted(){
            this.axios.post('/product').then(response => {
            this.product = response.data;
			this.$root.logo = 'Product'

            })
		},	
        methods:{

				delete_product(id){

			    this.axios.post(`/delete_product/${id}`).then(response => {

					toast.fire({
                                title: "Deleted!",
                                text: "Your product has been deleted.",
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