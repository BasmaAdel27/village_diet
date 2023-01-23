<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class Payment
{
    public static function GetRecurringPayment()
    {
//        $response = Http::withHeaders([
//              'Authorization' => 'bearer '.config('myfatoorah.api_key')
//        ])->get('https://api-sa.myfatoorah.com/v2/GetRecurringPayment'); // live
        $response = Http::withHeaders([
              'Authorization' => 'bearer '.config('myfatoorah.test_api_key')
        ])->get('https://apitest.myfatoorah.com/v2/GetRecurringPayment'); // test
        $jsonData = $response->json();

        return $jsonData;
    }

    public static function CancelRecurringPayment($recurringId)
    {
        $response = Http::withHeaders([
              'Authorization' => 'bearer '.config('myfatoorah.api_key')
        ])->post('https://api-sa.myfatoorah.com/v2/CancelRecurringPayment?recurringId=' . $recurringId);
        $jsonData = $response->json();
        return $jsonData;
    }
}
