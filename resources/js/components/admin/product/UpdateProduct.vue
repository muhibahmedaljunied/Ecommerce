<template>
    	<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">المنتجات</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
                                 <div class="form">
                    <form method="post" @submit.prevent="updateproduct">

                     <div class="form-group">
                        <label for="Product">الاسم</label>
                        <input v-model="product" type="text" class="form-control"  name="Product" id="Product">                   
                    </div>

                    <div class="form-group">
                        <label for="Category">الصنف</label>
                        <select v-model="categoryselected" name="Category" id="Category" class="form-control">
                            <option value="">select</option>
                            <option v-for="categorys in category"  v-bind:value ='categorys.id' >{{categorys.name}}</option>
                        </select>
                   
                    </div>
                   <div class="form-group">
                        <label for="Country">بلد الصنع</label>
                        <select v-model ='countryselected'  name="Country" id="Country" class="form-control">
                            <option value="">select</option>
                            <option v-for="countrys in country" v-bind:value ='countrys.id'>{{countrys.name}} </option>
                        </select>
                   
                    </div>
                    <div class="form-group">
                        <label for="Size">المقاس</label>
                        <select v-model='sizeselected'  name="Size" id="Size" class="form-control">
                            <option value="">select</option>
                            <option  v-for="sizes in size" v-bind:value ='sizes.id' >{{sizes.name}}</option>
                        </select>
                   
                    </div>
                     <div class="form-group">
                        <label for="qty">الكميه</label>
                        <input v-model="qty" type="text"  name="qty" id="qty" class="form-control">                   
                    </div>
                     <div class="form-group">
                        <label for="price">السعر</label>
                        <input v-model="price" type="text"  name="price" id="price" class="form-control">                   
                    </div>
                     <div class="form-group">
                        <label for="discount">الخصم</label>
                        <input v-model="discount" type="text"  name="discount" id="discount" class="form-control">                   
                    </div>
                    <div class="form-group">
                        <label for="Product">الجاله</label>
                        <input v-model="status" type="text"  name="status" id="status" class="form-control">
                   
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
             
             category:'',
             product:'',
             qty:'',
             price:'',
             discount:'',
             country:'',
             size:'',
             status:'',
             categoryselected:'',
             countryselected:'',
             sizeselected:'',

          }
        },
      created() {
            let uri = `/product/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {

                this.product = response.data.product.name;
                this.category = response.data.category;
                this.country = response.data.country;
                this.size = response.data.size;
                this.qty = response.data.product.qty;
                this.price = response.data.product.price;
                this.discount = response.data.product.discount;
                this.status = response.data.product.status;
                // ---------------------------------------------------------------- this for return default 
                this.categoryselected = response.data.product.category_id
                this.countryselected=response.data.product.country_id
                this.sizeselected = response.data.product.size_id

                this.$root.logo = 'Product'


            });
        },
        methods:{
            updateproduct(event){

            let uri = `/update_product/${this.$route.params.id}`;
            axios.post(uri,{name: this.product,qty: this.qty,price: this.price,discount: this.discount, category_id:this.categoryselected,country_id:this.countryselected,size_id:this.sizeselected}).then(response => {
                    event.preventDefault();
                        toast.fire({
                                title: "Updated!",
                                text: "Your category has been Updated.",
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
            })
            }
        }
    }
</script>