<?php

namespace App\Http\Controllers;

use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorahController extends Controller
{

    public $mfObj;

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function __construct()
    {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
    }


    public function pay()
    {
        /* ------------------------ Configurations ---------------------------------- */
//Test
        $apiURL = 'https://apitest.myfatoorah.com';
        $apiKey = config('myfatoorah.api_key'); //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token

//Live
//$apiURL = 'https://api.myfatoorah.com';
//$apiKey = ''; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call InitiatePayment Endpoint ------------------- */
//Fill POST fields array
        $ipPostFields = ['InvoiceAmount' => 100, 'CurrencyIso' => 'SAR'];

//Call endpoint
        $paymentMethods = $this->initiatePayment($apiURL, $apiKey, $ipPostFields);

//You can save $paymentMethods information in database to be used later
        $paymentMethodId = 0;
        foreach ($paymentMethods as $pm) {
            if ($pm->PaymentMethodEn == 'VISA/MASTER') {
                $paymentMethodId = $pm->PaymentMethodId;
                break;
            }
        }

        /* ------------------------ Call ExecutePayment Endpoint -------------------- */
//Fill POST fields array
        $postFields = [
            //Fill required data
              'paymentMethodId' => $paymentMethodId,
              'InvoiceValue' => '100',
              'CallBackUrl' => 'http://127.0.0.1:8000/ar/pay_callback',
              'ErrorUrl' => 'http://127.0.0.1:8000/ar/pay_errorback', //or 'https://example.com/error.php'
              'RecurringModel' => [
                    'RecurringType' => 'Monthly',
              ],
            //Fill optional data
            //'CustomerName'       => 'fname lname',
            'DisplayCurrencyIso' => 'SAR',
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     => '1234567890',
            //'CustomerEmail'      => 'email@example.com',
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

//Call endpoint
        $data = $this->executePayment($apiURL, $apiKey, $postFields);

//You can save payment data in database as per your needs
        $invoiceId = $data->InvoiceId;
        $paymentLink = $data->PaymentURL;
//Redirect your customer to the payment page to complete the payment process
//Display the payment link to your customer
        echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";
        die;

    }
    /* ------------------------ Functions --------------------------------------- */
    /*
     * Initiate Payment Endpoint Function
     */

    private function initiatePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
        return $json->Data->PaymentMethods;
    }

//------------------------------------------------------------------------------
    /*
     * Execute Payment Endpoint Function
     */

    private function executePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
        return $json->Data;
    }

//------------------------------------------------------------------------------
    /*
     * Call API Endpoint Function
     */

    private function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
              CURLOPT_CUSTOMREQUEST => $requestType,
              CURLOPT_POSTFIELDS => json_encode($postFields),
              CURLOPT_HTTPHEADER => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
              CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

//------------------------------------------------------------------------------
    /*
     * Handle Endpoint Errors Function
     */

    private function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

    /* -------------------------------------------------------------------------- */
}
