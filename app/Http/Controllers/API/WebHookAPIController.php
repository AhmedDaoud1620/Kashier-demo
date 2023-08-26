<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookAPIController extends Controller
{
    public function kashierHook(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $raw_payload = file_get_contents('php://input');
            $json_data = json_decode($raw_payload, true);
            $data_obj = $json_data['data'];
            $event = $json_data['event'];
            sort($data_obj['signatureKeys']);
            $headers = getallheaders();
            // Lower case all keys
            $headers = array_change_key_case($headers);
            $kashierSignature = $headers['x-kashier-signature'];
            $data = [];
            foreach ($data_obj['signatureKeys'] as $key) {
                $data[$key] = $data_obj[$key];
            }
            $queryString = http_build_query($data, $numeric_prefix = "", $arg_separator = '&', $encoding_type = PHP_QUERY_RFC3986);
            $signature = hash_hmac('sha256', $queryString, env('KASHIER_PUBLIC_KEY'), false);;
            if ($signature == $kashierSignature) {
                http_response_code(200);
                if ($event == 'pay' && $json_data['data']['status'] == 'SUCCESS'){
                    $order = Order::where('order_merchant_id', $json_data['data']['merchantOrderId'])->first();
                    $order->payment->status = 'payed';
                    $order->payment->transaction_id = $json_data['data']['transactionId'];
                    $order->payment->save();
                }
            } else {
                die();
            }
        }


    }
}
