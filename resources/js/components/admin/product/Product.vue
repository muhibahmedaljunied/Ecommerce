<template>
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
			
				<div class="card-header pb-0">
						<span class="h2">المنتجات</span>
				

					<div style="display: flex;float: left; margin: 5px">

						<router-link to ='create_product' class="tn btn-info btn-sm waves-effect btn-agregar" data-toggle="modal" id="agregar_productos"
							data-target="#addAb">
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
									<th class="wd-15p border-bottom-0">المنتج</th>
									<th class="wd-15p border-bottom-0">الصوره</th>
									<th class="wd-15p border-bottom-0">الصنف</th>
									<th class="wd-15p border-bottom-0">الدوله</th>
									<th class="wd-15p border-bottom-0">الحجم</th>
									<th class="wd-15p border-bottom-0">الكميه</th>
									<th class="wd-15p border-bottom-0">السعر</th>
									<th class="wd-15p border-bottom-0">الخصم</th>
									<th class="wd-15p border-bottom-0">الحاله</th>
									<!-- <th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th> -->
									<th class="wd-15p border-bottom-0"> العمليات</th>



								</tr>
							</thead>
							<tbody>
								<tr v-for="products in product">
									<td>{{ products.name }}</td>
									<td>
										<img :src="`assets/upload/${products.image}`" height="50px" alt="products image">
									</td>
									<td>{{ products.category_name }}</td>
									<td>{{ products.country_name }}</td>
									<td>{{ products.size_name }}</td>
									<td>{{ products.qty }}</td>
									<td>{{ products.price }}</td>
									<td>{{ products.discount }}</td>
									<td>{{ products.status }}</td>
									<!-- <td>{{products.created_at}}</td>
											<td>{{products.updated_at}}</td> -->
									<td>
										<button type='button' @click="delete_product(products.id)" class="btn btn-danger btn-sm"><i
												class="fa fa-trash"></i></button>
										<router-link :to="{ name: 'edit_product', params: { id: products.id } }"
											class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>
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
	data() {
		return {
			product: '',
		}
	},
	mounted() {
		this.axios.post('/product').then(response => {
			this.product = response.data;
			this.$root.logo = 'Product'

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