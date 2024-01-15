<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <span class="h2">تفاصيل الطلب</span>
                                <!-- <router-link :to="`/order_invoice/${showorderInformation.id}`"
                                    class="btn btn-primary float-right">
                                    فاتوره </router-link> -->
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>الاجمالي </th>
                                            <th>حاله الطلب</th>
                                            <th>التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ showorderInformation.id }}</td>
                                            <td>{{ showorderInformation.order_total }}</td>
                                            <td> {{ showorderInformation.order_status }}</td>
                                            <td> {{ showorderInformation.created_at }}</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>بيانات العميل</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الاسم </th>
                                            <th>الهاتف</th>
                                            <th>البريد الالكتروني</th>
                                            <th>العنوان</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="customer in showCustomerInformation">
                                            <td>{{ customer.full_name }}</td>
                                            <td> {{ customer.phone_no }}</td>
                                            <td> {{ customer.email_address }}</td>
                                            <td> {{ customer.address }}</td>
                                        </tr>
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>بيانات الدفع</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>

                                    <tr >
                                        <th>الحاله </th>
                                        <th>نوع الدفع</th>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr v-for="payment in showCustomerInformation">
                                            <td style="color:red;" v-if="payment.payment_status == 'paid'">مدفوع</td>
                                            <td>{{ payment.payment_info }}</td>
                                        

                                        </tr>
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>معلومات المنتج</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>رقم المنتج</th>
                                            <th>اسم المنتج </th>
                                            <!-- <th>الصنف</th>
                                            <th>المقاس</th>
                                            <th>بلد الصنع</th> -->

                                            <th>السعر</th>
                                            <th>الكميه</th>
                                            <th>الاجمالي</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="Product in showProductInformation">
                                            <td>{{ Product.id }}</td>
                                            <td>{{ Product.text }}</td>
                                            <!-- <td>{{ Product.category }}</td>
                                            <td>{{ Product.size }}</td>
                                            <td>{{ Product.country }}</td> -->
                                            <td> {{ Product.product_price }}</td>
                                            <td> {{ Product.quantity }}</td>
                                            <td> {{ Product.product_price * Product.quantity }}</td>

                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <router-link :to="`/order_invoice/${showorderInformation.id}`"
                                    class="btn btn-primary float-right">
                                    فاتوره </router-link>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {

            info: [],
        }
    },
    mounted() {
        this.$Progress.start();
        this.$store.dispatch("productByorder", this.$route.params.id)
        this.$store.dispatch("getOrderdetails", this.$route.params.id)
        this.$store.dispatch("customerByorder", this.$route.params.id)
        this.$Progress.finish();
    },
    computed: {
        showProductInformation() {
            return this.$store.getters.getProductInformation
        },
        showCustomerInformation() {
            return this.$store.getters.getCustomerInformation
        },
        showorderInformation() {
            return this.$store.getters.getOrderInformation
        },
      
    },



}
</script>