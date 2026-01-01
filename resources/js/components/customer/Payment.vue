<template>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>{{ $t('messages.choose_payment_method') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">

                            <table class="table table-bordered">


                                <tr>
                                    <td>{{ $t('messages.cash_on_delivery') }}</td>
                                    <td><input type="radio" v-model="type" name="payment_info" value="cash"></td>
                                </tr>
                                <tr>
                                    <!-- <td>Visa/Master Card</td> -->
                                    <td>{{ $t('messages.paypal') }}</td>

                                    <td><input type="radio" v-model="type" name="payment_info" value="paypal"></td>
                                </tr>
                                <!-- <tr>
                                    <td>Bkash</td>
                                    <td><input type="radio" v-model="type" name="payment_info" value="bkash"></td>
                                </tr> -->
                                <tr>
                                    <td>{{ $t('messages.stripe') }}</td>
                                    <td><input type="radio" v-model="type" name="payment_info" value="stripe"></td>
                                </tr>
                            </table>

                            <!-- <button type="button" v-if="type == 'cash'" class="btn btn-primary"
                                @click="orderConfirm">Confirm
                                Order</button> -->
                            <button type="button" v-if="type == 'paypal'" class="btn btn-primary"
                                @click="orderPayment">{{ $t('messages.confirm_order') }}</button>


                        </form>
                        <div v-if="type == 'stripe'">
                            <div class="panel-body">


                                <!-- <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p id = 'alert_pay'></p>
                                </div> -->


                                <form role="form" class="validation" data-cc-on-file="false"
                                    data-stripe-publishable-key="pk_test_51NDNkyD06bl0jbZ3v3YEDP13LGwaJueHTrhPbB5medA2gyNoEP6ETE6hHWUBISv6QRgj4NxpTnTBSFiSYa1zJARu006gQD4YTz"
                                    id="payment-form">


                                    <div class='form-group required'>
                                        <label class='control-label'>{{ $t('messages.name_on_card') }}</label>
                                        <input class='form-control' size='4' type='text' value="muhib">
                                    </div>


                                    <div class='form-group card required'>
                                        <label class='control-label'>{{ $t('messages.card_number') }}</label>
                                        <input autocomplete='off' class='form-control card-num' size='20' type='text'
                                            value="4242424242424242">
                                    </div>

                                    <div class='form-group cvc required'>
                                        <label class='control-label'>{{ $t('messages.cvc') }}</label>
                                        <input autocomplete='off' class='form-control card-cvc' :placeholder="$t('messages.cvc_placeholder')"
                                            size='4' type='text' value="128">
                                    </div>
                                    <div class='form-group expiration required'>
                                        <label class='control-label'>{{ $t('messages.expiration_month') }}</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2' type='text'
                                            value="4">
                                    </div>
                                    <div class='form-group expiration required'>
                                        <label class='control-label'>{{ $t('messages.expiration_year') }}</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'
                                            value="2029">
                                    </div>

                                    <!-- <div class='form-row row'>
                                        <div class='col-md-12 hide error form-group'>
                                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn btn-danger btn-lg btn-block"
                                                @click.prevent="orderConfirm_stripe">{{ $t('messages.pay_now') }}
                                                ($ 100)</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- ----------------------------------------Cash----------------------------------------------------- -->
                        <div v-if="type == 'cash'">
                            <form method="post">

                                <div class="form-group">
                                    <label>{{ $t('messages.full_name') }}</label>
                                    <input type="text" v-model="full_name" class="form-control" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label>{{ $t('messages.email_address') }}</label>
                                    <input type="email" v-model="email" class="form-control" name="email_address" required>
                                </div>
                                <div class="form-group">
                                    <label>{{ $t('messages.phone') }}</label>
                                    <input type="text" v-model="number" class="form-control" name="phone_no" required>
                                </div>
                                <div class="form-group">
                                    <label>{{ $t('messages.address') }}</label>
                                    <input type="text" v-model="address" class="form-control" name="address" required>
                                </div>
                                <!-- <div class="m-t-20 col-md-4"> -->

                                <!-- <button type="button" v-if="type == 'cash'" class="btn btn-primary"
                                    @click="orderConfirm">Confirm
                                    Order</button> -->
                                    <button type="button" v-if="type == 'cash'" class="btn btn-primary"
                                    @click="orderConfirm">
                                    {{ $t('messages.confirm_order') }}</button>




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
            full_name: '',
            email: '',
            number: '',
            address: '',
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
                full_name: this.full_name,
                email: this.email,
                number: this.number,
                address: this.address,

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

                    // this.$router.push('/customer/home');
                    // this.$store.dispatch("countCart");
                })
        },
        orderConfirm_stripe(e) {
            e.preventDefault();

            var $form = $(".validation");
            // $('form.validation').bind('submit', function (e) {
            var $form = $(".validation"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            // console.log($errorStatus);

            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                // e.preventDefault();

                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeHandleResponse);
            }


            // });

            function stripeHandleResponse(status, response) {

                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // console.log(response);

                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

                    // console.log($form.get(0));
                    // this.stripe($form.get(0));

                    axios.post('/stripe/stripe-payment', {
                        type_pay: 'stripe',
                        stripeToken: token
                    })
                        .then((response) => {
                            // console.log('11111111111111111111');

                            // $('#alert_pay').html(response.message);
                            toast.fire({
                                title: "Created!",
                                text: response.data.message,
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


                            // console.log(response.data.message);
                            // console.log('22222222222222222222');

                        })


                }
            }

        },
        // stripe(data) {

        // console.log(data);
        // axios.post('/stripe/stripe-payment', {
        //     type: this.type,
        //     type_pay: 'stripe',
        // })
        //     .then((response) => {
        //         console.log(response);
        //         // alert("Thanks for your order.");
        //         toast.fire({
        //             title: "Created!",
        //             text: "Thanks for your order.",
        //             button: "Close", // Text on button
        //             icon: "success", //built in icons: success, warning, error, info
        //             timer: 4000, //timeOut for auto-close
        //             buttons: {
        //                 confirm: {
        //                     text: "OK",
        //                     value: true,
        //                     visible: true,
        //                     className: "",
        //                     closeModal: true
        //                 },
        //                 cancel: {
        //                     text: "Cancel",
        //                     value: false,
        //                     visible: true,
        //                     className: "",
        //                     closeModal: true,
        //                 }
        //             }
        //         })

        //         this.$router.push('/customer/home');
        //         // this.$store.dispatch("countCart");
        //     })
        // },
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

<style scoped>
.container {
    margin-top: 40px;
}

.panel-heading {
    display: inline;
    font-weight: bold;
}

.flex-table {
    display: table;
}

.display-tr {
    display: table-row;
}

.display-td {
    display: table-cell;
    vertical-align: middle;
    width: 55%;
}
</style>
</style>
