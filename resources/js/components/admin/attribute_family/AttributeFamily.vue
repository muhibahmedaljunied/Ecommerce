<template>
	<!-- row opened -->

	<div class="container-fluid">

		<div class="row row-sm">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">مجموعه الخواص </h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
					<div class="card-body">

						<form class="row g-3">








							<fieldset>

								<legend>الاسم</legend>

								<input v-model="name" type="text" class="form-control" id="inputZip">

							</fieldset>




							<fieldset>
								<legend>الرمز</legend>

								<input v-model="code" type="text" class="form-control" id="inputZip">
							</fieldset>


							<fieldset>
								<legend>الخواص</legend>

								<div v-for="item in attributes" class="form-check form-check-inline">
									<!-- <label class="form-check-label" for="inlineCheckbox1">الخواص</label> -->
									<input v-model="checkedItems" :value="item.id" id="checkedItems"
										class="form-check-input" type="checkbox">
									<label class="form-check-label" for="inlineCheckbox1">{{ item.name
									}}</label>
								</div>
							</fieldset>











							<fieldset>

								<button @click="add()" type="button" class="btn btn-primary">حفظ</button>

							</fieldset>














						</form>
					</div>

					<div class="card-footer">


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

							<input type="search" autocomplete="on" name="search" data-toggle="dropdown" role="button"
								aria-haspopup="true" aria-expanded="true" placeholder="بحث " v-model="word_search"
								@input="get_search()" />
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
								<tbody v-if="attribute_families && attribute_families.length > 0">
									<tr v-for="family in attribute_families">
										<td>{{ family.id }}</td>

										<td>{{ family.name }}</td>
										<td>{{ family.code }}</td>


										<td>
											<template v-for="attr in family.attribute_family_mapping">


												<template>
													<span style="color: blue;">
														{{ attr.attribute.name }}
													</span>&ensp;

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



	</div>

	<!-- /row -->
</template>
<script>
export default {
	data() {
		return {

			attribute_families: '',

			name: '',
			code: '',
			message: [],

			attributes: '',
			checkedItems: [],

		}
	},
	mounted() {


		this.axios.post(`/attribute_family/get_attributes`).then((response) => {

			this.attributes = response.data.attributes;
		})

		this.axios.post('/attribute_family_mapping').then(response => {

			this.attribute_families = response.data.attribute_families;
		})
	},
	methods: {
		// delete_size(id) {

		// 	this.axios.post(`delete_size/${id}`).then(response => {
		// 		toast.fire({
		// 			title: "Deleted!",
		// 			text: "Your category has been deleted.",
		// 			button: "Close", // Text on button
		// 			icon: "success", //built in icons: success, warning, error, info
		// 			timer: 3000, //timeOut for auto-close
		// 			buttons: {
		// 				confirm: {
		// 					text: "OK",
		// 					value: true,
		// 					visible: true,
		// 					className: "",
		// 					closeModal: true
		// 				},
		// 				cancel: {
		// 					text: "Cancel",
		// 					value: false,
		// 					visible: true,
		// 					className: "",
		// 					closeModal: true,
		// 				}
		// 			}
		// 		})

		// 		// this.$router.push('size')

		// 	})
		// },

		add() {

			this.axios.post(`/store_attribute_family_mapping`, {
				name: this.name,
				code: this.code,
				item: this.checkedItems

			}).then((response) => {

			})
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