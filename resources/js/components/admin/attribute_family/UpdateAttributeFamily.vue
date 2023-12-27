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
                    <form method="post" @submit.prevent="updateattribute_family">

                     <input v-model ='attribute_family.id' type="hidden"  name="id_name" id="id_name">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input v-model='attribute_family.name' type="text"  name="name" id="name" class="form-control">
                       
                    </div>

                    <div class="form-group">
                        <label for="status">الحاله</label>
                        <input v-model='attribute_family.status' type="text"  name="status" id="status" class="form-control">
                       
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
            attribute_family:{
                  id:'',
                  name:'',
                  status:''
                  }
            }
        },
      created() {
            let uri = `/attribute_family/${this.$route.params.id}`;
            this.axios.post(uri).then(response => {

                this.attribute_family.id = response.data.id;
                this.attribute_family.name = response.data.name;
                this.attribute_family.status = response.data.status;

            });
        },
        methods:{
            updateattribute_family(event){
            let uri = `/update_attribute_family/${this.$route.params.id}`;
            axios.post(uri,{name: this.attribute_family.name, status:this.attribute_family.status}).then(response => {
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
                    // this.$router.push('attribute_family')
            })
            }
        }
    }
</script>