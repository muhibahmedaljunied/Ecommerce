<template>
	<!-- row opened -->

	<div class="wrapper">
		<div class="container-fluid">


			<div class="row row-sm">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mg-b-0"> الخواص</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
						</div>
						<div class="card-body">

							<form class="row g-3">


								<div class="col-md-12">



									<fieldset class="border rounded-3 p-3">
										<legend class="float-none w-auto px-3">الاسم</legend>

										<input v-model="name" type="text" class="form-control">
									</fieldset>

									<fieldset class="border rounded-3 p-3">
										<legend class="float-none w-auto px-3">الرمز</legend>


										<input v-model="code" type="text" class="form-control">
									</fieldset>

									<!-- <fieldset class="border rounded-3 p-3">
											<legend class="float-none w-auto px-3">النوع</legend>
								
				
				
											<select name="Category" class="form-control">
												<option value="">select</option>

											</select>
										</fieldset> -->


									<fieldset class="border rounded-3 p-3">
										<legend class="float-none w-auto px-3">قيم الخاصيه</legend>
										<form method="post">

											<div class="table-responsive">
												<table class="table table-bordered text-right m-t-30"
													style="width: 100%; font-size: x-small">
													<thead>
														<tr>
															<th> القيمه</th>
															<th> الرمز</th>

															<th>اضافه</th>
														</tr>
													</thead>
													<tbody>
														<tr v-for="index in count" :key="index">


															<td>
																<input v-model="value[index]" type="text"
																	class="form-control" name="name" id="name"
																	required />
															</td>
															<td>
																<input v-model="code_value[index]" type="text"
																	class="form-control" name="name" id="name" />
															</td>


															<td v-if="index == 1">
																<a class="tn btn-info btn-sm waves-effect btn-agregar"
																	v-on:click="addComponent(count)">
																	<i class="fa fa-plus-circle"></i></a>

																<a class="tn btn-info btn-sm waves-effect btn-agregar"
																	v-on:click="disComponent(count)">
																	<i class="fa fa-minus-circle"></i></a>
															</td>



														</tr>
														<tr>
															<td colspan="2"></td>
															<td> <button @click="add()" type="button"
																	class="btn btn-primary">حفظ</button></td>
														</tr>


													</tbody>
												</table>
											</div>
										</form>
									</fieldset>





								</div>


							</form>
						</div>
					</div>
				</div>

			</div>
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
													:to="{ name: 'edit_Attribute', params: { id: attribute.id } }"
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


		}
	},
	mounted() {
		this.counts[0] = 1;
		this.axios.post('/attribute').then(response => {
			this.attributes = response.data.attributes;
		})
	},
	methods: {
		addComponent(index) {
			// alert(index);
			this.count += 1;
			if (index == 0) {

				this.counts[index] = 0;
			} else {
				this.counts[index] = this.count;

			}
		},
		disComponent(index) {
			this.count -= 1;
			this.counts.pop()
			// this.$delete(this.counts, index);
		},
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

		add() {

			let currentObj = this;


			this.axios.post('/store_attribute', {
				count: this.counts,
				code: this.code,
				name: this.name,
				value: this.value,
				code_value: this.code_value,

			})
				.then(function (response) {

				})
				.catch(function (error) {
					currentObj.output = error;
				});

			// this.$router.go(-1);

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