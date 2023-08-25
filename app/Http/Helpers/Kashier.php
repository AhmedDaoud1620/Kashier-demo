<?php

namespace App\Http\Helpers;

use App\Models\Order;
use Carbon\Carbon;

class Kashier
{
    private $headers;
    private $currency;
    private $baseUrl;
    private $merchantId;
    private $lang;

    public function __construct($currency, $lang)
    {
        $this->headers = [
            'Authorization' =>env('KASHIER_SECRET_KEY'),
        ];
        $this->baseUrl = env('KASHIER_BASE_URL');
        $this->merchantId = env('KASHIER_MERCHANT_ID');
        $this->currency = $currency;
        $this->lang = $lang;
    }

    public function CreateInvoice(Order $order)
    {

        $body = [
            "paymentType" => "professional",
            "merchantId"=> $this->merchantId,
            "customerName"=> $order->user()->name,
            "dueDate"=>Carbon::now()->addDay()->format('Y-m-d\TH:i:s.u\Z'),
            "isSuspendedPayment"=>true,
            "description"> "order from Kashier Demo",
            "invoiceReferenceId"> $order->id,
            "invoiceItems"=> $order->orderItems()->map(function ($item) {
                return [
                    'description' => $item->product()->description,
                    'quantity' => $item->quantity,
                    'itemName' => $item->product()->name,
                    'unitPrice' => $item->product()->price,
                    'subTotal' => $item->product()->price * $item->quantity,
                ];
            }),
            "state"=> "submitted",
            "currency"=> $this->currency

        ];
        $url = $this->baseUrl . '/paymentRequest/?currency='. $this->currency;

        $response = NetworkCalls::apiPost($url, $body, $this->headers);
        $resBody =json_decode($response->getBody());
        //TODO handle errors and return the valid data from api
        if($response->status() != 200){
            throw new \Exception($resBody->title . 'This is Idf3 response with code' . $response->status(), 1);
        }


        return $resBody->walletAccount->publicAddress;
    }
    public function ShareInvoiceByEmail(Order $order)
    {

        $body = [
            "subDomainUrl"=> env('SUB_DOMAIN_URL'),
            "urlIdentifier"=> $order->payment()->invoice_id,
            "customerName"=> $order->user()->name,
            "storeName"=> env('STORE_NAME'),
            "customerEmail"=> $order->user()->email,
            "language"=> $this->lang,
            "operation"=> "email"
        ];
        $url = $this->baseUrl . '/paymentRequest/sendInvoiceBy?operation=share_payment_Request&currency='. $this->currency;

        $response = NetworkCalls::apiPost($url, $body, $this->headers);
        $resBody =json_decode($response->getBody());
        //TODO handle errors and return the valid data from api
        if($response->status() != 200){
            throw new \Exception($resBody->title . 'This is Idf3 response with code' . $response->status(), 1);
        }


        return $resBody->walletAccount->publicAddress;
    }
    public function GetInvoiceInfo($invoiceId)
    {
        $url = $this->baseUrl . '/paymentRequest/'. $invoiceId;
        $queryParams = ['currency' => $this->currency];


        $response = NetworkCalls::apiGet($url, $queryParams, $this->headers);
        $resBody =json_decode($response->getBody());
        //TODO handle errors and return the valid data from api

        if($response->status() != 200){
            throw new \Exception($resBody->title . 'This is Idf3 response with code' . $response->status(), 1);
        }


        return $resBody->walletAccount->publicAddress;
    }
}
