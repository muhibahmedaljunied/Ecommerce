<template>
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				
				<div class="card-header pb-0">
						<span class="h2"> الخواص </span>
				

					<div style="display: flex;float: left; margin: 5px">

						<router-link to='create_Attribute' class="tn btn-info btn-sm waves-effect btn-agregar" data-toggle="modal" id="agregar_productos"
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
									<th class="wd-15p border-bottom-0">الرقم</th>

									<th class="wd-15p border-bottom-0">الاسم</th>
									<th class="wd-15p border-bottom-0">الرمز</th>


									<th class="wd-15p border-bottom-0"> العمليات</th>

								</tr>
							</thead>
							<tbody>
								<tr v-for="attribute in attributes">
									<td>{{ attribute.id }}</td>

									<td>{{ attribute.name }}</td>
									<td>{{ attribute.code }}</td>

									<td>
										<template v-for="attr in attribute.attribute_option ">


											<template>
												<div>
													{{ attr.name }}   {{ attr.code }}
												</div>
												<hr>
											</template>
										

										</template>
									</td>

									<td>
										<button type='button'  class="btn btn-danger btn-sm"><i
												class="fa fa-trash"></i></button>
										<router-link :to="{ name: 'edit_Attribute', params: { id: attribute.id } }"
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
			attributes: '',
		}
	},
	mounted() {
		this.axios.post('/attribute').then(response => {
			this.attributes = response.data.attributes;
		})
	},
	// methods: {
	// 	delete_Attribute(id) {

	// 		this.axios.post(`delete_Attribute/${id}`).then(response => {
	// 			toast.fire({
	// 				title: "Deleted!",
	// 				text: "Your category has been deleted.",
	// 				button: "Close", // Text on button
	// 				icon: "success", //built in icons: success, warning, error, info
	// 				timer: 3000, //timeOut for auto-close
	// 				buttons: {
	// 					confirm: {
	// 						text: "OK",
	// 						value: true,
	// 						visible: true,
	// 						className: "",
	// 						closeModal: true
	// 					},
	// 					cancel: {
	// 						text: "Cancel",
	// 						value: false,
	// 						visible: true,
	// 						className: "",
	// 						closeModal: true,
	// 					}
	// 				}
	// 			})

	// 			// this.$router.push('Attribute')

	// 		})
	// 	}
	// }

}
</script>