<template>
    <!-- row opened -->
    <div class="content-wrapper">


        <div class="container-fluid">
            <section class="content">
                <div class="card">

                    <div class="card-header">
                        <span class="h4">الطلبات</span>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- <div class="card-header">
                            <span class="h4">الطلبات</span>
                        </div> -->
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="brandDatatable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>رقم الطلب</th>
                                                    <th width="200">العميل</th>
                                                    <th>الاجمالي</th>
                                                    <th>حاله الطلب</th>
                                                    <!-- <th>Payment Status</th> -->
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="order && order.length > 0">
                                                <tr v-for="orders in order">
                                                    <td>{{ orders.id }}</td>
                                                    <td>{{ orders.customer_name }}</td>
                                                    <td>{{ orders.order_total }}</td>
                                                    <td> {{ orders.order_status }}</td>
                                                    <!-- <td> </td> -->
                                                    <td>


                                                        <router-link
                                                            :to="{ name: 'order_details', params: { id: orders.id } }"
                                                            class="btn btn-success btn-sm"><i
                                                                class="fa fa-search-plus"></i>
                                                        </router-link>




                                                    </td>

                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td style="text-align: center;" colspan="5">
                                                        لايوجد اي بيانات
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- <tfoot>
                                <tr>
                                    <th>Order no.</th>
                                    <th width="200">Customer Name</th>
                                    <th>Order Total</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot> -->
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

    </div>
    <!-- /row -->
</template>
<script>
export default {
    data() {
        return {
            order: 'yes',
        }
    },
    mounted() {

        this.axios.post('/order').then(response => {
            console.log(response.data.order);
            this.order = response.data.order;


        })
    },


}
</script>
