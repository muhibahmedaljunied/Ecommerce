<template>
	<div class="row row-sm">

		<div class="col-xl-12">
			<div class="card">

				<div class="card-header pb-0">
					<span class="h4">المنتجات</span>


					<div style="display: flex;float: left; margin: 5px">

						<router-link to='/product/create_product' class="tn btn-info btn-sm waves-effect btn-agregar"
							data-toggle="modal" id="agregar_productos" data-target="#addAb">
							<i class="fa fa-plus-circle"></i></router-link>

						<input type="search" autocomplete="on" name="search" data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="true" placeholder="بحث" v-model="word_search"
							@input="get_search()" />

						<div></div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table text-md-nowrap" id="example1">
							<thead>

								<tr>
									<!--<th class="wd-15p border-bottom-0">المنتج</th>
								 <th class="wd-15p border-bottom-0">الصنف</th>
									<th class="wd-15p border-bottom-0">الصوره</th>


									<th class="wd-15p border-bottom-0">الكميه</th>
									<th class="wd-15p border-bottom-0">السعر</th>
									<th class="wd-15p border-bottom-0">الخواص</th>

									<th class="wd-15p border-bottom-0"> العمليات</th> -->



								</tr>
							</thead>
							<tbody v-if="product && product.length > 0">

								<tr v-for="products in product">

									<!-- <td> -->

									<template>
										<div class="row">

											<div class="col-md-4">
												{{ products.text }}

											</div>
											<!-- <div class="col-md-4">
													{{ products.category_name }}

												</div> -->
											<div class="col-md-4">

												<div class="row"
													v-for="product_family in products.product_family_attribute ">

													<div class="col-md-2">
														<img class="card-img"
															:src="`/assets/upload/${product_family.image}`"
															alt="Product Image" height='100px' />

													</div>
											
													<div class="col-md-2">
														الكميه: {{ product_family.qty }}

													</div>
											
													<div class="col-md-2">
														السعر:{{ product_family.price }}

													</div>
												


													<div class="col-md-6">

														<div class="row">

															<div class="col-md-6">
																<span
																	v-for="option in product_family.family_attribute_option ">
																	<p>{{ option.name }}:{{ option.value }}</p>
																</span>
															</div>
															<div class="col-md-6">
																<button type='button' class="btn btn-danger btn-sm"><i
																		class="fa fa-trash"></i></button>
																<router-link
																	:to="{ name: 'edit_product', params: { id: 1 } }"
																	class="btn btn-success btn-sm"><i
																		class="fa fa-edit"></i></router-link>
															</div>

														</div>
														<hr>

													</div>

												</div>

											</div>

											<div class="col-md-4">


											</div>


										</div>
										<hr>
									</template>
									<!-- </td> -->
									<!-- <td>{{ products.text }}</td> -->

									<!-- <td>{{ products.category_name }}</td> -->



									<!-- <td>
										<template v-for="product_family in products.product_family_attribute ">


											<template>
												<div>

													<img class="card-img" :src="`/assets/upload/${product_family.image}`"
														alt="Product Image" height='100px' />
												</div>

											</template>


										</template>
									</td>
									<td>
										<template v-for="product_family in products.product_family_attribute ">


											<template>
												<div>
													{{ product_family.qty }}
												</div>

											</template>


										</template>
									</td>

									<td>
										<template v-for="product_family in products.product_family_attribute ">


											<template>
												<div>
													{{ product_family.price }}
												</div>

											</template>


										</template>
									</td>


									<td>
										<template v-for="product_family in products.product_family_attribute ">





											<template v-for="option in product_family.family_attribute_option ">

												<p>{{ option.name }}:{{ option.value }}</p>
											</template>






										</template>
									</td>

 -->







									<!-- <td>
										<button type='button' @click="delete_product(products.id)"
											class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
										<router-link :to="{ name: 'edit_product', params: { id: products.id } }"
											class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>
									</td> -->

								</tr>

							</tbody>
							<tbody>
								<tr>
									<td style="text-align: center;" colspan="7">
										لايوجد اي بيانات
									</td>
								</tr>
							</tbody>
						</table>
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
			product: '',
		}
	},
	mounted() {
		this.axios.post('/product').then(response => {

			console.log(response.data.product);
			this.product = response.data.product;
			// this.$root.logo = 'Product'

		})
	},
	methods: {

		delete_product(id) {

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

