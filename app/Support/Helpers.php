<?php

if (!function_exists('Setting')) {

    function Setting(string $attr)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            return \App\Models\Setting::select($attr)->value($attr);
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
              'status' => false,
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
    function send_notification($token, $content, $title, $message)
    {
        $server_key = config('auth.firebase_id');

        $fcmFields = [
              'registration_ids' => $token,
              'priority' => 'high',
              'notification' => [
                    'body' => $content,
                    'title' => $title,
                    'sound' => "default",
                    'color' => "#203E78",
                    'priority' => 'high',
                    'notification' => $message
              ]
        ];
        $headers = [
              'Authorization' => 'key=' . $server_key,
              'Content-Type' => 'application/json'
        ];
        $request = \Http::withHeaders($headers)->post('https://fcm.googleapis.com/fcm/send', $fcmFields);
        return $request->body();


//        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
//        $notification = [
//              'notification' => $message,
//              'sound' => true,
//              'title' => $title,
//              'body' => $content,
//              'priority' => 'high',
//        ];
//
//        $extraNotificationData = ["data" => $notification];
//
//        $fcmNotification = [
//              'to' => $token, //single token
//              'notification' => $notification,
//              'data' => $extraNotificationData
//        ];
//        $server_key = config('auth.firebase_id');
//        $headers = array(
//              'Content-Type:application/json',
//              'Authorization:key=' . $server_key
//        );
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
//        $result = curl_exec($ch);
//        curl_close($ch);
//        return true;
    }
}
