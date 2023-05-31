<template>
    <div class="container">
        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Choose a Payment Method!
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="post">

                            <table class="table table-bordered">


                                <tr>
                                    <td>Cash on delivery</td>
                                    <td><input type="radio" @click="isHidden == true" v-model="type" name="payment_info"
                                            value="cash"></td>
                                </tr>
                                <tr>
                                    <!-- <td>Visa/Master Card</td> -->
                                    <td>Paypal</td>

                                    <td><input type="radio" v-model="type" name="payment_info" value="card"></td>
                                </tr>
                                <!-- <tr>
                                    <td>Bkash</td>
                                    <td><input type="radio" v-model="type" name="payment_info" value="bkash"></td>
                                </tr> -->
                                <tr>
                                    <td>Stripe</td>
                                    <td><input type="radio" v-model="type" name="payment_info" value="stripe"></td>
                                </tr>
                            </table>

                            <button type="button" v-if="type == 'cash'" class="btn btn-primary"
                                @click="orderConfirm">Confirm
                                Order</button>
                            <button type="button" v-if="type == 'card'" class="btn btn-primary"
                                @click="orderPayment">Confirm Order</button>


                        </form>
                        <div v-if="type == 'stripe'">
                            <form role="form" action="" method="post" class="require-validation" data-cc-on-file="false"
                                data-stripe-publishable-key="" id="payment-form">
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label>
                                        <input class='form-control' size='50' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Card Number</label> <input autocomplete='off'
                                            class='form-control card-number' size='50' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                            class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-lg btn-block" type="button"
                                            @click="orderConfirm">Pay Now {{ showSubtotal }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            type: 'payment',
            // publishedKey: process.env.STRIPE_KEY,
        }
    },
    mounted() {

        if (this.$route.query.status) {

            this.message_payment(this.$route.query);
        }

    },
    created: {
        showSubtotal() {
            return this.$store.getters.getCartSubtotal
        }
    },
    methods: {
        orderConfirm() {
            axios.post('/customer/confirm-order', {
                type: this.type,
                type_pay: 'cash',
            })
                .then((response) => {
                    console.log(response);
                    // alert("Thanks for your order.");
                    toast.fire({
                        title: "Created!",
                        text: "Thanks for your order.",
                        button: "Close", // Text on button
                        icon: "success", //built in icons: success, warning, error, info
                        timer: 4000, //timeOut for auto-close
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

                    this.$router.push('/customer/home');
                    // this.$store.dispatch("countCart");
                })
        },
        orderPayment() {
            axios.post('/api/paypal/process-transaction', {
                type: this.type,
                type_pay: 'paypal',

            })
                .then((response) => {
                    console.log(response.data);
                    // alert("Thanks for your order.");

                    window.top.location.href = response.data;

                    // this.$router.push('/customer/home');
                    // this.$store.dispatch("countCart");
                })


        },
        message_payment() {

            var icon = 'error';
            if (this.$route.query.status == 'success') {
                icon = 'success';
            }
            toast.fire({
                title: this.$route.query.status,
                text: this.$route.query.message,
                button: "Close", // Text on button
                icon: icon, //built in icons: success, warning, error, info
                timer: 5000, //timeOut for auto-close
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

        }
    }
}
</script>
