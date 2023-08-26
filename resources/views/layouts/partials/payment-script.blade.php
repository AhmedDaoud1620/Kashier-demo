<script
    id="kashier-iFrame"
    src="https://checkout.kashier.io/kashier-checkout.js"
    data-amount="{{$orderAmount}}"
    data-hash="{{$orderHash}}"
    data-currency="{{$orderCurrency}}"
    data-orderId="{{$orderId}}"
    data-merchantId="{{env('KASHIER_MERCHANT_ID')}}"
    data-merchantRedirect="{{route('success')}}"
    data-serverWebhook="{{route('paidWebHook')}}"
    data-mode="{{env('MODE')}}"
    data-allowedMethods="card,wallet,fawry"
    data-defaultMethod="{{$orderPaymentMethod}}"
    data-paymentRequestId="{{$inviceId}}"
    data-failureRedirect="TRUE"
    data-type="external"
    data-display="en"
></script>