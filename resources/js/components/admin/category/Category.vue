<template>
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">

				<div class="card-header pb-0">
						<span class="h2"> الاصناف</span>

					<div style="display: flex;float: left; margin: 5px">

						<router-link to ='create_category'  class="tn btn-info btn-sm waves-effect btn-agregar" data-toggle="modal" id="agregar_productos"
							data-target="#addAb">
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

									<th class="wd-15p border-bottom-0"> العمليات</th>



								</tr>
							</thead>
							<tbody>
								<tr v-for="categorys in category">
									<td>{{ categorys.id }}</td>

									<td>{{ categorys.name }}</td>
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
											class="edit btn btn-success btn-sm"> <i class="fa fa-edit"></i></router-link>
									</td>


									<!-- <a href="{{route('admin.brand.delete', $brand->id)}}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a> -->

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
			category: 'yes',
		}
	},
	mounted() {
		this.axios.post('/category').then(response => {
			this.category = response.data;
			this.$root.logo = 'Category'

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
		}
	}
}
</script>

