<template>
      <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <span class="h2">Order Information</span>
                                <router-link :to="`/order_invoice/${showorderInformation.id}`" class="btn btn-primary float-right">
                                    Make Invoice
                                </router-link>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                   <thead>
                                <tr>
                                    <th>Order no.</th>
                                    <th>Order Total</th>
                                    <th>Order Status</th>
                                    <th>Date Order</th>
                                </tr>
                                </thead>
                                <tbody>
                              <tr >
                                <td>{{showorderInformation.id}}</td>
                                <td>{{showorderInformation.order_total}}</td>
                                <td> {{showorderInformation.order_status}}</td>
                                 <td> {{showorderInformation.created_at}}</td>                              
							 </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Order no.</th>
                                    <th>Order Total</th>
                                    <th>Order Status</th>
                                    <th>Date Order</th>
                                </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Cutomer Information</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                <tr>
                                        <th>Customer name</th>
                                        <th>Phone No.</th>
                                        <th>Email address</th>
                                        <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                              <tr v-for="customer in showCustomerInformation">
                                <td>{{customer.name}}</td>
                                <td> {{customer.phone}}</td>
                                 <td> {{customer.email}}</td>
                                <td> {{customer.address}}</td>                             
							 </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Customer name</th>
                                    <th>Phone No.</th>
                                    <th>Email address</th>
                                    <th>Address</th>
                                </tr>
                                </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Payment Information</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Payment Status</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Type</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Product Information</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                  <thead>
                                <tr>
                                        <th>Product id</th>
                                        <th>Product name</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                              <tr v-for="Product in showProductInformation">
                                <td>{{Product.id}}</td>
                                <td>{{Product.name}}</td>
                                <td> {{Product.price}}</td>
                                 <td> {{Product.product_quantity}}</td>
                                <td> {{Product.total}}</td>                              
                              
							 </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Product id</th>
                                    <th>Product name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    export default {
        data(){
          return{
           
           info:[],
          }
        },
         mounted(){
               this.$Progress.start();
              this.$store.dispatch("productByorder", this.$route.params.id)
              this.$store.dispatch("getOrderdetails",this.$route.params.id)
              this.$store.dispatch("customerByorder",this.$route.params.id)
              this.$Progress.finish();
        },	
       computed: {
            showProductInformation(){
                return this.$store.getters.getProductInformation
            },
            showCustomerInformation(){
                return this.$store.getters.getCustomerInformation
            },
            showorderInformation(){
                return this.$store.getters.getOrderInformation
            }
        },
            
            
		
    }
</script>