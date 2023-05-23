<template>
    	<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">مقاسات المنتج</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
                                 <div class="form">
                    <form method="post" @submit.prevent="updatesize">

                     <input v-model ='size.id' type="hidden"  name="id_name" id="id_name">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input v-model='size.name' type="text"  name="name" id="name" class="form-control">
                       
                    </div>

                    <div class="form-group">
                        <label for="status">الحاله</label>
                        <input v-model='size.status' type="text"  name="status" id="status" class="form-control">
                       
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ</button>
                </form>
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
        data(){
          return{
            size:{
                  id:'',
                  name:'',
                  status:''
                  }
            }
        },
      created() {
            let uri = `/size/${this.$route.params.id}`;
            this.axios.post(uri).then(response => {

                this.size.id = response.data.id;
                this.size.name = response.data.name;
                this.size.status = response.data.status;

            });
        },
        methods:{
            updatesize(event){
            let uri = `/update_size/${this.$route.params.id}`;
            axios.post(uri,{name: this.size.name, status:this.size.status}).then(response => {
                    event.preventDefault();
                    toast.fire({
                                title: "Updated!",
                                text: "Your category has been updated.",
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
                    // this.$router.push('size')
            })
            }
        }
    }
</script>