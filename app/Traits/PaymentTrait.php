<?php

namespace App\Traits;
use App\Models\paymentOrders;

use App\Models\Setting;
use LaravelLocalization;

trait PaymentTrait
{

    public function PaymentLink($item, $customer, $booking)
    {       
        $tokenResponse = $this->authenticat();
        if($tokenResponse['message'] == 'failure')
        {

        }
        $token = $tokenResponse['data']->token;

        $orderResponse = $this->orderRegistration($item, $token, $booking);
        if($orderResponse['message'] == 'failure')
        {

        }
        $order = $orderResponse['data']->id;
        paymentOrders::create([
            'order_id' => $order,
            'course_id' => $item->id,
            'request_id' => $booking->id,
        ]);

        $paymentKeyResponse = $this->paymentKey($item, $customer, $token, $order, $booking);        
        if($paymentKeyResponse['message'] == 'failure')
        {

        }
        $paymentKey = $paymentKeyResponse['data']->token;

        return $paymentKey;

    }

    public function authenticat()
    {       
        $data = array(
            'api_key' => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SndjbTltYVd4bFgzQnJJam94TVRJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaUxDSnVZVzFsSWpvaWFXNXBkR2xoYkNKOS5QelJEMWI1UlhlY2VCMVNhYVp4eEFaNm42a0tmbUV1R3IwZDcwaXpwVmNtdDN4OWtZNU1icG95Tlhkd2dkR2JCelU3Y2UtdnRpY1cwcjJMZ1ktWi1jZw==',
        );
        
        $endpoint = 'https://accept.paymob.com/api/auth/tokens';
        $method = 'POST';
        return $this->callApi($data,$endpoint,$method);

    }
    
    public function orderRegistration($item, $token, $booking)
    {  
        if(LaravelLocalization::getCurrentLocale() == 'sa')
        {
            $setting    = Setting::first();
            $price1     = $item->price * $setting->dollar;
        }
        else
        {
            $price1     = $item->price;
        }

        $discount               = $price1 * $booking->discount / 100;
        $price_after_discount   = $price1 - $discount;
        $price                  = $price_after_discount * 100;

        $singleItem = array(
            'name' => $item->name,
            'amount_cents' => $price,
            'description' => $item->name,
            'quantity' => 1,
        );
        
        $items = array (
            $singleItem,
          );

        $data = array(
            'auth_token' => $token,
            'delivery_needed' => "false",
            'amount_cents' => $price,
            'currency' => "EGP",
            'items' => $items,

        );


        
        $endpoint = 'https://accept.paymob.com/api/ecommerce/orders';
        $method = 'POST';
        return $this->callApi($data,$endpoint,$method);

    }


    public function paymentKey($item, $customer, $token, $order, $booking)
    {  
        $billingData = array(
            "apartment" => "NA", 
            "email" => $customer->email, 
            "floor" => "NA", 
            "first_name" => $customer->name, 
            "street" => "NA", 
            "building" => "NA", 
            "phone_number" => $customer->phone, 
            "shipping_method" => "NA", 
            "postal_code" => "NA", 
            "city" => "NA", 
            "country" => "NA", 
            "last_name" => $customer->lastname, 
            "state" => "NA"
        );
        
        if(LaravelLocalization::getCurrentLocale() == 'sa')
        {
            $setting    = Setting::first();
            $price1     = $item->price * $setting->dollar;
        }
        else
        {
            $price1     = $item->price;
        }

        $discount               = $price1 * $booking->discount / 100;
        $price_after_discount   = $price1 - $discount;
        $price                  = $price_after_discount * 100;

        $data = array(
            "auth_token" => $token,
            "amount_cents" => $price, 
            "expiration" => 3600, 
            "order_id" => $order,
            "billing_data" => $billingData, 
            "currency" => "EGP", 
            "integration_id" => 1652857,
            "lock_order_when_paid" => "true"
        );
        
        $endpoint = 'https://accept.paymob.com/api/acceptance/payment_keys';
        $method = 'POST';
        return $this->callApi($data,$endpoint,$method);

    }    



    public function callApi($data,$endpoint,$method)
    {
        $data_string = json_encode($data);
        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Accepts: application/json',
                'Content-Type: application/json'
            )
        );

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {
            $data = ['message' => 'failure', 'data' =>json_decode($err) ];
            return  $data;
        }

        $data = ['message' => 'success', 'data' =>json_decode($response) ];
        return  $data;
    }

    
  


}
