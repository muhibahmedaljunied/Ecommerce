<template>
    <div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <a class="btn btn-info" href=""><i class="fa fa-file-pdf-o"></i> Export as PDF</a>
            <button>Export as Excel</button>
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
                    <div v-for="customer in showCustomerInformation" class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{customer.name}}</h2>
                        <div class="address">{{customer.address}}</div>
                        <div class="email"><a target="_blank" href="">{{customer.email}}</a></div>
                    </div>
                    <div  class="col invoice-details">
                        <h1 class="invoice-id">INVOICE </h1>
                        <div  class="date">Order Date:adadadadadaad</div>
                        <div class="date">Date of Invoice:adsdasdaadad </div>
                    </div>
                </div>
                <table border="0" cellspacing="2" cellpadding="2">
                    <thead>
                    <tr >
                        <th>#</th>
                        <th class="text-left">PRODUCT </th>
                        <th class="text-right">PRICE</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    <tr v-for="product in showProductInformation">
                        <td class="no">01</td>
                        <td class="text-left"><h3>{{product.name}}</h3></td>
                        <td class="unit">Tk. {{product.price}}</td>
                        <td class="qty">{{product.qty}}</td>
                        <td class="total">Tk. {{product.qty*product.price}}</td>
                    </tr>
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUBTOTAL </td>
                        <td>Tk.{{SUBTOTAL}} </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Delivery Charge</td>
                        <td>Tk. </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>Tk. </td>
                    </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
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
            //    this.$Progress.start();
            //   this.$store.dispatch("productByorder", this.$route.params.id)
            //   this.$store.dispatch("getOrderdetails",this.$route.params.id)
            //   this.$store.dispatch("customerByorder",this.$route.params.id)
            //   this.$Progress.finish();
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

