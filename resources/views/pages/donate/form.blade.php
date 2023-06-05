<?php

use App\Models\Donate;

/**
 * @var $model Donate
 */
?>

@extends('layouts.main')

@section('title', $model->title)

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div id="liqpay_checkout"></div>
        </div>
    </div>
@endsection

@section('end-scripts')
    <script>
        window.LiqPayCheckoutCallback = function () {
            LiqPayCheckout.init({
                data: '{{$data['data']}}',
                signature: "{{$data['signature']}}",
                embedTo: "#liqpay_checkout",
                language: "uk",
                mode: "embed" // embed || popup
            }).on("liqpay.callback", function (data) {
                console.log(data.status);
                console.log(data);

                fetch('{{route('donate.pay-result')}}', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        _token: "{{csrf_token()}}",
                        transaction: data
                    })
                })


            }).on("liqpay.ready", function (data) {
                // ready
            }).on("liqpay.close", function (data) {
                // close
            });
        };
    </script>
    <script src="//static.liqpay.ua/libjs/checkout.js" async></script>
@endsection
