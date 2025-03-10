<template>

	<div class="container-fluid">


		<div class="row">

			<div class="card">

				<div class="card-header">
					<h2 class="card-title mg-b-0">المنتجات</h2>
				</div>

				<div class="card-body">




















					<fieldset class="border rounded-3 p-3">
						<legend class="float-none w-auto px-3">بياتات المنتج</legend>
						<form @submit.prevent="formSubmit" enctype="multipart/form-data">
							<div class="row">

								<div class="col-md-12">
									<label for="pagoPrevio">المنتج</label>
									<input v-model="product" type="text" name="Product" id="Product"
										class="form-control">


								</div>
								<div class="col-md-12">
									<label for="pagoPrevio">مجموعه الخواص</label>

									<select @change="get_attribute()" v-model="family_attribute" name="Category"
										id="Category" class="form-control">
										<option v-for="families in attribute_families" v-bind:value="families.id">
											{{ families.name }}
										</option>



									</select>

								</div>
								<div class="col-md-12">
									<label for="pagoPrevio">جديد</label>

									<select v-model="New" name="Category" id="Category" class="form-control">
										<option value="">select</option>
										<option value="yes">yes</option>
										<option value="no">no</option>

									</select>

								</div>
								<div class="col-md-12">
									<label for="pagoPrevio">مميز</label>


									<select v-model="featured" name="Category" id="Category" class="form-control">
										<option value="">select</option>
										<option value="yes">yes</option>
										<option value="no">no</option>


									</select>

								</div>


							</div>
						</form>
					</fieldset>


					<fieldset class="border rounded-3 p-3">
						<legend class="float-none w-auto px-3">شحره الاصناف </legend>








						<div class="input-group">


							<input type="text" id="ricerca-enti" class="form-control" placeholder="بحث..."
								aria-describedby="search-addon">


						</div>

						<div id="treeview_json_product">
							<div id="test">

							</div>
						</div>








					</fieldset>



					<fieldset class="border rounded-3 p-3">
						<legend class="float-none w-auto px-3">الخواص</legend>
						<div class="col-md-12">


							<form @submit.prevent="formSubmit" enctype="multipart/form-data">

								<!-- <form action="post" @submit.prevent="submitForm" enctype="multipart/form-data"> -->

								<div class="table-responsive">
									<table class="table table-bordered text-right m-t-30"
										style="width: 100%; font-size: x-small">
										<thead>
											<tr>
												<th>السعر</th>
												<th>الخصم</th>
												<th>الكميه</th>
												<th>الخواص</th>
												<th>صوره المنتج</th>
												<th>الوصف</th>
												<th>اضافه</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="index in count" :key="index">


												<td>
													<input v-model="price[index - 1]" type="text" class="form-control"
														name="name" id="name" required />
												</td>
												<td>
													<input v-model="discount[index - 1]" type="text"
														class="form-control" name="name" id="name" required />
												</td>
												<td>
													<input v-model="qty[index - 1]" type="text" class="form-control"
														name="name" id="name" />
												</td>
												<td>

													<div v-for="(atta, index1) in attributes">


														<div v-for="(atta2, index2) in atta.attribute_family_mapping"
															class="col-md-12">
															<label for="pagoPrevio"> {{
																atta2.attribute.name
															}}</label>

															<select @change="addFind(index, index2, $event, atta2.id)"
																class="form-control">
																<option
																	v-for="(atta3, index3) in atta2.attribute.attribute_option"
																	:value="atta3.id">
																	{{
																		atta3.value
																	}}
																</option>



															</select>
														</div>



													</div>




												</td>

												<td>
													<input type="file" class="form-control"
														v-on:change="onFileChange($event, index)">


													<!-- <input v-on:change="onFileChange(index)"
										type="file" name="image"
										class="form-control-file" id="filePhoto">
									<img src="" id="previewHolder" width="150px"> -->
												</td>


												<td>
													<input v-model='description[index - 1]' type="text"
														class="form-control">


												</td>


												<td v-if="index == 1">
													<a class="tn btn-info btn-sm waves-effect btn-agregar"
														@click="addComponent(count)">
														<i class="fa fa-plus-circle"></i></a>

													<a class="tn btn-info btn-sm waves-effect btn-agregar"
														@click="disComponent(count)">
														<i class="fa fa-minus-circle"></i></a>
												</td>



											</tr>
											<tr>

												<td colspan="6"></td>
												<td>
													<button class="btn btn-primary btn-lg btn-block">حفظ</button>
												</td>
											</tr>


										</tbody>
									</table>
								</div>
								<!-- </form> -->



							</form>




						</div>


					</fieldset>












				</div>
			</div>
		</div>
		<div class="row row-sm">


			<div class="card">

				<div class="card-header pb-0">



					<div style="display: flex;float: left; margin: 5px">



						<input type="search" autocomplete="on" name="search" data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="true" placeholder="بحث" v-model="word_search"
							@input="get_search()" />


					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table text-md-nowrap" id="example1">
							<thead>

								<tr>




								</tr>
							</thead>
							<tbody v-if="products && products.length > 0">

								<tr v-for="productss in products">



									<template>
										<div class="row">

											<div class="col-md-2">
												{{ productss.text }}

											</div>

											<div class="col-md-10">

												<template v-for="product_family in productss.product_family_attribute ">

													<div class="row">

														<div class="row">

															<div class="col-md-4">

																<div class="col-md-12">
																	الكميه: {{ product_family.qty }}

																</div>

																<div class="col-md-12">
																	السعر:{{ product_family.price }}

																</div>


																<div class="col-md-12"
																	v-for="option in product_family.family_attribute_option ">
																	<p>{{ option.name }}:{{ option.value
																		}}</p>
																</div>
															</div>

															<div class="col-md-2">

																<img class="card-img"
																	:src="`/Ecommerce/assets/upload/${product_family.image}`"
																	alt="Product Image" height='200px' />



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


													</div>



												</template>

											</div>




										</div>
										<hr>
									</template>

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
			products: '',


			product: '',
			qty: [],
			price: [],
			description: [],
			discount: [],

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

		this.axios.post('/product').then(response => {

			console.log(response.data.product);
			this.products = response.data.product;
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

				this.jsonTreeData = response.data.trees;
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
								label: "تحرير",
								action: function (data) {

									console.log('تحرير');
								},
							},
							deleteItem: {
								// The "delete" menu item
								label: "حذف",
								action: function (data) {

									console.log('حذف');

								},
							},
							addItem: {
								// The "delete" menu item
								label: "اضافه",
								action: function (data) {


									console.log('اضافه');


								},
							},

						}
					},

				}).on('rename_node.jstree', function (e, data) {

				}).on("changed.jstree", function (e, data) {

					gf.product_id = data.node.id;
					// axios.post(`/category_filter/${data.node.id}`).then((response) => {

					//     gf.showCatProduct = response.data;
					//     gf.array_id.product_id = data.node.id;

					// });

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
		}

	}

}


</script>
<style>
legend {

	font-weight: lighter;
	color: cadetblue;
}
</style>