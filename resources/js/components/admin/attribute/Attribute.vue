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
									role="button" aria-haspopup="true" aria-expanded="true" :placeholder="$t('messages.search') + '...'"
									v-model="word_search" @input="get_search()" />
							</div>
						</div>
						<div class="card-body">

							<div class="row">

								<div class="col-md-12">
									<label for="pagoPrevio">{{ $t('messages.attribute_families') }}</label>
									<select v-model="family_attribute" name="Category" id="Category"
										class="form-control">
										<option v-for="families in attribute_families" :key="families.id" v-bind:value="families.id">
											{{ families.name }}
										</option>



									</select>


								</div>



							</div>
							<hr>

							<div class="row">

								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">{{ $t('messages.serial_number') }}</th>

												<th class="wd-15p border-bottom-0">{{ $t('messages.name') }}</th>
												<th class="wd-15p border-bottom-0">{{ $t('messages.code') }}</th>

												<th class="wd-15p border-bottom-0">{{ $t('messages.values') }}</th>
												<th class="wd-15p border-bottom-0"> {{ $t('messages.operations') }}</th>

											</tr>
										</thead>
										<tbody v-if="attributes && attributes.length > 0">
											<tr v-for="(attribute, index) in attributes" :key="index">
												<td>{{ index + 1 }}</td>

												<td>{{ $t('messages.' + attribute.name) }}</td>
												<td>{{ attribute.code }}</td>


												<td>
													<template v-for="(attr, indexd) in attribute.attribute_option">


														<template>
															<div style="float: left;" :key="indexd">



																<span style="color: blue;">
																	{{ $t('messages.' + attr.value) }}
																</span>&ensp;

															</div>

														</template>


													</template>
												</td>

												<td>
													<button type='button' @click="delete_Attribute(attribute.id)" class="btn btn-danger btn-sm"><i
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

			attribute_families: '',
			family_attribute: '',

			name: '',
			code: '',
			code_value: [],
			status: '',
			counts: {},
			count: 1,
			value: [],
			msg: '',


		}
	},
	mounted() {
		console.log('almuhiiiiiiiiiiiiiiiiiiiiii', window.axios.defaults.baseURL);
		this.counts[0] = 1;
		this.fetchAttributes();
	},
	watch: {
		currentLocale() {
			this.fetchAttributes();
		}
	},
	methods: {
		fetchAttributes() {
			this.axios.post('/attribute').then(response => {
				this.attributes = response.data.attributes;
				this.attribute_families = response.data.attribute_families;

			})
		},

		delete_Attribute(id) {

			this.axios.post(`delete_Attribute/${id}`).then(response => {
				toast.fire({
					title: this.$t('messages.deleted'),
					text: this.$t('messages.attribute_deleted_success'),
					button: this.$t('messages.close'), // Text on button
					icon: "success", //built in icons: success, warning, error, info
					timer: 3000, //timeOut for auto-close
					buttons: {
						confirm: {
							text: this.$t('messages.ok'),
							value: true,
							visible: true,
							className: "",
							closeModal: true
						},
						cancel: {
							text: this.$t('messages.cancel'),
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
			var gf = this;
			axios
				.post(`/export_opening_inventuries`)
				.then(function (response) {

					toastMessage(gf.$t('messages.export_success'));
					gf.$router.go(0);
				})
				.catch(error => {


				});
		},
		imports_excel() {
			var gf = this;
			axios
				.post(`/import_opening_inventuries`)
				.then(function (response) {
					toastMessage(gf.$t('messages.import_success'));
					gf.$router.go(0);

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