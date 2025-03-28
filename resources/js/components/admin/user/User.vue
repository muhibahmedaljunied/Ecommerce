<template>
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				
				<div class="card-header pb-0">
						<span class="h4">المستخدمين</span>
				

					<div style="display: flex;float: left; margin: 5px">

						<router-link to='create_user' class="tn btn-info btn-sm waves-effect btn-agregar"
							data-toggle="modal" id="agregar_productos" data-target="#addAb">
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
									<th class="wd-15p border-bottom-0">الرقم التسلسلي</th>

									<th class="wd-15p border-bottom-0">الاسم</th>
									<th class="wd-15p border-bottom-0">الهاتف</th>
									<th class="wd-15p border-bottom-0">البريد الالكتروني</th>
									<th class="wd-15p border-bottom-0">العنوان</th>
									<!-- <th class="wd-15p border-bottom-0">password</th> -->
									<th class="wd-15p border-bottom-0">الحاله</th>
									<!-- <th class="wd-20p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Updated At</th> -->
									<th class="wd-15p border-bottom-0"> العمليات</th>



								</tr>
							</thead>
							<tbody v-if="user && user.length>0">
								<tr v-for="(users,index) in user" :key="index">
									<td>{{ index+1 }}</td>

									<td>{{ users.name }}</td>
									<td>{{ users.phone }}</td>
									<td>{{ users.email }}</td>
									<td>{{ users.address }}</td>
									<!-- <td>{{users.password}}</td> -->
									<td>{{ users.status }}</td>
									<!-- <td> {{users.created_at}}</td>
												<td>{{users.updated_at}}</td> -->
												<td>
											<button type='button'
												class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											<router-link :to="{ name: 'edit_user', params: { data: users } }"
												class="edit btn btn-success btn-sm"> <i
													class="fa fa-edit"></i></router-link>
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
	<!-- /row -->
</template>
<script>
export default {
	data() {
		return {
			user: 'yes',
		}
	},
	mounted() {
		this.axios.post('/user').then(response => {
			this.$root.logo = 'User'
			this.user = response.data;
		})
	},
	methods: {
		delete_user(id) {

			this.axios.post(`/delete_user/${id}`).then(response => {

				// this.$router.push('user')

			})
		}
	}

}
</script>