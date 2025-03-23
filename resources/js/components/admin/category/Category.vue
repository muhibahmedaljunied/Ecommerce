<template>
	<!-- row opened -->

	<div class="container-fluid">










		<fieldset class="border rounded-3 p-3">



			<legend class="float-none w-auto px-3">شجره الاصناف</legend>



			<div class="input-group">

				<input type="text" id="ricerca-enti" class="form-control" placeholder="بحث..."
					aria-describedby="search-addon">

			</div>



			<div id="treeview_json_product">
				<div id="test">

				</div>
			</div>








		</fieldset>
		<br>
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

										<th class="wd-15p border-bottom-0"> العمليات</th>



									</tr>
								</thead>
								<tbody v-if="category && category.length > 0">
									<tr v-for="categorys in category">
										<td>{{ categorys.id }}</td>

										<td>{{ categorys.text }}</td>
										<!-- <td>
                                                <img :src="`assets/img/20191214045454_41TxNIo3cQL.jpg`" height="50px" alt="category image">
                                                </td> -->
										<!-- <td>{{categorys.status}}</td>
												<td> {{categorys.created_at}}</td>
												<td>{{categorys.updated_at}}</td> -->
										<td>
											<button type='button' @click="delete_category(categorys.id)"
												class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											<router-link :to="{ name: 'edit_category', params: { id: categorys.id } }"
												class="edit btn btn-success btn-sm"> <i
													class="fa fa-edit"></i></router-link>
										</td>


										<!-- <a href="{{route('admin.brand.delete', $brand->id)}}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a> -->

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






	</div>

	<!-- /row -->
</template>

<script>
export default {

	data() {
		return {
			category: 'yes',


			name: '',
			attributes: '',
			file: '',
			errors: '',
			filename: '',
			success: '',
			jsonTreeData: '',
			parent: 0,
			checkedItems: [],

		}
	},
	mounted() {



		this.axios.post('/category').then(response => {
			this.category = response.data;
			// this.$root.logo = 'Category'

		})

		this.axios.post('/get_attribute').then(response => {

			this.attributes = response.data.attributes;

		})


		this.showtree();

	},
	methods: {
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

					gf.parent = data.node.id;


					// axios.post(`/category_filter/${data.node.id}`).then((response) => {

					//     gf.showCatProduct = response.data;
					//     gf.array_id.product_id = data.node.id;

					// });

				});

			});

			// $('#treeview_json_product').jstree(true).destroy();

		},
		delete_category(id) {

			this.axios.post(`delete_category/${id}`).then(response => {

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

				// this.$router.push('category')

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
