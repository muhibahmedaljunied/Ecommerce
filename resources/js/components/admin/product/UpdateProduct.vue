<template>
    	<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
                                 <div class="form">
                    <h3 class="text-center">Update Product</h3>
                    <form method="post" @submit.prevent="updateproduct">

                     <div class="form-group">
                        <label for="Product">Product</label>
                        <input v-model="product" type="text" class="form-control"  name="Product" id="Product">                   
                    </div>

                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select v-model="categoryselected" name="Category" id="Category" class="form-control">
                            <option value="">select</option>
                            <option v-for="categorys in category"  v-bind:value ='categorys.id' >{{categorys.name}}</option>
                        </select>
                   
                    </div>
                   <div class="form-group">
                        <label for="Country">Country</label>
                        <select v-model ='countryselected'  name="Country" id="Country" class="form-control">
                            <option value="">select</option>
                            <option v-for="countrys in country" v-bind:value ='countrys.id'>{{countrys.name}} </option>
                        </select>
                   
                    </div>
                    <div class="form-group">
                        <label for="Size">Size</label>
                        <select v-model='sizeselected'  name="Size" id="Size" class="form-control">
                            <option value="">select</option>
                            <option  v-for="sizes in size" v-bind:value ='sizes.id' >{{sizes.name}}</option>
                        </select>
                   
                    </div>
                     <div class="form-group">
                        <label for="qty">Qty</label>
                        <input v-model="qty" type="text"  name="qty" id="qty" class="form-control">                   
                    </div>
                     <div class="form-group">
                        <label for="price">Price</label>
                        <input v-model="price" type="text"  name="price" id="price" class="form-control">                   
                    </div>
                     <div class="form-group">
                        <label for="discount">Discount</label>
                        <input v-model="discount" type="text"  name="discount" id="discount" class="form-control">                   
                    </div>
                    <div class="form-group">
                        <label for="Product">Status</label>
                        <input v-model="status" type="text"  name="status" id="status" class="form-control">
                   
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">update</button>
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