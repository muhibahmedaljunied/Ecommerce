<template>
	<!-- row opened -->

	<div class="container-fluid">




		





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
											<router-link :to="{ name: 'edit_category', params: { data: categorys } }"
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
	},
	methods: {
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
