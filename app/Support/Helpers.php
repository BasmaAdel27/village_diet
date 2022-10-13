<?php

if (!function_exists('Setting')) {

    function Setting(string $attr)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            return  \App\Models\Setting::select($attr)->value($attr);
        }
    }
}

if (!function_exists('generateUniqueCode')) {
    function generateUniqueCode($model, $column, $length)
    {
        $columnArr = $model::pluck($column)->toArray();
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= mt_rand(0, 9);
        }

        if (in_array($code, $columnArr)) {
            generateUniqueCode($model, $column, $length);
        }

        return $code;
    }
}

if (!function_exists('successResponse')) {

    function successResponse($data = null, $pagination = null, $extra = [], $status = 200, $message = " ")
    {
        $json['status'] = true;
        if ($message) {
            $json['message'] = $message;
        }

        if ($extra) {
            foreach ($extra as $key => $value) {
                $json[$key] = $value;
            }
        }

        if ($data) {
            $json['data'] = $data;
        }

        if ($pagination) {
            $json['pagination'] = $pagination;
        }

        return response()->json($json, $status);
    }
}

if (!function_exists('failedResponse')) {

    function failedResponse($message = 'Failure', $status = 400)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'data' => null
        ], $status);
    }
}

if (!function_exists('send_notification')) {
    /**
     * send notifications
     *
     */
    function send_notification($tokens, $title, $body = [])
    {
        $init_data = [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => [
                'title' => $title,
                'body' => $body,
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'type' => 'general',
            ],
        ];

        $data = json_encode($init_data);

        $url = 'https://fcm.googleapis.com/fcm/send';

        $server_key = env('FIREBASE_KEY');

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        //CURL request to route notification to FCM connection server (provided by Google)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === false) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
}
