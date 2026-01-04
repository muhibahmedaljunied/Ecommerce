<template>

	<div class="container-fluid">

		<fieldset class="border rounded-3 p-3">



			<legend class="float-none w-auto px-3">{{ $t('messages.Category Tree') }}</legend>



			<div class="input-group">

				<input type="text" id="ricerca-enti" class="form-control" :placeholder="$t('messages.Search') + '...'"
					aria-describedby="search-addon">

			</div>



			<div id="treeview_json_product">
				<div id="test">

				</div>
			</div>







		</fieldset>

		<div class="row">

			<div class="col-md-12">

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
								aria-haspopup="true" aria-expanded="true" :placeholder="$t('messages.Search')" v-model="word_search"
								@input="get_search()" />
						</div>
					</div>
					<div class="card-body">






						<div class="row">

							<div class="table-responsive">
								<table class="table text-md-nowrap" id="example1">
									<thead>

										<tr>




										</tr>
									</thead>
									<tbody v-if="showCatProduct && showCatProduct.length > 0">

										<tr v-for="(productss, index) in showCatProduct" :key="index">



											<template>
												<div class="row">

													<div class="col-md-2">

														{{ index + 1 }}

													</div>
													<div class="col-md-2">
														{{ $t('messages.' + productss.name) }}

														<div class="col-md-12"
															v-for="produc_option in productss['product_family_attribute']">


															<span
																v-for="option in produc_option.family_attribute_option">
															{{ $t('messages.' + option.value) }}
															</span>

														</div>

													</div>

													<div class="col-md-8">

														<template
															v-for="product_family in productss['product_family_attribute']">

															<div class="row">

																<div class="row">

																	<div class="col-md-4">

																		<div class="col-md-12">
																			{{ $t('messages.Quantity') }}: {{ product_family.qty }}

																		</div>

																		<div class="col-md-12">
																			{{ $t('messages.Price') }}:{{ product_family.price }}

																		</div>

																		<!-- <div class="col-md-12"
																			v-for="option in product_family.family_attribute_option">
																			<p>{{ option.name }}:{{ option.value
																			}}</p>
																		</div> -->
																	</div>

																	<div class="col-md-2">

																		<img class="card-img"
																			:src="`/Ecommerce/assets/upload/${product_family.image}`"
																			alt="Product Image" height='200px' />



																	</div>

																	<div class="col-md-6">



																		<button type='button'
																			class="btn btn-danger btn-sm"><i
																				class="fa fa-trash"></i></button>
																		<router-link
																			:to="{ name: 'edit_product', params: { data: productss } }"
																			class="btn btn-success btn-sm"><i
																				class="fa fa-edit"></i></router-link>





																	</div>


																</div>


															</div>



														</template>

													</div>




												</div>
												<hr>
											</template>

										</tr>

									</tbody>
									<tbody v-else>
										<tr>
											<td style="text-align: center;" colspan="7">
												{{ $t('messages.No data available') }}
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

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
			products: '',

			showCatProduct: '',

			product: '',
			qty: [],
			price: [],
			description: [],
			discount: [],
			word_search: '',
			New: '',
			featured: '',
			status: '',
			image: '',
			categoryselected: '',
			parentselected: 0,
			jsonTreeData: '',
			attribute_families: '',
			family_attribute: '',
			attributes: '',
			attr_array: [],
			att_family: '',
			// att_all_family: [],
			product_id: '',
			errors: '',
			success: '',
			// filename: '',
			counts: [],
			count: 1,
			count_attributes: 1,
			file: [],

		}
	},
	mounted() {

		this.counts[0] = 1;
		this.showtree();
		this.att_family = Array.from(Array(this.count), () => new Array(this.count_attributes))

		this.fetchProducts();
	},
	watch: {
		currentLocale() {
			this.refreshTree();
			this.fetchProducts();
		}
	},
	methods: {
		fetchProducts() {
			this.axios.post('/product').then(response => {

				console.log(response.data.product);
				this.showCatProduct = response.data.product;
				// this.$root.logo = 'Product'

			})
		},
		refreshTree() {
			if ($('#treeview_json_product').jstree(true)) {
				$('#treeview_json_product').jstree(true).destroy();
			}
			this.showtree();
		},
		translateTree(nodes) {
			if (!nodes) return [];
			return nodes.map(node => {
				const newNode = { ...node };
				if (newNode.name) {
					newNode.name = this.$t('messages.' + newNode.name);
				}
				if (newNode.children && newNode.children.length > 0) {
					newNode.children = this.translateTree(newNode.children);
				}
				return newNode;
			});
		},
		delete_product(id) {

			this.axios.post(`/delete_product/${id}`).then(response => {

				toast.fire({
					title: this.$t('messages.deleted'),
					text: this.$t('messages.product_deleted_success'),
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

				// this.$router.push('category')

			})
		},

		addComponent(index) {
			// alert(index);
			this.count += 1;
			// this.counts[index] = this.count;
			if (index == 0) {

				this.counts[index] = 0;
			} else {
				this.counts[index] = this.count;

			}

			this.att_family = Array.from(Array(this.count), () => new Array(2))
		},
		disComponent(index) {
			this.count -= 1;
			$this.counts.pop();
			// this.$delete(this.counts, index);
		},
		addFind(index, index2, event, att) {


			index = index - 1;
			console.log(index, index2);
			this.att_family[index][index2] = [att, event.target.value];

		},

		get_attribute() {


			var gf = this;
			this.axios.post('/product/get_attributes',
				{
					id: this.family_attribute
				}).then(function (response) {


					console.log(response.data.attributes);
					gf.count_attributes = response.data.count_attributes
					gf.attributes = response.data.attributes;

				})
				.catch(function (error) {
					// currentObj.output = error;
				});

			return

		},
		showtree() {

			// console.log('in show tree', this.$route.params.id);
			var uri = `/tree_product`;
			var gf = this;
			// ------------هذا لاجل البحث في الشجره-----------------------------
			var to = false;
			$('#ricerca-enti').keyup(function () {
				if (to) {
					clearTimeout(to);
				}
				to = setTimeout(function () {
					var v = $('#ricerca-enti').val();
					$('#treeview_json_product').jstree(true).search(v);
				}, 250);
			});

			// -------------------------------------------------

			this.axios.post(uri).then((response) => {
				//   this.trees = response.data.trees;

				this.jsonTreeData = this.translateTree(response.data.trees);
				this.attribute_families = response.data.attribute_families;

				$(`#treeview_json_product`).jstree({
					core: {
						themes: {
							responsive: false,
						},
						// so that create works
						check_callback: true,
						data: this.jsonTreeData,
					},
					// types: {
					// default: {
					//   icon: "fa fa-plus text-primary",
					// },
					// file: {
					//   icon: "fa fa-file  text-primary",
					// },
					// },
					// checkbox: {
					//   three_state: false,

					// },
					state: {
						key: "demo2"
					},
					search: {
						case_insensitive: true,
						show_only_matches: true
					},
					plugins: [
						// "checkbox",
						"contextmenu",
						"dnd",
						"massload",
						"search",
						// "sort",
						"state",
						// "types",
						"unique",
						"wholerow",
						"changed",
						"conditionalselect"],
					contextmenu: {
						items: {

							renameItem: {
								// The "rename" menu item
								label: gf.$t('messages.edit'),
								action: function (data) {

									console.log('تحرير');
								},
							},
							deleteItem: {
								// The "delete" menu item
								label: gf.$t('messages.delete'),
								action: function (data) {

									console.log('حذف');

								},
							},
							addItem: {
								// The "delete" menu item
								label: gf.$t('messages.add'),
								action: function (data) {


									console.log('اضافه');


								},
							},

						}
					},

				}).on('rename_node.jstree', function (e, data) {

				}).on("changed.jstree", function (e, data) {

					// gf.array_id.product_id = data.node.id;

					// alert(data.node.id);
					axios.post(`/category_filter/${data.node.id}`, { 'type': 'product' }).then((response) => {

						gf.showCatProduct = response.data.products;
						// gf.array_id.product_id = data.node.id;

					});

				});

			});

			// $('#treeview_json_product').jstree(true).destroy();

		},
		onFileChange(e, index) {


			this.file[index] = e.target.files[0];
			console.log(this.file);
		},
		formSubmit() {


			// alert(this.counts);

			let currentObj = this;
			const config = {
				headers: {
					"content-type": "multipart/form-data",
				},
			};
			// form data

			let formData = new FormData();
			formData.append("count", JSON.stringify(this.counts));
			formData.append("product", this.product);
			formData.append("parent", this.product_id);
			formData.append("attribute", this.attr_array);
			formData.append("family_id", this.family_attribute);
			formData.append("product_attr", JSON.stringify(this.att_family));
			formData.append("status", 'false');
			formData.append("qty", JSON.stringify(this.qty));
			formData.append("price", JSON.stringify(this.price));
			formData.append("description", JSON.stringify(this.description));
			formData.append("discount", JSON.stringify(this.discount));
			formData.append("featured", this.featured);
			formData.append("new", this.New);

			for (let i = 0; i < this.file.length; i++) {

				// payload.append('image[]', this.image[i])
				formData.append("image[]", this.file[i]);

			}

			// formData.append("image", this.file);


			this.axios.post('/store_product',
				formData,
				config

			)
				.then(function (response) {


				})
				.catch(function (error) {
					currentObj.output = error;
				});
			// this.$router.go(-1);
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
