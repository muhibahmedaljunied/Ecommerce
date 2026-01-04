<template>
    <div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> {{ $t('messages.print') }}</button>
            <a class="btn btn-info" href=""><i class="fa fa-file-pdf-o"></i> {{ $t('messages.export_pdf') }}</a>
            <button class="btn btn-info">{{ $t('messages.export_excel') }}</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a href="#">
                            <img src="/assets/img/brand/logo.png" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                                Lara3
                            </a>
                        </h2>
                        <div>Sector-10, Uttara, BD</div>
                        <div>(+880) 175-691-974</div>
                        <div>company@example.com</div>
                    </div>
                </div>

            </header>
            <main>
                <div class="row contacts">
                    <div v-for="customer in showCustomerInformation" :key="customer.id" class="col invoice-to">
                        <div class="text-gray-light">{{ $t('messages.invoice_to') }}:</div>
                        <h2 class="to">{{customer.name}}</h2>
                        <div class="address">{{customer.address}}</div>
                        <div class="email"><a target="_blank" href="">{{customer.email}}</a></div>
                    </div>
                    <div  class="col invoice-details">
                        <h1 class="invoice-id">{{ $t('messages.invoice') }}</h1>
                        <div  class="date">{{ $t('messages.order_date') }}: {{ showorderInformation.created_at }}</div>
                        <div class="date">{{ $t('messages.invoice_date') }}: {{ new Date().toLocaleDateString() }} </div>
                    </div>
                </div>
                <table border="0" cellspacing="2" cellpadding="2">
                    <thead>
                    <tr >
                        <th>#</th>
                        <th class="text-left">{{ $t('messages.product') }}</th>
                        <th class="text-right">{{ $t('messages.price') }}</th>
                        <th class="text-right">{{ $t('messages.quantity') }}</th>
                        <th class="text-right">{{ $t('messages.total') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(product, index) in showProductInformation" :key="index">
                        <td class="no">{{ index + 1 }}</td>
                        <td class="text-left"><h3>{{ $t('messages.' + product.name) }}</h3></td>
                        <td class="unit"> {{product.product_price}}</td>
                        <td class="qty">{{product.quantity}}</td>
                        <td class="total"> {{product.quantity * product.product_price}}</td>
                    </tr>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">{{ $t('messages.subtotal') }} </td>
                        <td> {{showorderInformation.order_total}} </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">{{ $t('messages.delivery_charge') }}</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">{{ $t('messages.grand_total') }}</td>
                        <td>{{showorderInformation.order_total}} </td>
                    </tr>
                    </tfoot>
                </table>
                <div class="thanks">{{ $t('messages.thank_you') }}</div>
                <div class="notices">
                    <div>{{ $t('messages.notice') }}:</div>
                    <div class="notice">{{ $t('messages.invoice_notice_text') }}</div>
                </div>
            </main>
            <footer>
                {{ $t('messages.invoice_footer') }}
            </footer>

        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
</template>
<script>
    export default {
        data(){
          return{

           info:[],
           SUBTOTAL:0,

          }
        },
        mounted(){
            this.fetchData();
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
            showProductInformation(){
                return this.$store.getters.getProductInformation
            },
        showCustomerInformation(){
            return this.$store.getters.getCustomerInformation
        },
        showorderInformation(){
            return this.$store.getters.getOrderInformation
        },
        showSession(){
            return this.$store.getters.getSessionData
        }
        }
    }
</script>
