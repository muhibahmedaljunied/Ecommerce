<template>
	<!-- row opened -->

	<div class="container-fluid">




		<div class="row row-sm">
	
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
								aria-haspopup="true" aria-expanded="true" :placeholder="$t('messages.search') + '...'" v-model="word_search"
								@input="get_search()" />
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
											<th class="wd-15p border-bottom-0">{{ $t('messages.serial_number') }}</th>

											<th class="wd-15p border-bottom-0">{{ $t('messages.name') }}</th>
											<th class="wd-15p border-bottom-0">{{ $t('messages.code') }}</th>
											<th class="wd-15p border-bottom-0"> {{ $t('messages.attributes') }}</th>


											<th class="wd-15p border-bottom-0"> {{ $t('messages.operations') }}</th>


									</tr>
								</thead>
								<tbody v-if="attribute_families && attribute_families.length > 0">
									<tr v-for="(family,index) in attribute_families" :key="index">
										<td>{{ index+1 }}</td>

										<td>{{ family.name }}</td>
										<td>{{ family.code }}</td>


											<td>
												<template v-for="(attr, attrIndex) in family.attribute_family_mapping">


													<template>
														<span style="color: blue;" :key="attrIndex">
															{{ $t('messages.' + attr.attribute.name) }}
														</span>&ensp;

													</template>


												</template>
											</td>





										<td>
											<button type='button' class="btn btn-danger btn-sm"><i
													class="fa fa-trash"></i></button>
											<router-link
												:to="{ name: 'edit_attribute_family', params: { data: family } }"
												class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>



										</td>

									</tr>

								</tbody>
								<tbody v-else>
									<tr>
										<td style="text-align: center;" colspan="5">
											{{ $t('messages.no_data_available') }}
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		

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
		this.fetchData();
	},
	watch: {
		currentLocale() {
			this.fetchData();
		}
	},
	methods: {
		fetchData() {
			this.axios.post(`/attribute_family/get_attributes`).then((response) => {

				this.attributes = response.data.attributes;
			})

			this.axios.post('/attribute_family_mapping').then(response => {

				this.attribute_families = response.data.attribute_families;
			})
		},
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


		// exports_excel() {

		// 	axios
		// 		.post(`/export_opening_inventuries`)
		// 		.then(function (response) {

		// 			toastMessage("تم اتمام عمليه التصدير");
		// 			this.$router.go(0);
		// 		})
		// 		.catch(error => {


		// 		});
		// },
		// imports_excel() {

		// 	axios
		// 		.post(`/import_opening_inventuries`)
		// 		.then(function (response) {
		// 			toastMessage("تم اتمام عمليه الاستيراد");
		// 			this.$router.go(0);

		// 			// this.list();




		// 		})
		// 		.catch(error => {

		// 		});
		// },
	}

}
</script>
<style>
legend {

	font-weight: lighter;
	color: cadetblue;
}
</style>