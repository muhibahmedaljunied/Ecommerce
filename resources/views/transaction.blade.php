<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>


    <!-- <form data-action="{{ route('processTransaction') }}" method="GET" enctype="multipart/form-data" id="add-project-form"> -->
    <!-- @csrf -->
    <!-- <form class="form-horizontal" method="get" id="add-project-form" role="form" action="{!! URL::route('processTransaction') !!}"> -->

    <form class="form-horizontal" method="get" id="add-project-form">



        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Paywith Paypal
                </button>
            </div>
        </div>

    </form>

    <!-- Set up a container element for the button -->
    <!-- <div id="paypal-button-container"></div> -->

    <!-- Include the PayPal JavaScript SDK -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=<?php echo env('PAYPAL_SANDBOX_CLIENT_ID') ?>&currency=USD"></script> -->

    <!-- 
    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
 // Call your server to set up the transaction
             createOrder: function(data, actions) {
                return fetch('/api/paypal/order/create', {
                    method: 'POST',
                    // body:JSON.stringify({
                    //     'course_id': 1,
                    //     'user_id' : 1,
                    //     'amount' : 100,
                    // })
                }).then(function(res) {
                    //res.json();
                    return res.json();
                }).then(function(orderData) {
                    //console.log(orderData);
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/capture' , {
                    method: 'POST',
                    body :JSON.stringify({
                        orderId : data.orderID,
                        payment_gateway_id: 12,
                        user_id: 4,
                    })
                }).then(function(res) {
                   // console.log(res.json());
                    return res.json();
                }).then(function(orderData) {

                    // Successful capture! For demo purposes:
                  //  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    iziToast.success({
                        title: 'Success',
                        message: 'Payment completed',
                        position: 'topRight'
                    });
                });
            }

        }).render('#paypal-button-container');
    </script> -->

    <script>
        var table = '#projects-table';
        var modal = '#add-project-modal';
        var form = '#add-project-form';

        $(form).on('submit', function(event) {
            event.preventDefault();

            // var url = $(this).attr('data-action');
            var url = 'pay';


            // alert('sfsfsf');
            $.ajax({
                url: url,
                method: 'GET',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    // console.log(response);
                    window.top.location.href = response;
                },
                error: function(response) {}
            });
        });
    </script>

</body>

</html>