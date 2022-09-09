<?php

if (!function_exists('Setting')) {

    function Setting(string $attr)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
          return  \App\Models\Setting::select($attr)->value($attr);
        }
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
        ], $status);
    }
}
