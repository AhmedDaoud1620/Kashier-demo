<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebHookAPIController extends Controller
{
    public function kashierHook(Request $request)
    {
        if ($request->isMethod('post')) {
            $raw_payload = $request->getContent();
            $json_data = json_decode($raw_payload, true);
            $data_obj = $json_data['data'];
            $event = $json_data['event'];
            sort($data_obj['signatureKeys']);
            $headers = $request->header();
            $headers = array_change_key_case($headers);
            $kashierSignature = $headers['x-kashier-signature'];
            $data = [];
            foreach ($data_obj['signatureKeys'] as $key) {
                $data[$key] = $data_obj[$key];
            }
            $queryString = http_build_query($data, '', '&', PHP_QUERY_RFC3986);
            $signature = hash_hmac('sha256', $queryString, env('KASHIER_SECRET_KEY'), false);

            if ($signature === $kashierSignature) {

                return response();
            } else {
                return response('Invalid signature', 403);
            }
        }

    }
}
