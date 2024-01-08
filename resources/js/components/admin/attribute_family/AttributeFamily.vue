<template>
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">

				<div class="card-header pb-0">
					<span class="h4"> مجموعه الخواص</span>


					<div style="display: flex;float: left; margin: 5px">

						<router-link to='create_attribute_family' class="tn btn-info btn-sm waves-effect btn-agregar"
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
									<th class="wd-15p border-bottom-0">الرقم</th>

									<th class="wd-15p border-bottom-0">الاسم</th>
									<th class="wd-15p border-bottom-0">الرمز</th>
									<th class="wd-15p border-bottom-0"> الخواص</th>


									<th class="wd-15p border-bottom-0"> العمليات</th>


								</tr>
							</thead>
							<tbody v-if="attribute_families && attribute_families.length>0">
								<tr v-for="family in attribute_families">
									<td>{{ family.id }}</td>

									<td>{{ family.name }}</td>
									<td>{{ family.code }}</td>


									<td>
										<template v-for="attr in family.attribute_family_mapping ">


											<template>
												<div>
													{{ attr.attribute.name }}
												</div>
												<hr>
											</template>
										

										</template>
									</td>





									<td>
										<button type='button' class="btn btn-danger btn-sm"><i
												class="fa fa-trash"></i></button>
										<router-link :to="{ name: 'edit_size', params: { id: family.id } }"
											class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>



									</td>

								</tr>

							</tbody>
							<tbody>
								<tr>
									<td style="text-align: center;" colspan="5">
										لايوجد اي بيانات
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

			attribute_families: '',
		}
	},
	mounted() {
		this.axios.post('/attribute_family_mapping').then(response => {

			this.attribute_families = response.data.attribute_families;
		})
	},
	// methods: {
	// 	delete_size(id) {

	// 		this.axios.post(`delete_size/${id}`).then(response => {
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

	// 			// this.$router.push('size')

	// 		})
	// 	}
	// }

}
</script>