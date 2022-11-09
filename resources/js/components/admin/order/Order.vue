<template>
    	<!-- row opened -->
		<div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order Page</h1>
                    </div>
                   
                </div>
            </div><!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                           
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Order List</span>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="brandDatatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Order no.</th>
                                    <th width="200">Customer Name</th>
                                    <th>Order Total</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                              <tr v-for="orders in order">
                                <td>{{orders.id}}</td>
                                <td>{{orders.customer_name}}</td>
                                <td>{{orders.order_total}}</td>
                                <td> {{orders.order_status}}</td>
                                <td> </td>
                                <td>
                                    <router-link :to="`/order_details/${orders.id}`" class="btn btn-success">
                                            <span><i class="fa fa-search-plus"></i></span>
                                    </router-link>
                                </td>

											        </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Order no.</th>
                                    <th width="200">Customer Name</th>
                                    <th>Order Total</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>
				<!-- /row -->
			
</template>
<script>
    export default {
        data(){
          return{
            order:'yes',
          }
        },
        mounted(){

              this.axios.post('order').then(response => {
              this.order = response.data;
              this.$root.logo = 'Order'

            })
		},	
     
		
    }
</script>
