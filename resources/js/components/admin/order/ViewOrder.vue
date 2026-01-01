<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <span class="h2">{{ $t('messages.order_details') }}</span>
                                <!-- <router-link :to="`/order_invoice/${showorderInformation.id}`"
                                    class="btn btn-primary float-right">
                                    فاتوره </router-link> -->
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ $t('messages.order_no') }}</th>
                                            <th>{{ $t('messages.order_total') }}</th>
                                            <th>{{ $t('messages.order_status') }}</th>
                                            <th>{{ $t('messages.date') }}</th>
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
                                <h2>{{ $t('messages.customer_data') }}</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ $t('messages.name') }} </th>
                                            <th>{{ $t('messages.phone') }}</th>
                                            <th>{{ $t('messages.email') }}</th>
                                            <th>{{ $t('messages.address') }}</th>
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
                                <h2>{{ $t('messages.payment_data') }}</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>

                                    <tr >
                                        <th>{{ $t('messages.status') }} </th>
                                        <th>{{ $t('messages.payment_type') }}</th>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr v-for="payment in showCustomerInformation">
                                            <td style="color:red;" v-if="payment.payment_status == 'paid'">{{ $t('messages.paid') }}</td>
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
                                <h2>{{ $t('messages.product_info') }}</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ $t('messages.product_no') }}</th>
                                            <th>{{ $t('messages.product_name') }} </th>
                                            <!-- <th>الصنف</th>
                                            <th>المقاس</th>
                                            <th>بلد الصنع</th> -->

                                            <th>{{ $t('messages.price') }}</th>
                                            <th>{{ $t('messages.quantity') }}</th>
                                            <th>{{ $t('messages.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="Product in showProductInformation">
                                            <td>{{ Product.id }}</td>
                                            <td>{{ $t('messages.' + Product.text) }}</td>
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
                                    {{ $t('messages.invoice') }} </router-link>
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
        this.fetchData();
        this.$Progress.finish();
    },
    watch: {
        currentLocale() {
            this.fetchData();
        }
    },
    methods: {
        fetchData() {
            this.$store.dispatch("productByorder", this.$route.params.id)
            this.$store.dispatch("getOrderdetails", this.$route.params.id)
            this.$store.dispatch("customerByorder", this.$route.params.id)
        }
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