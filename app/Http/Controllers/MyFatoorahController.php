<?php

namespace App\Http\Controllers;

use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorahController extends Controller
{

    public $mfObj, $data, $user;

    public function __construct()
    {
        $this->mfObj = new PaymentMyfatoorahApiV2(
            config('myfatoorah.api_key'),
            config('myfatoorah.country_iso'),
            config('myfatoorah.test_mode')
        );
    }


    public function index()
    {
        return $this;
    }

    public function getPayLoadData($data, $renew = false, $user)
    {
        $callbackURL = route('website.callback', ['user' => $user, 'code' => $data['code']]);
        $data =  [
            'CustomerName'       => $user->first_name . ' ' . $user->last_name,
            'InvoiceValue'       => $data['total'],
            'DisplayCurrencyIso' => 'SAR',
            'CustomerEmail'      => $user->email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'MobileCountryCode'  => '+966',
            'CustomerMobile'     => $user->phone,
            'Language'           => 'ar',
            'CustomerReference'  => $user->id,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];

        if ($renew) {
            $data += [
                'RecurringModel' => [
                    'RecurringType' => 'Monthly',
                ],
            ];
        }

        return $data;
    }
}
