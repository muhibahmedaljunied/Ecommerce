<template>
	<!-- row opened -->

	<div class="wrapper">
		<div class="container-fluid">


			<div class="row row-sm">
				<div class="col-xl-12">
					<div class="card">

						<div class="card-header">


							<div style="display: flex;float: left; margin: 5px">

								<button @click="exports_excel()">

									<i class="fa-solid fa-file-export " style="font-size: 24px; color: #63E6BE;"></i>
								</button>

								<button @click="imports_excel()">

									<i class="fa-solid fa-file-import " style="font-size: 24px; color: #B197FC;"></i>
								</button>

								<input type="search" autocomplete="on" name="search" data-toggle="dropdown"
									role="button" aria-haspopup="true" aria-expanded="true" placeholder="بحث "
									v-model="word_search" @input="get_search()" />
							</div>
						</div>
						<div class="card-body">

							<div class="row">

								<div class="col-md-12">
									<label for="pagoPrevio">المجموعه</label>

									<select v-model="New" name="Category" id="Category" class="form-control">
										<option value="">select</option>
										<option value="yes">yes</option>
										<option value="no">no</option>

									</select>

								</div>



							</div>

							<div class="row">

								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">الرقم</th>

												<th class="wd-15p border-bottom-0">الاسم</th>
												<th class="wd-15p border-bottom-0">الرمز</th>

												<th class="wd-15p border-bottom-0">القيم</th>
												<th class="wd-15p border-bottom-0"> العمليات</th>

											</tr>
										</thead>
										<tbody v-if="attributes && attributes.length > 0">
											<tr v-for="attribute in attributes">
												<td>{{ attribute.id }}</td>

												<td>{{ attribute.name }}</td>
												<td>{{ attribute.code }}</td>


												<td>
													<template v-for="(attr, indexd) in attribute.attribute_option">


														<template>
															<div style="float: left;">



																<span style="color: blue;">
																	{{ attr.value }}
																</span>&ensp;

															</div>

														</template>


													</template>
												</td>

												<td>
													<button type='button' class="btn btn-danger btn-sm"><i
															class="fa fa-trash"></i></button>
													<router-link
														:to="{ name: 'edit_attribute', params: { data: attribute } }"
														class="btn btn-success btn-sm"><i
															class="fa fa-edit"></i></router-link>
												
												</td>

											</tr>

										</tbody>
										<tbody v-else>
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
				</div>
				<!--/div-->
			</div>
		</div>
	</div>
	<!-- /row -->
</template>
<script>

export default {
	
	data() {
		return {
			attributes: '',

			name: '',
			code: '',
			code_value: [],
			status: '',
			counts: {},
			count: 1,
			value: [],
			msg:'',


		}
	},
	mounted() {
		console.log('almuhiiiiiiiiiiiiiiiiiiiiii', window.axios.defaults.baseURL);
		this.counts[0] = 1;
		this.axios.post('/attribute').then(response => {
			this.attributes = response.data.attributes;
		})
	},
	methods: {
	
		delete_Attribute(id) {

			this.axios.post(`delete_Attribute/${id}`).then(response => {
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

				// this.$router.push('Attribute')

			})
		},



		exports_excel() {

			axios
				.post(`/export_opening_inventuries`)
				.then(function (response) {

					toastMessage("تم اتمام عمليه التصدير");
					this.$router.go(0);
				})
				.catch(error => {


				});
		},
		imports_excel() {

			axios
				.post(`/import_opening_inventuries`)
				.then(function (response) {
					toastMessage("تم اتمام عمليه الاستيراد");
					this.$router.go(0);

					// this.list();




				})
				.catch(error => {

				});
		},
	}

}
</script>

<style>
legend {

	font-weight: lighter;
	color: cadetblue;
}
</style>